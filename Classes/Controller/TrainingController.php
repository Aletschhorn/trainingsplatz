<?php
namespace DW\Trainingsplatz\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use DW\Trainingsplatz\Domain\Repository\TrainingRepository;
use DW\Trainingsplatz\Domain\Repository\AnswerRepository;
use DW\Trainingsplatz\Domain\Repository\SportRepository;
use DW\Trainingsplatz\Domain\Repository\IntensityRepository;
use DW\Trainingsplatz\Domain\Repository\MapRepository;
use DW\Trainingsplatz\Domain\Repository\InfomailRepository;
use In2code\Femanager\Domain\Repository\UserRepository;
use GeorgRinger\News\Domain\Repository\NewsRepository;

/**
 * TrainingController
 */
class TrainingController extends ActionController {

	/**
	 * trainingRepository
	 *
	 * @var TrainingRepository
	 */
	protected $trainingRepository;

	/**
	 * answerRepository
	 *
	 * @var AnswerRepository
	 */
	protected $answerRepository;

	/**
	 * sportRepository
	 *
	 * @var SportRepository
	 */
	protected $sportRepository;
	
	/**
	 * intensityRepository
	 *
	 * @var IntensityRepository
	 */
	protected $intensityRepository;

	/**
	 * mapRepository
	 *
	 * @var MapRepository
	 */
	protected $mapRepository;
	
	/**
	 * infomailRepository
	 *
	 * @var InfomailRepository
	 */
	protected $infomailRepository;
	
	/**
	 * userRepository
	 *
	 * @var UserRepository
	 */
	protected $userRepository;
	
	/**
	 * newsRepository
	 *
     * @var NewsRepository
     */
    protected $newsRepository;
	
	/*
	* @var \DateTimeZone
	*/
	protected $timezone;

	/**
	 * @param TrainingRepository $trainingRepository
	 * @param AnswerRepository $answerRepository
	 * @param SportRepository $sportRepository
	 * @param IntensityRepository $intensityRepository
	 * @param MapRepository $mapRepository
	 * @param InfomailRepository $infomailRepository
	 * @param UserRepository $userRepository
	 * @param NewsRepository $newsRepository
	 */
	public function __construct (
			TrainingRepository $trainingRepository,
			AnswerRepository $answerRepository,
			SportRepository $sportRepository,
			IntensityRepository $intensityRepository,
			MapRepository $mapRepository,
			InfomailRepository $infomailRepository,
			UserRepository $userRepository,
			NewsRepository $newsRepository
	) {
		$this->trainingRepository = $trainingRepository;
		$this->answerRepository = $answerRepository;
		$this->sportRepository = $sportRepository;
		$this->intensityRepository = $intensityRepository;
		$this->mapRepository = $mapRepository;
		$this->infomailRepository = $infomailRepository;
		$this->userRepository = $userRepository;
		$this->newsRepository = $newsRepository;
		$this->timezone = new \DateTimeZone('Europe/Zurich');
	}
	
	/**
	 * action short
	 *
	 * @return void
	 */
	public function shortAction() {
		$limit = intval($this->settings['limitation']);
		if ($this->request->hasArgument('filter')) { 
			$filter = intval($this->request->getArgument('filter')); 
		} else {
			$filter = 0;
		}
		$GLOBALS['TSFE']->fe_user->setKey('ses','tpFilter',$filter);
		if ($filter > 0) {
			$trainings = $this->trainingRepository->findFutureFiltered($filter, $limit, 0);
		} else {
			$trainings = $this->trainingRepository->findFuture($limit, 0);
		}
		$answers = array ();
		foreach ($trainings as $training) {
			$answers[$training->getUid()] = $this->answerRepository->findPerTrainingCorrected($training);
		}
		$sports = $this->sportRepository->findAll();
		$this->view->assignMultiple(array(
			'trainings' => $trainings,
			'answers' => $answers,
			'sports' => $sports,
			'filter' => $filter,
			'limit' => $limit,
			'settings' => $this->settings,
		));
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		if ($this->request->hasArgument('filter')) { 
			$filter = intval($this->request->getArgument('filter')); 
		} else {
			$filter = 0;
		}
		$GLOBALS['TSFE']->fe_user->setKey('ses','tpFilter',$filter);
		if ($filter > 0) {
			$trainings = $this->trainingRepository->findFutureFiltered($filter);
		} else {
			$trainings = $this->trainingRepository->findFuture();
		}
		$answers = array ();
		foreach ($trainings as $training) {
			$answers[$training->getUid()] = $this->answerRepository->findPerTrainingCorrected($training);
		}
		$sports = $this->sportRepository->findAll();
		$this->view->assignMultiple(array(
			'trainings' => $trainings,
			'answers' => $answers,
			'sports' => $sports,
			'filter' => $filter,
			'settings' => $this->settings,
		));
	}

	/**
	 * action show
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @return void
	 */
	public function showAction(\DW\Trainingsplatz\Domain\Model\Training $training) {
		$filter = intval($GLOBALS['TSFE']->fe_user->getKey('ses','tpFilter'));
		$answers = $this->answerRepository->findPerTraining($training);
		$countPublicAnswers = $this->answerRepository->countPerTrainingAndNotMember($training);
		$userId = $GLOBALS['TSFE']->fe_user->user['uid'];
		$newAnswer = new \DW\Trainingsplatz\Domain\Model\Answer();
		$newAnswer->setTitle('Bin dabei');
		$newAnswer->setDescription('Ich mache bei diesem Training mit.');
		if ($userId > 0) {
			$feuser = $this->userRepository->findByUid($userId);
			$userAnswer = $this->answerRepository->findByTrainingAndUser($training,$userId);
		}
		$correctedAnswers = $this->answerRepository->findPerTrainingCorrected($training);

		if ($training->getMap() or $training->getStartOption() > 0) {
			$js = '<script src="//maps.googleapis.com/maps/api/js?key='.$this->settings['googleMapsKey'].'" type="text/javascript"></script>'.chr(10).
			'<script src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/elabel.js" type="text/javascript"></script>'.chr(10).
			'<script type="text/javascript">'.chr(10).
			'const TPstreckenfarbe = \''.$this->settings['routeColor'].'\'; '.chr(10).
			'const TPstreckenbreite = '.$this->settings['routeWidth'].'; '.chr(10).
			'const TPtpicon = {url: \'/typo3conf/ext/trainingsplatz/Resources/Public/Icons/meetingpoint.png\', size: new google.maps.Size('.$this->settings['meetingpointIconSize'].'), origin: new google.maps.Point(0,0), anchor: new google.maps.Point('.$this->settings['meetingpointIconAnchor'].')}; '.chr(10).
			'</script>'.chr(10).
			'<script type="text/javascript" src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/mapcontrol_newtraining.js"></script>';
		    $this->response->addAdditionalHeaderData($js);
		}

		$this->view->assignMultiple(array(
			'training' => $training,
			'answers' => $answers,
			'countPublicAnswers' => $countPublicAnswers,
			'newAnswer' => $newAnswer,
			'feuser' => $feuser,
			'userAnswer' => $userAnswer[0],
			'correctedAnswers' => $correctedAnswers,
			'filter' => $filter,
			'settings' => $this->settings,
		));
	}


	/**
	 * action single
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @return void
	 */
	public function singleAction(\DW\Trainingsplatz\Domain\Model\Training $training) {
		$answers = $this->answerRepository->findPerTraining($training);
		$correctedAnswers = $this->answerRepository->findPerTrainingCorrected($training);

		if ($training->getMap() or $training->getStartOption() > 0) {
			$js = '<script src="//maps.googleapis.com/maps/api/js?key='.$this->settings['googleMapsKey'].'" type="text/javascript"></script>'.chr(10).
			'<script src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/elabel.js" type="text/javascript"></script>'.chr(10).
			'<script type="text/javascript">'.chr(10).
			'const TPstreckenfarbe = \''.$this->settings['routeColor'].'\'; '.chr(10).
			'const TPstreckenbreite = '.$this->settings['routeWidth'].'; '.chr(10).
			'const TPtpicon = {url: \'/typo3conf/ext/trainingsplatz/Resources/Public/Icons/meetingpoint.png\', size: new google.maps.Size('.$this->settings['meetingpointIconSize'].'), origin: new google.maps.Point(0,0), anchor: new google.maps.Point('.$this->settings['meetingpointIconAnchor'].')}; '.chr(10).
			'</script>'.chr(10).
			'<script type="text/javascript" src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/mapcontrol_newtraining.js"></script>';
		    $this->response->addAdditionalHeaderData($js);
		}

		$this->view->assignMultiple(array(
			'training' => $training,
			'answers' => $answers,
			'correctedAnswers' => $correctedAnswers,
			'settings' => $this->settings,
		));
	}


	/**
	 * @return \TYPO3\CMS\Error\Message
	 */
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

	/**
	 * action new
	 *
	 * @return void
	 */
	public function newAction() {
		$sports = $this->sportRepository->findAll();
		$intensities = $this->intensityRepository->findAll();
		$coaches = $this->userRepository->findByUsergroup($this->settings['usergroupSportcoach']);
		$this->view->assignMultiple(array(
			'training' => new \DW\Trainingsplatz\Domain\Model\Training,
			'settings' => $this->settings
		));
	}

	/**
	* initializeCreateAction
	*
	* @return void
	*/
	public function initializeCreateAction() {
		if (isset($this->arguments['training'])) {
			$this->arguments['training']->getPropertyMappingConfiguration()->forProperty('trainingDate')->setTypeConverterOption('TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			$this->arguments['training']->getPropertyMappingConfiguration()->forProperty('seriesStart')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			$this->arguments['training']->getPropertyMappingConfiguration()->forProperty('seriesEnd')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
		}
	}

	/**
	 * action create
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @return void
	 */
	public function createAction(\DW\Trainingsplatz\Domain\Model\Training $training) {
		$now = new \DateTime();
		$training->setCreationDate($now);
		$user = $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
		$training->setAuthor($user);
		if (in_array('TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup:'.$this->settings['usergroupSportcoach'],$user->getUsergroup()->toArray())) {
			$training->setLeader($user);
		}
		
		$today = new \DateTime('today');
		$failue = false;
		if ($training->getSeries() == 0) {
			if ($training->getTrainingDate() == NULL) {
				$this->addFlashMessage('Trainingsdatum ist ungültig', '', AbstractMessage::ERROR);
				$failure = true;
			} else {
				$training->setTrainingDate($this->adjustYear($training->getTrainingDate()));
				if ($training->getTrainingDate()->format('U') < $today->format('U')) {
					$this->addFlashMessage('Trainingsdatum liegt in der Vergangenheit', '', AbstractMessage::ERROR);
					$failure = true;
				}
			}
		} else {
			if ($training->getSeriesStart() == NULL or $training->getSeriesEnd() == NULL) {
				$this->addFlashMessage('Trainingsdaten der Serie sind ungültig', '', AbstractMessage::ERROR);
				$failure = true;
			} else {
				$training->setSeriesStart($this->adjustYear($training->getSeriesStart()));
				$training->setSeriesEnd($this->adjustYear($training->getSeriesEnd()));
				if ($training->getSeriesStart()->format('U') < $today->format('U')) {
					$this->addFlashMessage('Startdatum der Serie liegt in der Vergangenheit', '', AbstractMessage::ERROR);
					$failure = true;
				} elseif ($training->getSeriesStart()->format('U') > $training->getSeriesEnd()->format('U')) {
					$this->addFlashMessage('Startdatum ist nach dem Enddatum der Serie', '', AbstractMessage::ERROR);
					$failure = true;
				} else {
					$seriesDates = $this->getSeriesDates($training);
					if (count($seriesDates) == 0) {
						$this->addFlashMessage('Kein Trainingsdatum zwischen Start- und Enddatum möglich', '', AbstractMessage::ERROR);
						$failure = true;
					} else {
						foreach ($seriesDates as $seriesDate) {
							$seriesDatesFormated[] = date('d.m.Y',$seriesDate->format('U'));
						}
						$message = 'Trainings werden für folgende Daten erstellt: '.implode(', ',$seriesDatesFormated);
						$this->addFlashMessage($message, '', AbstractMessage::INFO);
						$training->setTrainingDate($seriesDates[0]);
					}
				}
			}
		}

		$this->trainingRepository->add($training);
		$persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
		$persistenceManager->persistAll();

		if ($failure) {
			$this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => 1));
		} else {
			$this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => 2));
		}
	}

	/**
	 * action edit
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @param integer $step
	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("training")	 
	 * @return void
	 */
	public function editAction(\DW\Trainingsplatz\Domain\Model\Training $training, $step=2) {
		if ($step >= 3) {
			$js = '<script src="//maps.googleapis.com/maps/api/js?key='.$this->settings['googleMapsKey'].'" type="text/javascript"></script>'.chr(10).
			'<script src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/elabel.js" type="text/javascript"></script>'.chr(10).
			'<script type="text/javascript">'.chr(10).
			'const TPstreckenfarbe = \''.$this->settings['routeColor'].'\'; '.chr(10).
			'const TPstreckenbreite = '.$this->settings['routeWidth'].'; '.chr(10).
			'const TPtpicon = {url: \'/typo3conf/ext/trainingsplatz/Resources/Public/Icons/meetingpoint.png\', size: new google.maps.Size('.$this->settings['meetingpointIconSize'].'), origin: new google.maps.Point(0,0), anchor: new google.maps.Point('.$this->settings['meetingpointIconAnchor'].')}; '.chr(10).
			'</script>'.chr(10).
			'<script type="text/javascript" src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/mapcontrol_newtraining.js"></script>';
		    $this->response->addAdditionalHeaderData($js);
		}
		
		if ($training->getSeries() == 0) {
			$seriesDates = NULL;
		} else {
			$seriesDates = $this->getSeriesDates($training);
		}
		
		$this->view->assignMultiple(array(
			'training' => $training,
			'intensities' => $this->intensityRepository->findAll(),
			'maps' => $this->mapRepository->findPublic(),
			'sports' => $this->sportRepository->findAll(),
			'sportcoaches' => $this->userRepository->findByUsergroup($this->settings['usergroupSportcoach']),
			'members' =>  $this->userRepository->findByUsergroup($this->settings['usergroupMember']),
			'seriesDates' => $seriesDates,
			'step' => $step,
			'settings' => $this->settings,
		));
	}

	/**
	* initializeUpdateAction
	*
	* @return void
	*/
	public function initializeUpdateAction() {
		if (isset($this->arguments['training'])) {
			$this->arguments['training']->getPropertyMappingConfiguration()->forProperty('trainingDate')->setTypeConverterOption('TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			$this->arguments['training']->getPropertyMappingConfiguration()->forProperty('seriesStart')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			$this->arguments['training']->getPropertyMappingConfiguration()->forProperty('seriesEnd')->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter', \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
		}
	}

	/**
	 * action update
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @return void
	 */
	public function updateAction(\DW\Trainingsplatz\Domain\Model\Training $training) {
		$now = new \DateTime();
		if ($training->isPublic()) {
			$training->setLastChange($now);
		} else {
			$training->setCreationDate($now);
		}
		$step = $training->getStep();
		$today = new \DateTime('today');
		
		// Validate some fields
		if ($step == 1) {
			if ($training->getSeries() == 0) {
				if ($training->getTrainingDate() == NULL) {
					$this->addFlashMessage('Trainingsdatum ist ungültig', '', AbstractMessage::ERROR);
					$this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
				} else {
					$training->setTrainingDate($this->adjustYear($training->getTrainingDate()));
					if ($training->getTrainingDate()->format('U') < $today->format('U')) {
						$this->addFlashMessage('Trainingsdatum liegt in der Vergangenheit', '', AbstractMessage::ERROR);
						$this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
					}
				}
			} else {
				if ($training->getSeriesStart() == NULL or $training->getSeriesEnd() == NULL) {
					$this->addFlashMessage('Trainingsdaten der Serie sind ungültig', '', AbstractMessage::ERROR);
					$this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
				} else {
					$training->setSeriesStart($this->adjustYear($training->getSeriesStart()));
					$training->setSeriesEnd($this->adjustYear($training->getSeriesEnd()));
					if ($training->getSeriesStart()->format('U') < $today->format('U')) {
						$this->addFlashMessage('Startdatum der Serie liegt in der Vergangenheit', '', AbstractMessage::ERROR);
						$this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
					} elseif ($training->getSeriesStart()->format('U') > $training->getSeriesEnd()->format('U')) {
						$this->addFlashMessage('Startdatum ist nach dem Enddatum der Serie', '', AbstractMessage::ERROR);
						$this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
					} else {
						$seriesDates = $this->getSeriesDates($training);
						if (count($seriesDates) == 0) {
							$this->addFlashMessage('Kein Trainingsdatum zwischen Start- und Enddatum möglich', '', AbstractMessage::ERROR);
							$this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
						} else {
							foreach ($seriesDates as $seriesDate) {
								$seriesDatesFormated[] = date('d.m.Y',$seriesDate->format('U'));
							}
							$message = 'Trainings werden für folgende Daten erstellt: '.implode(', ',$seriesDatesFormated);
							$this->addFlashMessage($message, '', AbstractMessage::INFO);
							$training->setTrainingDate($seriesDates[0]);
						}
					}
				}
			}
		}

		if ($step == 2) {
			if (! $training->getTitle() or ! $training->getDescription()) {
				$this->addFlashMessage('Titel und Beschreibung müssen ausgefüllt sein', '', AbstractMessage::ERROR);
				$this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
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
						if ($value = $training->getMap()) { $newTraining->setMap($value); }
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
			
			if ($this->settings['deleteCachePid']) {
				$this->clearSpecificCache($this->settings['deleteCachePid']);
			}
			
			// InfoMail preparation
			if ($training->isInfomail()) {
				if ($training->isGuided()) { 
					$trainer = $training->getLeader(); 
				} else { 
					$trainer = $training->getAuthor(); 
				}
				$mailtext = 'Hoi Freizeitsportler'.chr(10).chr(10).'Am '.$training->getTrainingDate()->format('j.m.y').' findet ein Training statt, das dich interessieren könnte:'.chr(10).chr(10).'Titel: '.$training->getTitle().chr(10).'Datum: '.$training->getTrainingDate()->format('j.m.y').chr(10).'Sportart: '.$training->getSport()->getTitle().chr(10).'Intensität: '.$training->getIntensity()->getTitle().chr(10).'Verantwortlich: '.$trainer->getName().chr(10).'Mehr Infos: https://www.freizeitsportler.ch/direkt/training/show/'.$training->getUid().chr(10).chr(10).'Sportliche Grüsse'.chr(10).'freizeitsportler.ch'.chr(10).chr(10).'----------'.chr(10).'Das ist ein automatisch generiertes E-Mail. Bitte nicht darauf antworten.';
				$existing = $this->infomailRepository->findPerTrainingAndStatus($training,0);
				if (count($existing) == 0) {
					$infomail = new \DW\Trainingsplatz\Domain\Model\Infomail();
					$new = true;
				} else {
					$infomail = $existing[0];
					$new = false;
				}
				$infomail->setTraining($training);
				$infomail->setMailSubject($training->getTitle().' am '.$training->getTrainingDate()->format('j.m.y'));
				$infomail->setMailBody($mailtext);
				if ($new) {
					$infomail->setStatus(0);
					$infomail->setStatusDate($today);
					$this->infomailRepository->add($infomail);
				} else {
					$this->infomailRepository->update($infomail);
				}
					
				// Send notification to admins
				if (! $this->settings['suppressMails']) {
					$mailtext = 'Titel: '.$training->getTitle().chr(10).'Datum: '.$training->getTrainingDate()->format('j.m.y').chr(10).'Sportart: '.$training->getSport()->getTitle().chr(10).'Intensität: '.$training->getIntensity()->getTitle().chr(10).'Verantwortlich: '.$trainer->getName().chr(10).'InfoMail-Versand: https://www.freizeitsportler.ch/infomails'.chr(10).chr(10).'----------'.chr(10).'Das ist ein automatisch generiertes E-Mail. Bitte nicht darauf antworten.';
					$mail = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
					$mail->from(new \Symfony\Component\Mime\Address('notification@freizeitsportler.ch', 'freizeitsportler.ch'));
					$mail->to(new \Symfony\Component\Mime\Address('infomailversand@freizeitsportler.ch', 'fs.ch-InfoMail'));
					$mail->subject('Infomail für Training pendent');
					$mail->text($mailtext);
					$mail->html('<div style="font-family:sans-serif">'.str_replace(chr(10),'<br />',$mailtext).'</div>');
					$mail->send();
				}
			}
			$this->redirect('show','Training','trainingsplatz',array('training' => $training),$this->settings['mainPid']);
		} else {
			$this->trainingRepository->update($training);
			$step++;
			$this->redirect('edit','Training','trainingsplatz',array('training' => $training, 'step' => $step));
		}
	}

	/**
	 * action cancel
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @return void
	 */
	public function cancelAction(\DW\Trainingsplatz\Domain\Model\Training $training) {
		$now = new \DateTime('now',$this->timezone);
		$difference = $training->getTrainingDate()->diff($now);
		
		if ($training->getTrainingDate()->diff($now)->format("%r%a") < 1) {
			// only allow cancellation at same day as the training or ealier
		
			$training->setLastChange($now);
			$training->setCancelled(true);
			$this->trainingRepository->update($training);
			
			if ($this->settings['deleteCachePid']) {
				$this->clearSpecificCache($this->settings['deleteCachePid']);
			}
	
			if (! $this->settings['suppressMails']) {
				$mailtext = 'Hoi Freizeitsportler'.chr(10).chr(10).'Das Training "'.$training->getTitle().'" vom '.$training->getTrainingDate()->format('j.m.y').' muss leider abgesagt werden.'.chr(10).chr(10).'Sportliche Grüsse'.chr(10).'freizeitsportler.ch';
				$answers = $this->answerRepository->findPerTraining($training);

				$mail = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
				$mail->from(new \Symfony\Component\Mime\Address('notification@freizeitsportler.ch', 'freizeitsportler.ch'));
				$mail->subject('Training vom '.$training->getTrainingDate()->format('j.m.y').' abgesagt');
				$mail->text($mailtext);
				$mail->html('<div style="font-family:sans-serif">'.str_replace(chr(10),'<br />',$mailtext).'</div>');

				$mail->to(new \Symfony\Component\Mime\Address('infomailversand@freizeitsportler.ch', 'fs.ch-InfoMail'));
				$mail->send();
	
				foreach ($answers as $answer) {
					if ($user = $answer->getFeuser()) {
						if ($user->getEmail()) {
							$mail->to(new \Symfony\Component\Mime\Address($user->getEmail(), $user->getName()));
							$mail->send();
						}
					} else {
						if ($answer->getEmail()) {
							$mail->to(new \Symfony\Component\Mime\Address($answer->getEmail(), $answer->getAuthor()));
							$mail->send();
						}
					}
				}
			}
			
			$this->addFlashMessage('Training wurde abgesagt und die eingetragenen Teilnehmer per Mail informiert', '', AbstractMessage::OK);
		}
		$this->redirect('show','Training','trainingsplatz',array('training' => $training->getUid()));
	}

	/**
	 * action activate
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @return void
	 */
	public function activateAction(\DW\Trainingsplatz\Domain\Model\Training $training) {
		$now = new \DateTime('now',$this->timezone);
		$training->setLastChange($now);
		$training->setCancelled(false);
		$this->trainingRepository->update($training);

		if ($this->settings['deleteCachePid']) {
			$this->clearSpecificCache($this->settings['deleteCachePid']);
		}

		$this->addFlashMessage('Training wurde wieder aktiviert');
		$this->redirect('show','Training','trainingsplatz',array('training' => $training->getUid()));
	}

	/**
	 * action delete
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @return void
	 */
	public function deleteAction(\DW\Trainingsplatz\Domain\Model\Training $training) {
		$this->trainingRepository->remove($training);

		if ($this->settings['deleteCachePid']) {
			$this->clearSpecificCache($this->settings['deleteCachePid']);
		}

		$this->addFlashMessage('Training wurde gelöscht');
		$this->redirect('list');
	}

	/**
	 * action addAnswer
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Answer $answer
	 * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("answer")	 
	 * @return void
	 */
	public function addAnswerAction(\DW\Trainingsplatz\Domain\Model\Answer $answer = NULL) {
		// Validate some fields
		$error = false;
		if ($this->request->getArgument('zusatz') <> "") {
			// Robot filled hidden text field (honey pot)
			$error = true;
		}
		$member = false;
		if ($GLOBALS['TSFE']->fe_user->user['uid'] > 0) {
			$feuserObject = $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
			if (is_array($GLOBALS['TSFE']->fe_user->groupData['uid']) && in_array($this->settings['usergroupMember'], $GLOBALS['TSFE']->fe_user->groupData['uid'])) {
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
			if ($answer->getAuthor() == "" or $answer->getEmail() == "") {
				$error = true;
			}
		}
		
		if ($error) {
			$this->redirect('show','Training','trainingsplatz',array('training' => $answer->getTraining()->getUid()),$settings->mainPid.'#userAnswer');			
		} else {
			$now = new \DateTime('now',$this->timezone);
			$answer->setCreationDate($now);
			$answer->setChangeDate($now);
			if ($GLOBALS['TSFE']->fe_user->user['uid'] > 0) {
				$feuserObject = $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
				$answer->setFeuser($feuserObject);
				$answer->setAuthor($feuserObject->getName());
			}
			$this->answerRepository->add($answer);
			if ($answer->getTraining()->isNotification()) {
				$this->sendNotification($answer, 1);
			}
			if ($this->settings['deleteCachePid']) {
				$this->clearSpecificCache($this->settings['deleteCachePid']);
			}
			$this->redirect('show','Training','trainingsplatz',array('training' => $answer->getTraining()->getUid()),$settings->mainPid.'#userAnswer');
		}
	}

	/**
	 * action editAnswer
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Answer $answer
	 * @return void
	 */
	public function editAnswerAction(\DW\Trainingsplatz\Domain\Model\Answer $answer) {

		$training = $answer->getTraining();
		$answers = $this->answerRepository->findPerTraining($training);
		$userId = $GLOBALS['TSFE']->fe_user->user['uid'];
		if ($userId > 0) {
			$feuser = $this->userRepository->findByUid($userId);
			$userAnswer = $this->answerRepository->findByTrainingAndUser($training,$userId);
		}
		$correctedAnswers = $this->answerRepository->findPerTrainingCorrected($training);
		$this->view->assignMultiple(array(
			'training' => $training,
			'answers' => $answers,
			'feuser' => $feuser,
			'userAnswer' => $answer,
			'correctedAnswers' => $correctedAnswers,
		));
	}

	/**
	 * action modifyAnswer
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Answer $userAnswer
	 * @return void
	 */
	public function modifyAnswerAction(\DW\Trainingsplatz\Domain\Model\Answer $answer) {
		// Validate some fields
		$error = false;
		if ($answer->getTitle() == "" or $answer->getDescription() == "") {
			$error = true;
		}

		if ($error) {
			$this->redirect('show','Training','trainingsplatz',array('training' => $answer->getTraining()->getUid()),$settings->mainPid.'#userAnswer');			
		} else {
			$now = new \DateTime('now',$this->timezone);
			$answer->setChangeDate($now);
			$this->answerRepository->update($answer);
			if ($answer->getTraining()->isNotification()) {
				$this->sendNotification($answer, 2);
			}
			if ($this->settings['deleteCachePid']) {
				$this->clearSpecificCache($this->settings['deleteCachePid']);
			}
			$this->redirect('show','Training','trainingsplatz',array('training' => $answer->getTraining()->getUid()),$settings->mainPid.'#userAnswer');
		}
	}

	/**
	 * action cancelAnswer
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Answer $answer
	 * @return void
	 */
	public function cancelAnswerAction(\DW\Trainingsplatz\Domain\Model\Answer $answer) {
		$now = new \DateTime('now',$this->timezone);
		$answer->setChangeDate($now);
		$answer->setCancelled(true);
		$answer->setHash('');
		$this->answerRepository->update($answer);
		if ($answer->getTraining()->isNotification()) {
			$this->sendNotification($answer, 3);
		}
		$this->addFlashMessage('Teilnahme abgesagt', '', AbstractMessage::OK);
		if ($this->settings['deleteCachePid']) {
			$this->clearSpecificCache($this->settings['deleteCachePid']);
		}
		$this->redirect('show','Training','trainingsplatz',array('training' => $answer->getTraining()->getUid()),$settings->mainPid.'#userAnswer');
	}

	/**
	 * action reactivateAnswer
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Answer $answer
	 * @return void
	 */
	public function reactivateAnswerAction(\DW\Trainingsplatz\Domain\Model\Answer $answer) {
		$now = new \DateTime('now',$this->timezone);
		$answer->setChangeDate($now);
		$answer->setCancelled(false);
		$this->answerRepository->update($answer);
		if ($answer->getTraining()->isNotification()) {
			$this->sendNotification($answer, 4);
		}
		$this->addFlashMessage('Teilnahme wieder aktiviert', '', AbstractMessage::OK);
		if ($this->settings['deleteCachePid']) {
			$this->clearSpecificCache($this->settings['deleteCachePid']);
		}
		$this->redirect('show','Training','trainingsplatz',array('training' => $answer->getTraining()->getUid()),$settings->mainPid.'#userAnswer');
	}

	/**
	 * action cancelRequestAnswer
	 *
	 * @return void
	 */
	public function cancelRequestAnswerAction() {
		if ($this->request->hasArgument('training')) {
			$persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
			$training = $this->trainingRepository->findByUid($this->request->getArgument('training'));
			if ($training and $this->request->hasArgument('email')) {
				$email = $this->request->getArgument('email');
				$answers = $this->answerRepository->findPerTrainingAndEmail($training,$email);
				if ($answers->count() > 0) {
					foreach ($answers as $answer) {
						if (! $answer->isCancelled()) {
							$hash = md5($training->getUid().'-'.$answer->getUid().'-'.time());
							$answer->setHash($hash);
							$this->answerRepository->update($answer);
							$persistenceManager->persistAll();
							$uriBuilder = $persistenceManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder::class);
							$arguments = ['training' => $training->getUid(), 'answer' => $answer->getUid(), 'hash' => $hash];
							$link = $uriBuilder->reset()->setTargetPageUid($this->settings['mainPid'])->setCreateAbsoluteUri(true)->uriFor('cancelPublicAnswer',$arguments);
							
							$mailtext = 'Hoi Freizeitsportler'.chr(10).chr(10).'Um deine Teilnahme beim Training "'.$training->getTitle().'" vom '.$training->getTrainingDate()->format('j.m.y').' abzusagen, klicke bitte auf diesen Link:.'.chr(10).$link.chr(10).chr(10).'Sportliche Grüsse'.chr(10).'freizeitsportler.ch';

							$mail = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
							$mail->from(new \Symfony\Component\Mime\Address('notification@freizeitsportler.ch', 'freizeitsportler.ch'));
							$mail->to(new \Symfony\Component\Mime\Address($email));
							$mail->subject('Deine Absage vom Training am '.$training->getTrainingDate()->format('j.m.y'));
							$mail->text($mailtext);
							$mail->html('<div style="font-family:sans-serif">'.str_replace(chr(10),'<br />',$mailtext).'</div>');
							if ($mail->send()) {
								$this->addFlashMessage('Der Abmelde-Link wurde dir per E-Mail zugesendet.', '', AbstractMessage::OK);
							} else {
								$this->addFlashMessage('Das Versenden des Anmelde-Link funktioniert aufgrund eines Fehlers nicht.<br />Bitte melde dich per E-Mail an <a href="mailto:info@freizeitsportler.ch">info@freizeitsportler.ch</a> bei uns.', '', AbstractMessage::ERROR);							
							}
							break;
						}
					}
				} else {
					$this->addFlashMessage('Die anggegebene Mailadresse wurde in keiner der Teilnahme-Einträgen gefunden.', '', AbstractMessage::WARNING);
				}
				$this->redirect('show','Training','trainingsplatz',['training' => $training]);
			}
			$this->addFlashMessage('Die anggegebene Mailadresse wurde in keiner der Teilnahme-Einträgen gefunden.', '', AbstractMessage::WARNING);
			$this->redirect('show','Training','trainingsplatz',['training' => $training]);
		}
		$this->redirect('list');
	}

	/**
	 * action cancelPublicAnswer
	 *
	 * @return void
	 */
	public function cancelPublicAnswerAction() {
		if ($this->request->hasArgument('answer') and $this->request->hasArgument('hash')) {
			$answer = $this->answerRepository->findByUid($this->request->getArgument('answer'));
			if ($answer->getHash() == $this->request->getArgument('hash')) {
				$this->redirect('cancelAnswer','Training','trainingsplatz',['answer' => $answer]);
			}
		}
		$this->addFlashMessage('Absage-Link ungültig', '', AbstractMessage::ERROR);
		if ($this->request->hasArgument('training')) {
			$training = $this->trainingRepository->findByUid($this->request->getArgument('training'));
			if ($training) {
				$this->redirect('show','Training','trainingsplatz',['training' => $training]);
			}
		}
		$this->redirect('list');
	}

	/**
	 * action message
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @return void
	 */
	public function messageAction(\DW\Trainingsplatz\Domain\Model\Training $training) {
		$this->view->assign('training', $training);
	}

	/**
	 * action messageSend
	 *
	 * @return void
	 */
	public function messageSendAction() {
		$arguments = $this->request->getArguments();
		if ($arguments['training']) {
			$training = $this->trainingRepository->findByUid(intval($arguments['training']));
			if ($training) {
				$answers = $this->answerRepository->findPerTraining($training);
				$userId = $GLOBALS['TSFE']->fe_user->user['uid'];
				if (count($answers) > 0 and $userId > 0) {
					$user = $this->userRepository->findByUid($userId);
					$subject = trim($arguments['subject']);
					$content = trim($arguments['content']);
					if (strlen($subject) > 0 and strlen($content) > 0) {

						// send message
						$mail = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
						$mail->from(new \Symfony\Component\Mime\Address($user->getEmail(), $user->getName()));
						$mail->subject($subject);
						$content .= chr(10).chr(10).'----------'.chr(10).'Diese Nachricht wurde mittels Formular auf freizeitsportler.ch erfasst und automatisch an alle Teilnehmer des Trainings '.$training->getTitle().' am '.$training->getTrainingDate()->format('d.m.y').' versendet.';
						$mail->text($content);
						$mail->html('<div style="font-family:sans-serif">'.str_replace(chr(10),'<br />',$content).'</div>');
				
						if (! $this->settings['suppressMails']) {
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
										$mail->to(new \Symfony\Component\Mime\Address($recipient->getEmail(), $recipient->getName()));
										$mail->send();
									}
								} else {
									if ($answer->getEmail()) {
										$mail->to(new \Symfony\Component\Mime\Address($answer->getEmail(), $answer->getName()));
										$mail->send();
									}
								}
							}
							if ($needCopyToUser) {
								if ($user->getEmail()) {
									$mail->to(new \Symfony\Component\Mime\Address($user->getEmail(), $user->getName()));
									$mail->send();
								}
							}
							if ($needCopyToAuthor) {								
								if ($training->getAuthor()->getEmail()) {
									$mail->to(new \Symfony\Component\Mime\Address($training->getAuthor()->getEmail(), $training->getAuthor()->getName()));
									$mail->send();
								}
							}
							if ($training->isGuided() and $needCopyToCoach) {								
								if ($training->getLeader()->getEmail()) {
									$mail->to(new \Symfony\Component\Mime\Address($training->getLeader()->getEmail(), $training->getLeader()->getName()));
									$mail->send();
								}
							}							
						}
						
						$this->addFlashMessage('E-Mail wurde versendet, eine Kopie davon auch an dich','', AbstractMessage::OK);
						$this->redirect('show','Training','trainingsplatz',array('training' => $training));
					} else {
						$this->addFlashMessage('Betreff und Inhalt dürfen nicht leer sein','', AbstractMessage::WARNING);
						$this->redirect('message','Training','trainingsplatz',array('training' => $training));
					}
				}
			}
		}
		$this->addFlashMessage('E-Mail konnte nicht versendet werden','', AbstractMessage::WARNING);
		$this->redirect('list');
	}

	/**
	 * action evaluate
	 *
	 * @return void
	 */
	public function evaluateAction() {
		$trainings = $this->trainingRepository->findPast();
		$answers = array ();
		foreach ($trainings as $training) {
			$answers[$training->getUid()] = $this->answerRepository->findPerTrainingCorrected($training);
		}
		$sports = $this->sportRepository->findAll();
		$this->view->assignMultiple(array(
			'trainings' => $trainings,
			'answers' => $answers,
			'sports' => $sports,
			'settings' => $this->settings,
		));
	}

	/**
	 * action billing
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @return void
	 */
	public function billingAction(\DW\Trainingsplatz\Domain\Model\Training $training) {
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
		$this->view->assignMultiple(array(
			'training' => $training,
			'answers' => $answers,
			'correctedAnswers' => $correctedAnswers,
			'break' => intval(ceil(count($answers)/2)),
		));
	}

	/**
	 * action discount
	 *
	 * @return void
	 */
	public function discountAction() {
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
		if ($this->settings['deleteCachePid']) {
			$this->clearSpecificCache($this->settings['deleteCachePid']);
		}
		if ($finish) {
			$this->redirect('finalize','Training','trainingsplatz',array('training' => $arguments['training']));
		} else {
			$this->addFlashMessage('Punkte für dieses Training wurden gespeichert');
			$this->redirect('evaluate');
		}
	}

	/**
	 * action finalize
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @return void
	 */
	public function finalizeAction(\DW\Trainingsplatz\Domain\Model\Training $training) {
		$this->view->assignMultiple(array(
			'training' => $training,
		));
	}

	/**
	 * action close
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @return void
	 */
	public function closeAction(\DW\Trainingsplatz\Domain\Model\Training $training) {
		$training->setClosed(true);
		$this->trainingRepository->update($training);
		if ($this->settings['deleteCachePid']) {
			$this->clearSpecificCache($this->settings['deleteCachePid']);
		}
		$this->addFlashMessage('Training wurde abgeschlossen');
		$this->redirect('evaluate');
	}

	/**
	 * action ranking (Sportler des Jahres, all members)
	 *
	 * @return void
	 */
	public function rankingAction() {
		if ($this->request->hasArgument('year')) {
			$year = intval($this->request->getArgument('year'));
			if ($year < 2016 or $year > date('Y')) {
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

		$this->view->assignMultiple(array(
			'answers' => $answers,
			'ranks' => $ranks,
			'year' => $year,
			'startDate' => $dates['start'],
			'endDate' => $dates['end'],
			'limit' => $limit,
			'extra' => $extra,
			'navigation' => $navigation,
		));
	}

	/**
	 * action userCompetition (Sportler des Jahres, single member)
	 *
	 * @return void
	 */
	public function userCompetitionAction() {
		$dates = $this->getRankingDateRange();
		$feuserId = $GLOBALS['TSFE']->fe_user->user['uid'];
		if ($feuserId > 0) {
			$feuser = $this->userRepository->findByUid($feuserId);
			$answers = $this->answerRepository->findEvaluatedByUser($feuserId, $dates['start']);
			$total = $this->answerRepository->countPointsByUser($feuserId, $dates['start']);
			$extra = $feuser->getTxTrainingsplatzContestExtra();
			$total += $extra;
		}

		$this->view->assignMultiple(array(
			'answers' => $answers,
			'total' => $total,
			'extra' => $extra,
			'startDate' => $dates['start'],
		));
	}

	/**
	 * action participation
	 *
	 * @return void
	 */
	public function participationAction() {
		if ($this->request->hasArgument('year')) {
			$year = $this->request->getArgument('year');
		}
		if ($year < 2020 or $year > date('Y')) {
			$year = date('Y');
		}
		for ($i=2020; $i<=date('Y'); $i++) {
			$navigation[] = $i;
		}

		$dates = $this->getRankingDateRange($year);
		$compensations = $this->answerRepository->findCompensated($dates['start']);
		foreach ($compensations as $comp) {
			$user = $comp->getTraining()->getAuthor();
			if ($comp->getTraining()->isGuided() and $comp->getTraining()->getLeader()) {
				$user = $comp->getTraining()->getLeader();
			}
			$results[$user->getUid()]['user'] = $user;
			$results[$user->getUid()]['trainings'][] = $comp->getTraining();
			$results[$user->getUid()]['answers'][] = $comp;
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

		$this->view->assignMultiple(array(
			'list' => $list,
			'startDate' => $dates['start'],
			'year' => $year,
			'ok' => $ok,
			'navigation' => $navigation,
		));

	}

	/**
	 * action userParticipation
	 *
	 * @return void
	 */
	public function userParticipationAction() {
		$dates = $this->getRankingDateRange();
		if ($this->request->hasArgument('user')) {
			$userId = $this->request->getArgument('user');
			$user = $this->userRepository->findByUid($userId);
		}
		if (! $user) {
			$userId = $GLOBALS['TSFE']->fe_user->user['uid'];
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
		
		$this->view->assignMultiple(array(
			'user' => $user,
			'list' => $list,
			'startDate' => $dates['start'],
			'count' => $count,
		));
	}


	/**
	 * action analysis
	 *
	 * @return void
	 */
	public function analysisAction() {
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
		
		$this->view->assignMultiple(array(
			'trainings' => $trainings,
			'trainingsNotCancelled' => $trainingsNotCancelled,
			'year' => $year,
			'navigation' => $navigation,
		));
	}


	/**
	 * action reports
	 *
	 * @return void
	 */
	public function reportsAction() {
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
		$reports = $this->newsRepository->findDemanded($demand);
		
		for ($i=2016; $i<=date('Y'); $i++) {
			$navigation[] = $i;
		}
		
		$this->view->assignMultiple(array(
			'reports' => $reports,
			'year' => $year,
			'navigation' => $navigation,
		));
	}


	/**
	 * sendNotification
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Answer $answer
	 * @param integer $reason Reason code: 1 = new answer, 2 = modification, 3 = cancellation, 4 = re-activation
	 * @return void
	 */
	protected function sendNotification (\DW\Trainingsplatz\Domain\Model\Answer $answer, $reason) {
		if ($this->settings['suppressMails']) {
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
		$mail = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
		if ($mail and $leader->getEmail() and $reason>0 and $reason<=4) {
			switch ($reason) {
				case 1:
					$mailtext = 'Hoi '.$leader->getFirstName().chr(10).chr(10).$writerName.' hat sich für dein Training "'.$answer->getTraining()->getTitle().'" vom '.$answer->getTraining()->getTrainingDate()->format('j.m.y').' angemeldet:'.chr(10).chr(10).$answer->getTitle().chr(10).$answer->getDescription().chr(10).chr(10).'----------'.chr(10).'Das ist ein automatisch generiertes E-Mail von www.freizeitsportler.ch. Bitte nicht darauf antworten.';
					$mail->subject('Neuer Eintrag auf dein Training');
					break;
				case 2:
					$mailtext = 'Hoi '.$leader->getFirstName().chr(10).chr(10).$writerName.' hat den Eintrag für dein Training "'.$answer->getTraining()->getTitle().'" vom '.$answer->getTraining()->getTrainingDate()->format('j.m.y').' geändert:'.chr(10).chr(10).$answer->getTitle().chr(10).$answer->getDescription().chr(10).chr(10).'----------'.chr(10).'Das ist ein automatisch generiertes E-Mail von www.freizeitsportler.ch. Bitte nicht darauf antworten.';
					$mail->subject('Eintrag in deinem Training geändert');
					break;
				case 3:
					$mailtext = 'Hoi '.$leader->getFirstName().chr(10).chr(10).$writerName.' meldet sich von deinem Training "'.$answer->getTraining()->getTitle().'" vom '.$answer->getTraining()->getTrainingDate()->format('j.m.y').' ab.'.chr(10).chr(10).'----------'.chr(10).'Das ist ein automatisch generiertes E-Mail von www.freizeitsportler.ch. Bitte nicht darauf antworten.';
					$mail->subject('Abmeldung von deinem Training');
					break;
				case 4:
					$mailtext = 'Hoi '.$leader->getFirstName().chr(10).chr(10).$writerName.' meldet sich für dein Training "'.$answer->getTraining()->getTitle().'" vom '.$answer->getTraining()->getTrainingDate()->format('j.m.y').' wieder an.'.chr(10).chr(10).'----------'.chr(10).'Das ist ein automatisch generiertes E-Mail von www.freizeitsportler.ch. Bitte nicht darauf antworten.';
					$mail->subject('Erneute Anmeldung auf dein Training');
					break;
			}
			$mail->text($mailtext);
			$mail->html('<div style="font-family:sans-serif">'.str_replace(chr(10),'<br />',$mailtext).'</div>');
			$mail->from(new \Symfony\Component\Mime\Address('notification@freizeitsportler.ch', 'freizeitsportler.ch'));
			$mail->to(new \Symfony\Component\Mime\Address($leader->getEmail(), $leader->getName()));
			return $mail->send();
		} else {
			return false;
		}
	}

	/**
	 * adjustYear
	 *
	 * @param \DateTime $date
	 * @return \DateTime
	 */
	protected function adjustYear (\DateTime $date) {
		if ($date->format('Y') < 2000) {
			$year = 2000+$date->format('y');
		} else {
			$year = $date->format('Y');
		}
		return new \DateTime($year.'-'.$date->format('m-d').' 00:00:00',new \DateTimeZone('UTC'));
	}

	/**
	 * getSeriesDates
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @return array
	 */
	protected function getSeriesDates (\DW\Trainingsplatz\Domain\Model\Training $training) {
		$dates = [];
		if ($training->getSeries()) {
			$start = $training->getSeriesStart()->format('U');
			$end = $training->getSeriesEnd()->format('U');
			if ($start <= $end) {
				$wday = $training->getSeriesWeekday();
				if ($wday > 6) { $wday = $wday-7; }
				if ($training->getSeriesPeriod() == 0) {
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
				} else {
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
						while ($newDate <= $end and count($dates) <= 25) {
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
						while ($newDate <= $end and count($dates) <= 25) {
							$dates[] = $newDate;
							$newDate = strtotime ('+4 weeks', $newDate);
							$minDay = date('t',$newDate)-6;
							if (date('j',$newDate) < $minDay) {
								$newDate = strtotime ('+1 weeks', $newDate);
							}
						}
					}
				}
			}
			if (count($dates) > 0) {
				foreach ($dates as $date) {
					$list[] = new \DateTime (date('Y-m-d',$date), $this->timezone);
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
     * @param integer $year Main year of the season, the start date is always in the previous year
	 * @return array
	 */
	protected function getRankingDateRange ($year = NULL) {
		if ($this->settings['competitionStart']) {
			$today = new \DateTime('today');
			$startDates = explode(',',$this->settings['competitionStart']);
			$startDate = new \DateTime(array_pop($startDates));
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

	/**
	* clearSpecificCache
	*
	* @param \string $pid Comma-separated list of PIDs
	* @return void
	*/
    protected function clearSpecificCache($pid) {
		$pageIds = explode(',',$pid);
		$this->cacheService->clearPageCache($pageIds);
    }

}