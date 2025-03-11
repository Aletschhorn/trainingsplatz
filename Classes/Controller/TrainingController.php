<?php
namespace DW\Trainingsplatz\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Core\Context\Context;

use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;

use DW\Trainingsplatz\Domain\Repository\TrainingRepository;
use DW\Trainingsplatz\Domain\Repository\AnswerRepository;
use DW\Trainingsplatz\Domain\Repository\SportRepository;
use DW\Trainingsplatz\Domain\Repository\IntensityRepository;
use DW\Trainingsplatz\Domain\Repository\InfomailRepository;
use DW\Trainingsplatz\Domain\Model\Training;
use DW\Trainingsplatz\Domain\Model\Answer;
use In2code\Femanager\Domain\Repository\UserRepository;

/**
 * TrainingController
 */
class TrainingController extends ActionController {
	
	protected $emailLogoUrl = 'https://freizeitsportler.ch/typo3conf/ext/sitepackage_fsch/Resources/Public/Images/logo_10jahre_full.png';
	protected $emailLogoHeight = 50;

	private $trainingRepository;

	private $answerRepository;

	private $sportRepository;
	
	private $intensityRepository;

	private $infomailRepository;
	
	private $userRepository;
	
	protected $timezone;

	public function __construct (
			TrainingRepository $trainingRepository,
			AnswerRepository $answerRepository,
			SportRepository $sportRepository,
			IntensityRepository $intensityRepository,
			InfomailRepository $infomailRepository,
			UserRepository $userRepository,
			private readonly Context $context
	) {
		$this->trainingRepository = $trainingRepository;
		$this->answerRepository = $answerRepository;
		$this->sportRepository = $sportRepository;
		$this->intensityRepository = $intensityRepository;
		$this->infomailRepository = $infomailRepository;
		$this->userRepository = $userRepository;
		$this->timezone = new \DateTimeZone($this->context->getPropertyFromAspect('date', 'timezone'));
	}
	

	public function listAction(): ResponseInterface {
		$limit = intval($this->settings['limitation']);
		$includeCancelled = intval($this->settings['includeCancelled']);

		$filter = $this->request->hasArgument('filter') ? intval($this->request->getArgument('filter')) : 0;
		$GLOBALS['TSFE']->fe_user->setKey('ses','tpFilter',$filter);
		if ($filter > 0) {
			$trainings = $this->trainingRepository->findFutureFiltered($filter, $limit, $includeCancelled);
		} else {
			$trainings = $this->trainingRepository->findFuture($limit, $includeCancelled);
		}

		$currentPage = 1;
		if ($this->request->hasArgument('currentPage')) {
			$currentPage = max([1, intval($this->request->getArgument('currentPage'))]);
		}
		$GLOBALS['TSFE']->fe_user->setKey('ses','tpListPageNo',$currentPage);

		$itemsPerPage = intval($this->settings['itemsPerPage']);
		if ($itemsPerPage == 0) {
			// no pagination
			$trainingsReduced = clone $trainings;			
			$paginationArray = [];
		} else {
			// setup pagination
			$paginator = new \TYPO3\CMS\Extbase\Pagination\QueryResultPaginator($trainings, $currentPage, $itemsPerPage);
			$pagination = new \TYPO3\CMS\Core\Pagination\SimplePagination($paginator);
			$trainingsReduced = clone $paginator->getPaginatedItems();
					
			$paginationArray = [];
			if ($paginator->getNumberOfPages() > 1) {
				if ($currentPage == 1) {
					$paginationArray[] = ['label' => '«', 'pageNo' => $pagination->getPreviousPageNumber(), 'status' => 'disabled'];
				} else {
					$paginationArray[] = ['label' => '«', 'pageNo' => $pagination->getPreviousPageNumber(), 'status' => ''];
				}
				foreach ($pagination->getAllPageNumbers() as $pageNumber) {
					if ($pageNumber == $currentPage) {
						$paginationArray[] = ['label' => $pageNumber, 'pageNo' => $pageNumber, 'status' => 'active'];
					} else {
						$paginationArray[] = ['label' => $pageNumber, 'pageNo' => $pageNumber, 'status' => ''];
					}
				}
				if ($currentPage == $pagination->getLastPageNumber()) {
					$paginationArray[] = ['label' => '»', 'pageNo' => $pagination->getNextPageNumber(), 'status' => 'disabled'];
				} else {
					$paginationArray[] = ['label' => '»', 'pageNo' => $pagination->getNextPageNumber(), 'status' => ''];
				}
			}
		}

		$answers = [];
		foreach ($trainingsReduced as $training) {
			$answers[$training->getUid()] = $this->answerRepository->findPerTrainingCorrected($training);
		}
		
		$this->view->assignMultiple([
			'trainings' => $trainingsReduced,
			'answers' => $answers,
			'sports' => $this->sportRepository->findAll(),
			'filter' => $filter,
			'pagination' => $paginationArray,
			'settings' => $this->settings,
		]);
		return $this->htmlResponse();
	}
	

	public function showAction(Training $training): ResponseInterface {
		$filter = intval($GLOBALS['TSFE']->fe_user->getKey('ses','tpFilter'));
		$listPageNo = intval($GLOBALS['TSFE']->fe_user->getKey('ses','tpListPageNo'));
		$answers = $this->answerRepository->findPerTraining($training);
		$countPublicAnswers = $this->answerRepository->countPerTrainingAndNotMember($training);
		$userId = $this->context->getPropertyFromAspect('frontend.user', 'id');
		$newAnswer = new \DW\Trainingsplatz\Domain\Model\Answer();
		$newAnswer->setTitle('Bin dabei');
		$newAnswer->setDescription('Ich mache bei diesem Training mit.');
		if ($userId > 0) {
			$feuser = $this->userRepository->findByUid($userId);
			$userAnswer = $this->answerRepository->findByTrainingAndUser($training,$userId);
		}
		$correctedAnswers = $this->answerRepository->findPerTrainingCorrected($training);

		$this->view->assignMultiple([
			'training' => $training,
			'answers' => $answers,
			'countPublicAnswers' => $countPublicAnswers,
			'newAnswer' => $newAnswer,
			'feuser' => $feuser,
			'userAnswer' => $userAnswer[0],
			'correctedAnswers' => $correctedAnswers,
			'outdated' => $this->isTrainingOutdated($training),
			'filter' => $filter,
			'listPageNo' => $listPageNo,
			'settings' => $this->settings,
		]);
		return $this->htmlResponse();
	}


	public function singleAction(Training $training): ResponseInterface {
		$answers = $this->answerRepository->findPerTraining($training);
		$correctedAnswers = $this->answerRepository->findPerTrainingCorrected($training);

		$this->view->assignMultiple([
			'training' => $training,
			'answers' => $answers,
			'correctedAnswers' => $correctedAnswers,
			'settings' => $this->settings,
		]);
		return $this->htmlResponse();
	}


	protected function getErrorFlashMessage() {
		switch ($this->actionMethodName) {
			case 'createAction':
	   			return 'Bitte Datumfeld korrekt ausfüllen';
			case 'updateAction':
	   			return 'Bitte Datumfeld korrekt ausfüllen';
			default:
				return parent::getErrorFlashMessage();
		}
	}


	public function newAction(): ResponseInterface {
		$sports = $this->sportRepository->findAll();
		$intensities = $this->intensityRepository->findAll();
		$coaches = $this->userRepository->findByUsergroup($this->settings['usergroupSportcoach']);
		$this->view->assignMultiple([
			'training' => new Training,
			'settings' => $this->settings
		]);
		return $this->htmlResponse();
	}


	public function initializeCreateAction() {
		if (isset($this->arguments['training'])) {
			$this->arguments['training']->getPropertyMappingConfiguration()->forProperty('trainingDate')->setTypeConverterOption('TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			$this->arguments['training']->getPropertyMappingConfiguration()->forProperty('seriesStart')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			$this->arguments['training']->getPropertyMappingConfiguration()->forProperty('seriesEnd')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
		}
	}


	public function createAction(Training $training): ResponseInterface {
		$now = new \DateTime('now', $this->timezone);
		$training->setCreationDate($now);
		$user = $this->userRepository->findByUid($this->context->getPropertyFromAspect('frontend.user', 'id'));
		$training->setAuthor($user);
		if (in_array('TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup:'.$this->settings['usergroupSportcoach'],$user->getUsergroup()->toArray())) {
			$training->setLeader($user);
		}
		
		$today = new \DateTime('today', $this->timezone);
		$failue = false;
		if ($training->getSeries() == 0) {
			if ($training->getTrainingDate() == NULL) {
				$this->addFlashMessage('Trainingsdatum ist ungültig', '', ContextualFeedbackSeverity::ERROR);
				$failure = true;
			} else {
				$training->setTrainingDate($this->adjustYear($training->getTrainingDate()));
				if ($training->getTrainingDate()->format('U') < $today->format('U')) {
					$this->addFlashMessage('Trainingsdatum liegt in der Vergangenheit', '', ContextualFeedbackSeverity::ERROR);
					$failure = true;
				}
			}
		} else {
			if ($training->getSeriesStart() == NULL or $training->getSeriesEnd() == NULL) {
				$this->addFlashMessage('Trainingsdaten der Serie sind ungültig', '', ContextualFeedbackSeverity::ERROR);
				$failure = true;
			} else {
				$training->setSeriesStart($this->adjustYear($training->getSeriesStart()));
				$training->setSeriesEnd($this->adjustYear($training->getSeriesEnd()));
				if ($training->getSeriesStart()->format('U') < $today->format('U')) {
					$this->addFlashMessage('Startdatum der Serie liegt in der Vergangenheit', '', ContextualFeedbackSeverity::ERROR);
					$failure = true;
				} elseif ($training->getSeriesStart()->format('U') > $training->getSeriesEnd()->format('U')) {
					$this->addFlashMessage('Startdatum ist nach dem Enddatum der Serie', '', ContextualFeedbackSeverity::ERROR);
					$failure = true;
				} else {
					$seriesDates = $this->getSeriesDates($training);
					if (count($seriesDates) == 0) {
						$this->addFlashMessage('Kein Trainingsdatum zwischen Start- und Enddatum möglich', '', ContextualFeedbackSeverity::ERROR);
						$failure = true;
					} else {
						foreach ($seriesDates as $seriesDate) {
							$seriesDatesFormated[] = date('d.m.Y',$seriesDate->format('U'));
						}
						$message = 'Trainings werden für folgende Daten erstellt: '.implode(', ',$seriesDatesFormated);
						$this->addFlashMessage($message, '', ContextualFeedbackSeverity::INFO);
						$training->setTrainingDate($seriesDates[0]);
					}
				}
			}
		}

		$this->trainingRepository->add($training);
		$persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
		$persistenceManager->persistAll();

		if ($failure) {
			return $this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => 1));
		} else {
			return $this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => 2));
		}
	}

	/**
	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("training")	 
	 */
	public function editAction(Training $training, int $step=2): ResponseInterface {
		if ($training->getSeries() == 0) {
			$seriesDates = NULL;
		} else {
			$seriesDates = $this->getSeriesDates($training);
		}
		
		$this->view->assignMultiple([
			'training' => $training,
			'intensities' => $this->intensityRepository->findAll(),
			'sports' => $this->sportRepository->findAll(),
			'sportcoaches' => $this->userRepository->findByUsergroup($this->settings['usergroupSportcoach']),
			'members' =>  $this->userRepository->findByUsergroup($this->settings['usergroupMember']),
			'seriesDates' => $seriesDates,
			'step' => $step,
			'settings' => $this->settings,
		]);
		return $this->htmlResponse();
	}


	public function initializeUpdateAction() {
		if (isset($this->arguments['training'])) {
			$this->arguments['training']->getPropertyMappingConfiguration()->forProperty('trainingDate')->setTypeConverterOption('TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			$this->arguments['training']->getPropertyMappingConfiguration()->forProperty('seriesStart')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			$this->arguments['training']->getPropertyMappingConfiguration()->forProperty('seriesEnd')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
		}
	}


	public function updateAction(Training $training): ResponseInterface {
		$now = new \DateTime('now', $this->timezone);
		$today = new \DateTime('today', $this->timezone);
		if ($training->isPublic()) {
			$training->setLastChange($now);
		} else {
			$training->setCreationDate($now);
		}
		$step = $training->getStep();
		
		// Validate some fields
		if ($step == 1) {
			if ($training->getSeries() == 0) {
				if ($training->getTrainingDate() == NULL) {
					$this->addFlashMessage('Trainingsdatum ist ungültig', '', ContextualFeedbackSeverity::ERROR);
					return $this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
				} else {
					$training->setTrainingDate($this->adjustYear($training->getTrainingDate()));
					if ($training->getTrainingDate()->format('U') < $today->format('U')) {
						$this->addFlashMessage('Trainingsdatum liegt in der Vergangenheit', '', ContextualFeedbackSeverity::ERROR);
						return $this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
					}
				}
			} else {
				if ($training->getSeriesStart() == NULL or $training->getSeriesEnd() == NULL) {
					$this->addFlashMessage('Trainingsdaten der Serie sind ungültig', '', ContextualFeedbackSeverity::ERROR);
					return $this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
				} else {
					$training->setSeriesStart($this->adjustYear($training->getSeriesStart()));
					$training->setSeriesEnd($this->adjustYear($training->getSeriesEnd()));
					if ($training->getSeriesStart()->format('U') < $today->format('U')) {
						$this->addFlashMessage('Startdatum der Serie liegt in der Vergangenheit', '', ContextualFeedbackSeverity::ERROR);
						return $this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
					} elseif ($training->getSeriesStart()->format('U') > $training->getSeriesEnd()->format('U')) {
						$this->addFlashMessage('Startdatum ist nach dem Enddatum der Serie', '', ContextualFeedbackSeverity::ERROR);
						return $this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
					} else {
						$seriesDates = $this->getSeriesDates($training);
						if (count($seriesDates) == 0) {
							$this->addFlashMessage('Kein Trainingsdatum zwischen Start- und Enddatum möglich', '', ContextualFeedbackSeverity::ERROR);
							return $this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
						} else {
							foreach ($seriesDates as $seriesDate) {
								$seriesDatesFormated[] = date('d.m.Y',$seriesDate->format('U'));
							}
							$message = 'Trainings werden für folgende Daten erstellt: '.implode(', ',$seriesDatesFormated);
							$this->addFlashMessage($message, '', ContextualFeedbackSeverity::INFO);
							$training->setTrainingDate($seriesDates[0]);
						}
					}
				}
			}
		}

		if ($step == 2) {
			if (! $training->getTitle() or ! $training->getDescription()) {
				$this->addFlashMessage('Titel und Beschreibung müssen ausgefüllt sein', '', ContextualFeedbackSeverity::ERROR);
				return $this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
			}
		}
		
		if ($step == 4) {
			$persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);

			if ($training->getSeries()) {
				$seriesDates = $this->getSeriesDates($training);
				foreach ($seriesDates as $it => $singleDate) {
					if ($it == 0) {
						$training->setPublic(true);
						$this->trainingRepository->update($training);
					} else {
						$newTraining = new \DW\Trainingsplatz\Domain\Model\Training;
						if ($value = $training->getAuthor()) { $newTraining->setAuthor($value); }
						if ($value = $training->getLeader()) { $newTraining->setLeader($value); }
						if ($value = $training->getCreationDate()) { $newTraining->setCreationDate($value); }
						if ($value = $training->getGuided()) { $newTraining->setGuided($value); }
						if ($value = $training->getTitle()) { $newTraining->setTitle($value); }
						if ($value = $training->getDescription()) { $newTraining->setDescription($value); }
						if ($value = $training->getStartText()) { $newTraining->setStartText($value); }
						if ($value = $training->getStartOption()) { $newTraining->setStartOption($value); }
						if ($value = $training->getStartCoordinates()) { $newTraining->setStartCoordinates($value); }
						if ($value = $training->getDuration()) { $newTraining->setDuration($value); }
						if ($value = $training->getDistance()) { $newTraining->setDistance($value); }
						if ($value = $training->getSpeed()) { $newTraining->setSpeed($value); }
						if ($value = $training->getRoute()) { $newTraining->setRoute($value); }
						if ($value = $training->getPicture()) { $newTraining->setPicture($value); }
						if ($value = $training->getIntensity()) { $newTraining->setIntensity($value); }
						if ($value = $training->getSport()) { $newTraining->setSport($value); }
						if ($value = $training->getMapCenter()) { $newTraining->setMapCenter($value); }
						if ($value = $training->getMapZoom()) { $newTraining->setMapZoom($value); }
						if ($value = $training->getMapType()) { $newTraining->setMapType($value); }
						// if ($value = $training->getInfomail()) { $newTraining->setInfomail($value); }
						if ($value = $training->getNotification()) { $newTraining->setNotification($value); }
						$newTraining->setTrainingDate($singleDate);
						$newTraining->setPublic(true);
						$this->trainingRepository->add($newTraining);
					}
					$persistenceManager->persistAll();
				}
			} else {
				$training->setPublic(true);
				$this->trainingRepository->update($training);
				$persistenceManager->persistAll();
			}
			
			// InfoMail preparation
			if ($training->isInfomail()) {
				if ($training->isGuided()) { 
					$trainer = $training->getLeader(); 
				} else { 
					$trainer = $training->getAuthor(); 
				}
				$mailtext = 'Hoi Freizeitsportler'.chr(10).chr(10).'Am '.$training->getTrainingDate()->format('j.m.Y').' findet ein Training statt, das dich interessieren könnte:'.chr(10).chr(10).'Titel: '.$training->getTitle().chr(10).'Datum: '.$training->getTrainingDate()->format('j.m.y').chr(10).'Sportart: '.$training->getSport()->getTitle().chr(10).'Intensität: '.$training->getIntensity()->getTitle().chr(10).'Verantwortlich: '.$trainer->getName().chr(10).'Mehr Infos: https://freizeitsportler.ch/direkt/training/show/'.$training->getUid().chr(10).chr(10).'Sportliche Grüsse'.chr(10).'freizeitsportler.ch';
				$existing = $this->infomailRepository->findPerTrainingAndStatus($training,0);
				if (count($existing) == 0) {
					$infomail = new \DW\Trainingsplatz\Domain\Model\Infomail();
					$new = true;
				} else {
					$infomail = $existing[0];
					$new = false;
				}
				$infomail->setTraining($training);
				$infomail->setMailSubject($training->getTitle().' am '.$training->getTrainingDate()->format('j.m.Y'));
				$infomail->setMailBody($mailtext);
				if ($new) {
					$infomail->setStatus(0);
					$infomail->setStatusDate($now);
					$this->infomailRepository->add($infomail);
				} else {
					$this->infomailRepository->update($infomail);
				}
					
				// Send notification to admins
				if (! $this->settings['emails']['suppress']) {
					$mailtext = 'Titel: '.$training->getTitle().chr(10).'Datum: '.$training->getTrainingDate()->format('j.m.Y').chr(10).'Sportart: '.$training->getSport()->getTitle().chr(10).'Intensität: '.$training->getIntensity()->getTitle().chr(10).'Verantwortlich: '.$trainer->getName().chr(10).'InfoMail-Versand: https://www.freizeitsportler.ch/infomails';
					$mail = GeneralUtility::makeInstance(FluidEmail::class);
					if ($this->settings['emails']['sendOnlyTo']) {
						$mail->to(new Address($this->settings['emails']['sendOnlyTo'], 'fs.ch-InfoMail'));
					} else {
						$mail->to(new Address('infomailversand@freizeitsportler.ch', 'fs.ch-InfoMail'));
					}
					$mail
						->from(new Address('donotreply@freizeitsportler.ch', 'freizeitsportler.ch'))
						->subject('Infomail für Training pendent')
						->format(FluidEmail::FORMAT_BOTH)
						->setTemplate('Training')
						->embedFromPath($this->emailLogoUrl, 'logo')
						->assignMultiple([
							'logo' => '<img src="cid:logo" alt="freizeitsportler.ch-Logo" height="'.$this->emailLogoHeight.'" />',
							'headline' => 'Infomail für Training pendent',
							'content' => $mailtext,
							'contentHtml' => str_replace(chr(10),'<br />',$mailtext),
							'note' => 'Dies ist eine automatisch erstellte Nachricht. Bitte nicht darauf antworten.'
						]);
					$mailerInterface = GeneralUtility::makeInstance(Mailer::class);
					$mailerInterface->send($mail);
				}
			}
			return $this->redirect('show','Training','trainingsplatz',array('training' => $training),$this->settings['mainPid']);
		} else {
			$this->trainingRepository->update($training);
			$step++;
			return $this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
		}
	}


	public function cancelAction(Training $training): ResponseInterface {
		$now = new \DateTime('now',$this->timezone);
		$difference = $training->getTrainingDate()->diff($now);
		
		if ($training->getTrainingDate()->diff($now)->format("%r%a") < 1) {
			// only allow cancellation at same day as the training or ealier
		
			$training->setLastChange($now);
			$training->setCancelled(true);
			$this->trainingRepository->update($training);
			
			if (! $this->settings['emails']['suppress']) {
				$mailtext = 'Hoi Freizeitsportler'.chr(10).chr(10).'Das Training "'.$training->getTitle().'" vom '.$training->getTrainingDate()->format('j.m.y').' muss leider abgesagt werden.'.chr(10).chr(10).'Sportliche Grüsse'.chr(10).'freizeitsportler.ch';
				$answers = $this->answerRepository->findPerTraining($training);
				$subject = 'Training vom '.$training->getTrainingDate()->format('j.m.Y').' abgesagt';

				$mail = GeneralUtility::makeInstance(FluidEmail::class);
				if ($this->settings['emails']['sendOnlyTo']) {
					$mail->to(new Address($this->settings['emails']['sendOnlyTo'], 'fs.ch-InfoMail'));
				} else {
					$mail->to(new Address('infomailversand@freizeitsportler.ch', 'fs.ch-InfoMail'));
				}
				$mail
					->from(new Address('donotreply@freizeitsportler.ch', 'freizeitsportler.ch'))
					->subject($subject)
					->format(FluidEmail::FORMAT_BOTH)
					->embedFromPath($this->emailLogoUrl, 'logo')
					->setTemplate('Training')
					->assignMultiple([
						'logo' => '<img src="cid:logo" alt="freizeitsportler.ch-Logo" height="'.$this->emailLogoHeight.'" />',
						'headline' => $subject,
						'content' => $mailtext,
						'contentHtml' => str_replace(chr(10),'<br />',$mailtext),
						'note' => 'Dies ist eine automatisch erstellte Nachricht. Du erhältst sie, weil du dich für dieses Training eingeschrieben hast. Bitte nicht auf diese E-Mail antworten.'
					]);
				$mailerInterface = GeneralUtility::makeInstance(Mailer::class);
				$mailerInterface->send($mail);

				if (! $this->settings['emails']['sendOnlyTo']) {
					foreach ($answers as $answer) {
						if ($user = $answer->getFeuser()) {
							if ($user->getEmail()) {
								$mail->to(new Address($user->getEmail(), $user->getName()));
								$mailerInterface->send($mail);
							}
						} else {
							if ($answer->getEmail()) {
								$mail->to(new Address($answer->getEmail(), $answer->getAuthor()));
								$mailerInterface->send($mail);
							}
						}
					}
				}
			}
			
			$this->addFlashMessage('Training wurde abgesagt und die eingetragenen Teilnehmer per Mail informiert.', '', ContextualFeedbackSeverity::OK);
		}
		return $this->redirect('show','Training','trainingsplatz',array('training' => $training->getUid()));
	}


	public function activateAction(Training $training): ResponseInterface {
		$now = new \DateTime('now',$this->timezone);
		$training->setLastChange($now);
		$training->setCancelled(false);
		$this->trainingRepository->update($training);

		$this->addFlashMessage('Training wurde wieder aktiviert. Es wurden keine Mails versendet.', '', ContextualFeedbackSeverity::OK);
		return $this->redirect('show','Training','trainingsplatz',array('training' => $training->getUid()));
	}


	public function deleteAction(Training $training): ResponseInterface {
		$this->trainingRepository->remove($training);
		$this->addFlashMessage('Das Training wurde gelöscht.');
		return $this->redirect('list');
	}

	/**
	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("answer")	 
	 */
	public function addAnswerAction(?Answer $answer = NULL): ResponseInterface {
		// Validate some fields
		$error = false;
		if ($this->request->getArgument('zusatz') <> "") {
			// Robot filled hidden text field (honey pot)
			$error = true;
		}
		if ($this->isTrainingOutdated($answer->getTraining())) {
			// Only allow adding an answer for today's and future trainings, not for outdated ones
			$error = true;
		}
		$member = false;
		$feuserId = $this->context->getPropertyFromAspect('frontend.user', 'id');
		if ($feuserId > 0) {
			$feuserObject = $this->userRepository->findByUid($feuserId);
			$userGroups = $this->context->getPropertyFromAspect('frontend.user', 'groupIds');
			if (is_array($userGroups) && in_array($this->settings['usergroupMember'], $userGroups)) {
				$member = true;
				$answer->setFeuser($feuserObject);
				$answer->setAuthor($feuserObject->getName());
			}
		}
		if ($member) {
			if ($answer->getTitle() == "" or $answer->getDescription() == "") {
				$error = true;
			}
		} else {
			if ($answer->getAuthor() == "" or GeneralUtility::validEmail($answer->getEmail()) == false) {
				$error = true;
			}
		}
		
		if ($error) {
			return $this->redirect('show','Training','trainingsplatz',array('training' => $answer->getTraining()->getUid()),$settings->mainPid.'#userAnswer');			
		} else {
			$now = new \DateTime('now',$this->timezone);
			$answer->setCreationDate($now);
			$answer->setChangeDate($now);
			$feuserId = $this->context->getPropertyFromAspect('frontend.user', 'id');
			if ($feuserId > 0) {
				$feuserObject = $this->userRepository->findByUid($feuserId);
				$answer->setFeuser($feuserObject);
				$answer->setAuthor($feuserObject->getName());
			}
			$this->answerRepository->add($answer);
			if ($answer->getTraining()->isNotification()) {
				$this->sendNotification($answer, 1);
			}
			return $this->redirect('show','Training','trainingsplatz',array('training' => $answer->getTraining()->getUid()),$settings->mainPid.'#userAnswer');
		}
	}


	public function editAnswerAction(Answer $answer): ResponseInterface {

		$training = $answer->getTraining();
		$answers = $this->answerRepository->findPerTraining($training);
		$userId = $this->context->getPropertyFromAspect('frontend.user', 'id');
		if ($userId > 0) {
			$feuser = $this->userRepository->findByUid($userId);
			$userAnswer = $this->answerRepository->findByTrainingAndUser($training,$userId);
		}
		$correctedAnswers = $this->answerRepository->findPerTrainingCorrected($training);
		$this->view->assignMultiple([
			'training' => $training,
			'answers' => $answers,
			'feuser' => $feuser,
			'userAnswer' => $answer,
			'correctedAnswers' => $correctedAnswers,
		]);
		return $this->htmlResponse();
	}


	public function modifyAnswerAction(Answer $answer): ResponseInterface {
		// Validate some fields
		$error = false;
		if ($answer->getTitle() == "" or $answer->getDescription() == "") {
			$error = true;
		}
		if ($this->isTrainingOutdated($answer->getTraining())) {
			// Only allow adding an answer for today's and future trainings, not for outdated ones
			$error = true;
		}

		if ($error) {
			return $this->redirect('show','Training','trainingsplatz',array('training' => $answer->getTraining()->getUid()),$settings->mainPid.'#userAnswer');			
		} else {
			$now = new \DateTime('now',$this->timezone);
			$answer->setChangeDate($now);
			$this->answerRepository->update($answer);
			if ($answer->getTraining()->isNotification()) {
				$this->sendNotification($answer, 2);
			}
			return $this->redirect('show','Training','trainingsplatz',array('training' => $answer->getTraining()->getUid()),$settings->mainPid.'#userAnswer');
		}
	}


	public function cancelAnswerAction(Answer $answer): ResponseInterface {
		$now = new \DateTime('now',$this->timezone);
		$answer->setChangeDate($now);
		$answer->setCancelled(true);
		$answer->setHash('');
		$this->answerRepository->update($answer);
		if ($answer->getTraining()->isNotification()) {
			$this->sendNotification($answer, 3);
		}
		$this->addFlashMessage('Teilnahme abgesagt', '', ContextualFeedbackSeverity::OK);
		return $this->redirect('show','Training','trainingsplatz',array('training' => $answer->getTraining()->getUid()),$settings->mainPid.'#userAnswer');
	}


	public function reactivateAnswerAction(Answer $answer): ResponseInterface {
		$now = new \DateTime('now',$this->timezone);
		$answer->setChangeDate($now);
		$answer->setCancelled(false);
		$this->answerRepository->update($answer);
		if ($answer->getTraining()->isNotification()) {
			$this->sendNotification($answer, 4);
		}
		$this->addFlashMessage('Teilnahme wieder aktiviert', '', ContextualFeedbackSeverity::OK);
		return $this->redirect('show','Training','trainingsplatz',array('training' => $answer->getTraining()->getUid()),$settings->mainPid.'#userAnswer');
	}


	public function cancelRequestAnswerAction(): ResponseInterface {
		if ($this->request->hasArgument('training')) {
			$persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
			$training = $this->trainingRepository->findByUid($this->request->getArgument('training'));
			if ($training and $this->request->hasArgument('email')) {
				$email = $this->request->getArgument('email');
				if (GeneralUtility::validEmail($email)) {
					$answers = $this->answerRepository->findPerTrainingAndEmail($training,$email);
					if ($answers->count() > 0) {
						foreach ($answers as $answer) {
							if (! $answer->isCancelled()) {
								$hash = md5($training->getUid().'-'.$answer->getUid().'-'.time());
								$answer->setHash($hash);
								$this->answerRepository->update($answer);
								$persistenceManager->persistAll();
								$arguments = ['training' => $training->getUid(), 'answer' => $answer->getUid(), 'hash' => $hash];
								$link = $this->uriBuilder
									->reset()
									->setTargetPageUid($this->settings['mainPid'])
									->setCreateAbsoluteUri(true)
									->uriFor('cancelPublicAnswer', $arguments, 'Training');							
								$mailtext = 'Hoi Freizeitsportler'.chr(10).chr(10).'Um deine Teilnahme beim Training "'.$training->getTitle().'" vom '.$training->getTrainingDate()->format('j.m.Y').' abzusagen, klicke bitte auf diesen Link:.'.chr(10).$link.chr(10).chr(10).'Sportliche Grüsse'.chr(10).'freizeitsportler.ch';
								$subject = 'Deine Absage vom Training am '.$training->getTrainingDate()->format('j.m.Y');
	
								$mail = GeneralUtility::makeInstance(FluidEmail::class);
								if ($this->settings['emails']['sendOnlyTo']) {
									$mail->to(new Address($this->settings['emails']['sendOnlyTo']));
								} else {
									$mail->to(new Address($email));
								}
								$mail
									->from(new Address('donotreply@freizeitsportler.ch', 'freizeitsportler.ch'))
									->subject($subject)
									->format(FluidEmail::FORMAT_BOTH)
									->embedFromPath($this->emailLogoUrl, 'logo')
									->setTemplate('Training')
									->assignMultiple([
										'logo' => '<img src="cid:logo" alt="freizeitsportler.ch-Logo" height="'.$this->emailLogoHeight.'" />',
										'headline' => $subject,
										'content' => $mailtext,
										'contentHtml' => str_replace(chr(10),'<br />',$mailtext),
										'note' => 'Dies ist eine automatisch erstellte Nachricht. Bitte nicht darauf antworten.'
									]);
								if ($this->settings['emails']['suppress']) {
									$this->addFlashMessage('Weil der Versand von E-Mails unterdrückt ist, ist keine Nachtricht versendet worden.', '', ContextualFeedbackSeverity::WARNING);
								} else {
									$mailerInterface = GeneralUtility::makeInstance(Mailer::class);
									$mailerInterface->send($mail);
									$this->addFlashMessage('Der Abmelde-Link wurde dir per E-Mail zugesendet.', '', ContextualFeedbackSeverity::OK);
								}
							}
						}
					} else {
						$this->addFlashMessage('Die angegebene Mailadresse wurde in keinem der Teilnahme-Einträgen gefunden.', '', ContextualFeedbackSeverity::WARNING);
					}
				} else {
					$this->addFlashMessage('Die angegebene Mailadresse ist ungültig.', '', ContextualFeedbackSeverity::WARNING);
				}
				return $this->redirect('show','Training','trainingsplatz',['training' => $training]);
			}
			$this->addFlashMessage('Die anggeebene Mailadresse wurde in keiner der Teilnahme-Einträgen gefunden.', '', ContextualFeedbackSeverity::WARNING);
			return $this->redirect('show','Training','trainingsplatz',['training' => $training]);
		}
		return $this->redirect('list');
	}


	public function cancelPublicAnswerAction(): ResponseInterface {
		if ($this->request->hasArgument('answer') and $this->request->hasArgument('hash')) {
			$answer = $this->answerRepository->findByUid($this->request->getArgument('answer'));
			$test .= '('.$answer->getHash().' / '.$this->request->getArgument('hash').') ';
			if ($answer->getHash() == $this->request->getArgument('hash')) {
				return $this->redirect('cancelAnswer','Training','trainingsplatz',['answer' => $answer]);
			}
		}
		$this->addFlashMessage('Absage-Link ungültig', '', ContextualFeedbackSeverity::ERROR);
		if ($this->request->hasArgument('training')) {
			$training = $this->trainingRepository->findByUid($this->request->getArgument('training'));
			if ($training) {
				return $this->redirect('show','Training','trainingsplatz',['training' => $training]);
			}
		}
		return $this->redirect('list');
	}


	public function messageAction(Training $training): ResponseInterface {
		$this->view->assign('training', $training);
		return $this->htmlResponse();
  }
   
  
	public function deleteAnswerAction(Answer $answer): ResponseInterface {
		if ($answer->getTraining()->isNotification()) {
			$this->sendNotification($answer, 5);
		}
		$this->answerRepository->remove($answer);
		return $this->redirect('show','Training','trainingsplatz',['training' => $answer->getTraining()->getUid()]);
	}


	public function messageSendAction(): ResponseInterface {
		$arguments = $this->request->getArguments();
		if ($arguments['training']) {
			$training = $this->trainingRepository->findByUid(intval($arguments['training']));
			if ($training) {
				$answers = $this->answerRepository->findPerTraining($training);
				$userId = $this->context->getPropertyFromAspect('frontend.user', 'id');
				if (count($answers) > 0 and $userId > 0) {
					$user = $this->userRepository->findByUid($userId);
					$subject = trim($arguments['subject']);
					$content = trim($arguments['content']);
					if (strlen($subject) > 0 and strlen($content) > 0) {

						// send message
						$mailerInterface = GeneralUtility::makeInstance(Mailer::class);
						$mail = GeneralUtility::makeInstance(FluidEmail::class);
						$mail
							->from(new Address('donotreply@freizeitsportler.ch', $user->getName().' über freizeitsportler.ch'))
							->replyTo(new Address($user->getEmail(), $user->getName()))
							->subject($subject)
							->format(FluidEmail::FORMAT_BOTH)
							->embedFromPath($this->emailLogoUrl, 'logo')
							->setTemplate('Training')
							->assignMultiple([
								'logo' => '<img src="cid:logo" alt="freizeitsportler.ch-Logo" height="'.$this->emailLogoHeight.'" />',
								'headline' => $subject,
								'content' => $content,
								'contentHtml' => str_replace(chr(10),'<br />',$content),
								'note' => 'Diese Nachricht wurde mittels Formular auf freizeitsportler.ch erfasst und automatisch an alle Teilnehmer des Trainings "'.$training->getTitle().'" am '.$training->getTrainingDate()->format('d.m.Y').' versendet. Bitte nicht auf diese E-Mail antworten.'
							]);
				
						if (! $this->settings['emails']['suppress']) {
							if ($this->settings['emails']['sendOnlyTo']) {
								$mail->to(new Address($this->settings['emails']['sendOnlyTo']));
								$mailerInterface->send($mail);
							} else {
								$needCopyToUser = true;
								$needCopyToAuthor = true;
								$needCopyToCoach = true;
								if ($user == $training->getAuthor()) {
									$needCopyToAuthor = false;
								}
								if ($training->isGuided()) {
									if ($user == $training->getLeader() or $training->getAuthor() == $training->getLeader()) {
										$needCopyToCoach = false;
									}
								} else {
									$needCopyToCoach = false;
								}
								
								foreach ($answers as $answer) {
									if ($recipient = $answer->getFeuser()) {
										if ($recipient == $user) {
											$needCopyToUser = false;
										}
										if ($recipient == $training->getAuthor()) {
											$needCopyToAuthor = false;
										}
										if ($training->isGuided() and $training->getLeader()) {
											$needCopyToCoach = false;
										}
										if ($recipient->getEmail()) {
											$mail->to(new Address($recipient->getEmail(), $recipient->getName()));
											$mailerInterface->send($mail);
										}
									} else {
										if ($answer->getEmail()) {
											$mail->to(new Address($answer->getEmail(), $answer->getName()));
											$mailerInterface->send($mail);
										}
									}
								}
								if ($needCopyToUser) {
									if ($user->getEmail()) {
										$mail->to(new Address($user->getEmail(), $user->getName()));
										$mailerInterface->send($mail);
									}
								}
								if ($needCopyToAuthor) {								
									if ($training->getAuthor()->getEmail()) {
										$mail->to(new Address($training->getAuthor()->getEmail(), $training->getAuthor()->getName()));
										$mailerInterface->send($mail);
									}
								}
								if ($training->isGuided() and $needCopyToCoach) {								
									if ($training->getLeader()->getEmail()) {
										$mail->to(new Address($training->getLeader()->getEmail(), $training->getLeader()->getName()));
										$mailerInterface->send($mail);
									}
								}
							}							
						}
						
						$this->addFlashMessage('E-Mail wurde versendet, eine Kopie davon auch an dich','', ContextualFeedbackSeverity::OK);
						return $this->redirect('show','Training','trainingsplatz',array('training' => $training));
					} else {
						$this->addFlashMessage('Betreff und Inhalt dürfen nicht leer sein','', ContextualFeedbackSeverity::WARNING);
						return $this->redirect('message','Training','trainingsplatz',array('training' => $training));
					}
				}
			}
		}
		$this->addFlashMessage('E-Mail konnte nicht versendet werden','', ContextualFeedbackSeverity::WARNING);
		return $this->redirect('list');
	}


	public function evaluateAction(): ResponseInterface {
		$trainings = $this->trainingRepository->findPast();
		$answers = array ();
		foreach ($trainings as $training) {
			$answers[$training->getUid()] = $this->answerRepository->findPerTrainingCorrected($training);
		}
		$sports = $this->sportRepository->findAll();
		$this->view->assignMultiple([
			'trainings' => $trainings,
			'answers' => $answers,
			'sports' => $sports,
			'settings' => $this->settings,
		]);
		return $this->htmlResponse();
	}


	public function billingAction(Training $training): ResponseInterface {
		// Check if author of training did not write an answer to create automatically answer for that person
		// if training is guided, a SportCoach was leader who never participates the competition
		if ($training->isGuided() == false) {
			$result = $this->answerRepository->findPerTrainingAndPerson($training, $training->getAuthor());
			if (count($result) == 0) {
				$persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
				$newAnswer = new \DW\Trainingsplatz\Domain\Model\Answer();
				$newAnswer->setAuthor($training->getAuthor()->getName());
				$newAnswer->setFeuser($training->getAuthor());
				$newAnswer->setCreationDate($training->getCreationDate());
				$newAnswer->setChangeDate($training->getCreationDate());
				$newAnswer->setOwntraining(true);
				$newAnswer->setTitle('Eigenes Training');
				$newAnswer->setDescription('Automatisch erstellter Eintrag');
				$newAnswer->setTraining($training);
				$this->answerRepository->add($newAnswer);
				$persistenceManager->persistAll();
			}
		}
		
		$answers = $this->answerRepository->findPerTraining($training);
		$correctedAnswers = $this->answerRepository->findPerTrainingCorrected($training);
		$this->view->assignMultiple([
			'training' => $training,
			'answers' => $answers,
			'correctedAnswers' => $correctedAnswers,
			'break' => intval(ceil(count($answers)/2)),
		]);
		return $this->htmlResponse();
	}


	public function discountAction(): ResponseInterface {
		$finish = true;
		$arguments = $this->request->getArguments();
		foreach ($arguments['answer'] as $id => $value) {
			$answer = $this->answerRepository->findByUid($id);
			if ($answer) {
				$answer->setPoints($value['points']);
				$answer->setCompensation($value['compensation']);
				$this->answerRepository->update($answer);
				if ($value['points'] == 0 or $value['compensation'] == 0) {
					$finish = false;
				}
			}
		}
		if ($finish) {
			return $this->redirect('finalize','Training','trainingsplatz',array('training' => $arguments['training']));
		} else {
			$this->addFlashMessage('Punkte für dieses Training wurden gespeichert');
			return $this->redirect('evaluate');
		}
	}


	public function finalizeAction(Training $training): ResponseInterface {
		$this->view->assign('training', $training);
		return $this->htmlResponse();
	}


	public function closeAction(Training $training): ResponseInterface {
		$training->setClosed(true);
		$this->trainingRepository->update($training);
		$this->addFlashMessage('Training wurde abgeschlossen');
		return $this->redirect('evaluate');
	}


	/**
	 * action ranking (Sportler des Jahres, all members)
	 */
	public function rankingAction(): ResponseInterface {
		if ($this->request->hasArgument('year')) {
			$year = intval($this->request->getArgument('year'));
			if ($year < 2016 or $year > date('Y')+1) {
				$year = NULL;
			}
		}
		$arguments = $this->request->getArguments();

		$limit = $this->settings['limitation'];
		$dates = $this->getRankingDateRange($year);
		$answers = $this->answerRepository->findRated($dates['start'], $dates['end']);
		$extra = $this->userRepository->findContestExtraPoints();
		
		$userData = array();
		$points = array();
		$ranks = array();
		foreach ($answers as $answer) {
			if ($answer->getFeuser()) {
				$points[$answer->getFeuser()->getUid()]++;
				$userData[$answer->getFeuser()->getUid()] = $answer->getFeuser();
			}
		}
		foreach ($extra as $add) {
			$points[$add->getUid()]+=$add->getTxTrainingsplatzContestExtra();
			$userData[$add->getUid()] = $add;
		}
		arsort($points, SORT_NUMERIC);
		
		foreach ($points as $userId => $point) {
			$user = $this->userRepository->findByUid($userId);
			if ($user->getTxTrainingsplatzContest()) {
				$ranks[] = array('user' => $userData[$userId], 'points' => $point);
			}
		}
		if ($limit > 0) {
			$ranksCut = array_chunk($ranks, $limit, 1);
			$ranks = $ranksCut[0];
		}

		for ($i=2016; $i<=date('Y'); $i++) {
			$navigation[] = $i;
		}
		if (date('m') == 12) {
			$navigation[] = date('Y')+1;
		}

		$this->view->assignMultiple([
			'answers' => $answers,
			'ranks' => $ranks,
			'year' => $year,
			'startDate' => $dates['start'],
			'endDate' => $dates['end'],
			'limit' => $limit,
			'extra' => $extra,
			'navigation' => $navigation,
		]);
		return $this->htmlResponse();
	}

	/**
	 * action userCompetition (Sportler des Jahres, single member)
	 */
	public function userCompetitionAction(): ResponseInterface {
		$dates = $this->getRankingDateRange();
		$feuserId = $this->context->getPropertyFromAspect('frontend.user', 'id');
		if ($feuserId > 0) {
			$answers = $this->answerRepository->findEvaluatedByUser($feuserId, $dates['start']);
			$total = $this->answerRepository->countPointsByUser($feuserId, $dates['start']);
			$extra = $this->userRepository->findByUid($feuserId)->getTxTrainingsplatzContestExtra();
			$total += $extra;
		}

		$this->view->assignMultiple([
			'answers' => $answers,
			'total' => $total,
			'extra' => $extra,
			'startDate' => $dates['start'],
		]);
		return $this->htmlResponse();
	}


	public function participationAction(): ResponseInterface {
		if ($this->request->hasArgument('year')) {
			$year = $this->request->getArgument('year');
		}
		if ($year < 2020 or $year > date('Y')+1) {
			$year = date('Y');
		}
		for ($i=2020; $i<=date('Y'); $i++) {
			$navigation[] = $i;
		}
		if (date('m') == 12) {
			$navigation[] = date('Y')+1;
		}

		$dates = $this->getRankingDateRange($year);
		$compensations = $this->answerRepository->findCompensated($dates['start']);
		foreach ($compensations as $comp) {
			$user = $comp->getTraining()->getAuthor();
			if ($comp->getTraining()->isGuided() and $comp->getTraining()->getLeader()) {
				$user = $comp->getTraining()->getLeader();
			}
			if ($user) {
				$results[$user->getUid()]['user'] = $user;
				$results[$user->getUid()]['trainings'][] = $comp->getTraining();
				$results[$user->getUid()]['answers'][] = $comp;
			}
		}
		if ($results) {
			foreach ($results as $uid => $result) {
				$trainings = array_unique($result['trainings']);
				$list[$uid]['trainings'] = $trainings;
				$list[$uid]['answers'] = $result['answers'];
				$list[$uid]['user'] = $result['user'];
				$sortTrainings[$uid] = count($trainings);
				$sortAnswers[$uid] = count($result['answers']);
			}
			$ok = array_multisort($sortTrainings, SORT_DESC, SORT_NUMERIC, $sortAnswers, SORT_DESC, SORT_NUMERIC, $list);
		}

		$this->view->assignMultiple([
			'list' => $list,
			'startDate' => $dates['start'],
			'year' => $year,
			'ok' => $ok,
			'navigation' => $navigation,
		]);
		return $this->htmlResponse();
	}


	public function userParticipationAction(): ResponseInterface {
		if ($this->request->hasArgument('year')) {
			$year = $this->request->getArgument('year');
		}
		if ($year < 2020 or $year > date('Y')+1) {
			$year = date('Y');
		}
		$dates = $this->getRankingDateRange($year);
		if ($this->request->hasArgument('user')) {
			$userId = $this->request->getArgument('user');
			$user = $this->userRepository->findByUid($userId);
		}
		if (! $user) {
			$userId = $this->context->getPropertyFromAspect('frontend.user', 'id');
			$user = $this->userRepository->findByUid($userId);
		}
		if ($user) {
			$compensations = $this->answerRepository->findCompensatedByTrainer($user, $dates['start']);
			foreach ($compensations as $comp) {
				$training = $comp->getTraining();
				if ($training->getAuthor() == $user or ($training->isGuided() and $training->getLeader() == $user)) {
					$list[$training->getUid()]['training'] = $training;
					$list[$training->getUid()]['answers'][] = $comp;
				}
			}
			$countTraining = 0;
			$countAnswers = 0;
			if ($list) {
				foreach ($list as $line) {
					$countTraining++;
					$countAnswers += count($line['answers']);
				}
			}
			$count = ['trainings' => $countTraining, 'answers' => $countAnswers];
		}
		
		$this->view->assignMultiple([
			'user' => $user,
			'list' => $list,
			'startDate' => $dates['start'],
			'endDate' => $dates['end'],
			'count' => $count,
		]);
		return $this->htmlResponse();
	}


	public function analysisAction(): ResponseInterface {
		if ($this->request->hasArgument('year')) {
			$year = $this->request->getArgument('year');
		}
		if ($year < 2016 or $year > date('Y')) {
			$year = date('Y');
		}
		
		$trainings = $this->trainingRepository->findPerYear($year);
		$trainingsNotCancelled = $this->trainingRepository->findPerYear($year, false);
		
		for ($i=2016; $i<=date('Y'); $i++) {
			$navigation[] = $i;
		}
		
		$this->view->assignMultiple([
			'trainings' => $trainings,
			'trainingsNotCancelled' => $trainingsNotCancelled,
			'year' => $year,
			'navigation' => $navigation,
		]);
		return $this->htmlResponse();
	}


	public function reportsAction(): ResponseInterface {
		if ($this->request->hasArgument('year')) {
			$year = $this->request->getArgument('year');
		}
		if ($year < 2016 or $year > date('Y')) {
			$year = date('Y');
		}
		
		$demand = new \GeorgRinger\News\Domain\Model\Dto\NewsDemand;
		$demand->setDateField('datetime');
		$demand->setYear($year);
		$demand->setCategories(['Bericht']);
		$demand->setStoragePage(98);
		$newsRepository = new \GeorgRinger\News\Domain\Repository\NewsRepository;
		$reports = $newsRepository->findDemanded($demand);
		
		for ($i=2016; $i<=date('Y'); $i++) {
			$navigation[] = $i;
		}
		
		$this->view->assignMultiple([
			'reports' => $reports,
			'year' => $year,
			'navigation' => $navigation,
		]);
		return $this->htmlResponse();
	}


	/**
	 * sendNotification
	 *
	 * $reason => Reason code: 1 = new answer, 2 = modification, 3 = cancellation, 4 = re-activation
	 */
	protected function sendNotification (Answer $answer, int $reason) {
		if ($this->settings['emails']['suppress']) {
			return false;
		}
		if ($answer->getFeuser()) {
			$writerName = $answer->getFeuser()->getName();
		} else {
			$writerName = $answer->getAuthor();
		}
		if ($answer->getTraining()->isGuided()) {
			$leader = $answer->getTraining()->getLeader();
		} else {
			$leader = $answer->getTraining()->getAuthor();
		}
		$mail = GeneralUtility::makeInstance(FluidEmail::class);
		if ($mail and $leader->getEmail() and $reason>0 and $reason<=4) {
			switch ($reason) {
				case 1:
					$mailtext = 'Hoi '.$leader->getFirstName().chr(10).chr(10).$writerName.' hat sich für dein Training "'.$answer->getTraining()->getTitle().'" vom '.$answer->getTraining()->getTrainingDate()->format('j.m.Y').' angemeldet:'.chr(10).chr(10).$answer->getTitle().chr(10).$answer->getDescription();
					$subject = 'Neuer Eintrag auf dein Training';
					break;
				case 2:
					$mailtext = 'Hoi '.$leader->getFirstName().chr(10).chr(10).$writerName.' hat den Eintrag für dein Training "'.$answer->getTraining()->getTitle().'" vom '.$answer->getTraining()->getTrainingDate()->format('j.m.Y').' geändert:'.chr(10).chr(10).$answer->getTitle().chr(10).$answer->getDescription();
					$subject = 'Eintrag in deinem Training geändert';
					break;
				case 3:
					$mailtext = 'Hoi '.$leader->getFirstName().chr(10).chr(10).$writerName.' meldet sich von deinem Training "'.$answer->getTraining()->getTitle().'" vom '.$answer->getTraining()->getTrainingDate()->format('j.m.Y').' ab.';
					$subject = 'Abmeldung von deinem Training';
					break;
				case 4:
					$mailtext = 'Hoi '.$leader->getFirstName().chr(10).chr(10).$writerName.' meldet sich für dein Training "'.$answer->getTraining()->getTitle().'" vom '.$answer->getTraining()->getTrainingDate()->format('j.m.Y').' wieder an.';
					$subject = 'Erneute Anmeldung auf dein Training';
					break;
				case 5:
					if ($answer->getFeuser()) {
						$participant = $answer->getFeuser->getFirstname().' '.substr($answer->getFeuser->getLastname(),0,1).'.';
					} else {
						$participant = $answer->getAuthor();
					}
					$mailtext = 'Hoi '.$leader->getFirstName().chr(10).chr(10).'Ein Administrator von freizeitsportler.ch hat den (resp. einen mehrfachen) Eintrag von '.$participant.' für dein Training "'.$answer->getTraining()->getTitle().'" vom '.$answer->getTraining()->getTrainingDate()->format('j.m.Y').' gelöscht.';
					$subject = 'Eintrag in deinem Training geändert';
					break;
			}
			if ($this->settings['emails']['sendOnlyTo']) {
				$mail->to(new Address($this->settings['emails']['sendOnlyTo'], $leader->getName()));
			} else {
				$mail->to(new Address($leader->getEmail(), $leader->getName()));
			}
			$mail
				->from(new Address('donotreply@freizeitsportler.ch', 'freizeitsportler.ch'))
				->format(FluidEmail::FORMAT_BOTH)
				->subject($subject)
				->embedFromPath($this->emailLogoUrl, 'logo')
				->setTemplate('Training')
				->assignMultiple([
					'logo' => '<img src="cid:logo" alt="freizeitsportler.ch-Logo" height="'.$this->emailLogoHeight.'" />',
					'headline' => $subject,
					'content' => $mailtext,
					'contentHtml' => str_replace(chr(10),'<br />',$mailtext),
					'note' => 'Dies ist eine automatisch erstellte Nachricht. Du erhältst sie, weil du dieses Training ausgeschrieben und die Option aktiviert hast, über Antworten informiert zu werden. Bitte nicht auf diese E-Mail antworten.'
				]);
			$mailerInterface = GeneralUtility::makeInstance(Mailer::class);
			return $mailerInterface->send($mail);

		} else {
			return false;
		}
	}


	protected function adjustYear (\DateTime $date) {
		if ($date->format('Y') < 2000) {
			$year = 2000+$date->format('y');
		} else {
			$year = $date->format('Y');
		}
		return new \DateTime($year.'-'.$date->format('m-d').' 00:00:00',new \DateTimeZone('UTC'));
	}


	protected function getSeriesDates (Training $training) {
		$dates = [];
		if ($training->getSeries()) {
			$start = $training->getSeriesStart()->format('U');
			$end = $training->getSeriesEnd()->format('U');
			if ($start <= $end) {
				$wday = $training->getSeriesWeekday();
				if ($wday > 6) { $wday = $wday-7; }
				switch ((int)$training->getSeriesPeriod()) {
					case 0:
						// weekly dates
						$dates[0] = $start;
						while (date('w',$dates[0]) != $wday) {
							$dates[0] = strtotime('+1 days', $dates[0]);
						}
						if ($dates[0] <= $end) {
							$lastDate = $dates[0];
							$newDate = strtotime('+1 weeks', $lastDate);
							while ($newDate <= $end and count($dates) <= 25) {
								$dates[] = $newDate;
								$lastDate = $newDate;
								$newDate = strtotime('+1 weeks', $lastDate);
							}
						} else {
							$dates = [];
						}
						break;
					case 1:
						// monthly dates
						$weekNo = $training->getSeriesNumber();
						if ($weekNo < 0 or $weekNo > 4) { $weekNo = 0; }
						if ($weekNo != 4) {
							// first, second, third or fourth week per month, but not last week per month
							$newDate = $start;
							$minDay = $weekNo * 7 + 1;
							$maxDay = ($weekNo+1) * 7;
							while (date('w',$newDate) != $wday or date('j',$newDate) < $minDay or date('j',$newDate) > $maxDay) {
								$newDate = strtotime('+1 days', $newDate);
							}
							while ($newDate <= $end and count($dates) <= 24) {
								$dates[] = $newDate;
								$newDate = strtotime('+4 weeks', $newDate);
								if (date('j',$newDate) < $minDay or date('j',$newDate) > $maxDay) {
									$newDate = strtotime('+1 weeks', $newDate);
								}
							}
						} else {
							// last week per month
							$newDate = $start;
							$minDay = date('t',$newDate)-6;
							while (date('w',$newDate) != $wday or date('j',$newDate) < $minDay) {
								$newDate = strtotime('+1 days',$newDate);
								$minDay = date('t',$newDate)-6;
							}
							while ($newDate <= $end and count($dates) <= 24) {
								$dates[] = $newDate;
								$newDate = strtotime ('+4 weeks', $newDate);
								$minDay = date('t',$newDate)-6;
								if (date('j',$newDate) < $minDay) {
									$newDate = strtotime ('+1 weeks', $newDate);
								}
							}
						}
						break;
					case 2:
						// daily dates
						$dates[0] = $start;
						if ($dates[0] <= $end) {
							$lastDate = $dates[0];
							$newDate = strtotime('+1 day', $lastDate);
							while ($newDate <= $end and count($dates) <= 24) {
								$dates[] = $newDate;
								$lastDate = $newDate;
								$newDate = strtotime('+1 day', $lastDate);
							}
						} else {
							$dates = [];
						}
						break;
				}
			}
			$timezone = new \DateTimeZone('UTC');
			if (count($dates) > 0) {
				foreach ($dates as $date) {
					$list[] = new \DateTime (date('Y-m-d',$date), $timezone);
				}
				return $list;
			} else {
				return [];
			}
		}
		return [];
	}

	/**
	 * getRankingDateRange
	 *
     * $year => Main year of the season, the start date is always in the previous year
	 */
	protected function getRankingDateRange (int $year = NULL) {
		if ($this->settings['competitionStart']) {
			$today = new \DateTime('today', $this->timezone);
			$startDates = explode(',',$this->settings['competitionStart']);
			$startDate = new \DateTime(array_pop($startDates), $this->timezone);
			while ($startDate->format('Ymd') > $today->format('Ymd')) {
				if (count($startDates)>0) {
					$recentDate = array_pop($startDates);
					$recentDateParts = explode('.',$recentDate);
					$startDate->setDate($recentDateParts[2],$recentDateParts[1],$recentDateParts[0]);
				} else {
					// no date found in the past
					return ['start' => NULL, 'end' => NULL];
				}
			}
			// found start date
			if ($year !== NULL) {
				if ($year > $startDate->format('Y')+1) {
					// requested year is in future
					return ['start' => NULL, 'end' => NULL];
				} elseif ($year == $startDate->format('Y')+1) {
					// requested year is current season year
					return ['start' => $startDate, 'end' => NULL];
				} else {
					while ($startDate->format('Y') >= $year) {
						if (count($startDates)>0) {
							$recentDate = array_pop($startDates);
							$recentDateParts = explode('.',$recentDate);
							$endDate = clone $startDate;
							$startDate->setDate($recentDateParts[2],$recentDateParts[1],$recentDateParts[0]);
						} else {
							// no date found in the past
							return ['start' => NULL, 'end' => NULL];
						}
					}
					// return start date and and date of a past season
					return ['start' => $startDate, 'end' => $endDate];
				}
			} else {
				// if no year is set, only return start date
				return ['start' => $startDate, 'end' => NULL];
			}
		} else {
			// no vales in extension constants
			return ['start' => NULL, 'end' => NULL];
		}
	}
	
	protected function isTrainingOutdated (Training $training) {
		$yesterday = new \DateTime('yesterday');
		if ($training->getTrainingDate() <= $yesterday) {
			return true;
		} else {
			return false;
		}
	}

}