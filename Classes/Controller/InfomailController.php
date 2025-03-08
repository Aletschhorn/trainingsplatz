<?php
namespace DW\Trainingsplatz\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use DW\Trainingsplatz\Domain\Repository\InfomailRepository;
use DW\Trainingsplatz\Domain\Model\Infomail;
use In2code\Femanager\Domain\Repository\UserRepository;

class InfomailController extends ActionController {

	private $infomailRepository;

	private $userRepository;

	protected $timezone;
	
	public function __construct (
			InfomailRepository $infomailRepository,
			UserRepository $userRepository,
			private readonly Context $context
	) {
		$this->infomailRepository = $infomailRepository;
		$this->userRepository = $userRepository;
		$this->timezone = new \DateTimeZone('Europe/Zurich');
	}
	

	public function listAction(): ResponseInterface {
		$this->view->assignMultiple([
			'pending' => $this->infomailRepository->findFutureByStatus(0),
			'sent' => $this->infomailRepository->findFutureByStatus(1),
			'queued' => $this->infomailRepository->findFutureByStatus(3),
			'inprogress' => $this->infomailRepository->findFutureByStatus(4),
		]);
		return $this->htmlResponse();
	}


	public function showAction(Infomail $infomail): ResponseInterface {
		$this->view->assign('infomail', $infomail);
		return $this->htmlResponse();
	}


	public function reviewAction(Infomail $infomail): ResponseInterface {
		$this->view->assign('infomail', $infomail);
		return $this->htmlResponse();
	}


	public function copyAction(Infomail $infomail): ResponseInterface {
		$senduser = $this->userRepository->findByUid($this->context->getPropertyFromAspect('frontend.user', 'id'));
		if ($senduser) {
			if (in_array($this->settings['usergroupAdmin'], self::getUsergroupArray($senduser))) {
				$newInfomail = new \DW\Trainingsplatz\Domain\Model\Infomail();
				$newInfomail->setTraining($infomail->getTraining());
				$newInfomail->setMailSubject($infomail->getMailSubject());
				$newInfomail->setMailBody($infomail->getMailBody());
				$newInfomail->setStatus(0);
				$now = new \DateTime('now', $this->timezone);
				$newInfomail->setStatusDate($now);
				
				$this->infomailRepository->add($newInfomail);
				$persistenceManager = GeneralUtility::makeInstance(PersistenceManager::class);
				$persistenceManager->persistAll();
				$this->redirect('show','Infomail','trainingsplatz',array('infomail' => $newInfomail));
			}
		}
		return $this->redirect('list');
	}


	public function sendAction(Infomail $infomail): ResponseInterface {
		$senduser = $this->userRepository->findByUid($this->context->getPropertyFromAspect('frontend.user', 'id'));
		if ($senduser) {
			if (in_array($this->settings['usergroupAdmin'], self::getUsergroupArray($senduser))) {
				$now = new \DateTime('now', $this->timezone);
				$infomail->setStatusDate($now);
				$infomail->setStatus(3);
				$infomail->setSendUser($senduser);
		
				$this->infomailRepository->update($infomail);
				$this->addFlashMessage('InfoMail für den Versand vorbereitet.', '', ContextualFeedbackSeverity::OK);
			}
		}
		return $this->redirect('list');
	}


	public function deleteAction(Infomail $infomail): ResponseInterface {
		return $this->redirect('list');
	}


	public function denyAction(Infomail $infomail): ResponseInterface {
		$senduser = $this->userRepository->findByUid($this->context->getPropertyFromAspect('frontend.user', 'id'));
		if ($senduser) {
			if (in_array($this->settings['usergroupAdmin'], self::getUsergroupArray($senduser))) {
				$now = new \DateTime('now', $this->timezone);
				$infomail->setStatusDate($now);
				$infomail->setStatus(2);
				$infomail->setSendUser($senduser);
				$this->infomailRepository->update($infomail);
				$this->addFlashMessage('Der InfoMail-Antrag wurde entfernt', '', ContextualFeedbackSeverity::OK);
			}
		}
		return $this->redirect('list');
	}


	public function cancelAction(Infomail $infomail): ResponseInterface {
		$senduser = $this->userRepository->findByUid($this->context->getPropertyFromAspect('frontend.user', 'id'));
		if ($senduser) {
			if (in_array($this->settings['usergroupAdmin'], self::getUsergroupArray($senduser))) {
				if ($infomail->getStatus() == 3) {
					$now = new \DateTime('now', $this->timezone);
					$infomail->setStatusDate($now);
					$infomail->setStatus(0);
					$infomail->setSendUser($senduser);
					$this->infomailRepository->update($infomail);
					$this->addFlashMessage('Das InfoMail wurde zu den pendenten InfoMails zurückverschoben.', '', ContextualFeedbackSeverity::OK);
				} else {
					$this->addFlashMessage('Der Status des InfoMails wurde inzwischen geändert; der Versand konnte nicht gestoppt werden.', '', ContextualFeedbackSeverity::ERROR);
				}
			}
		}
		return $this->redirect('list');
	}


	protected static function getAllUsergroups (\TYPO3\CMS\Extbase\Persistence\ObjectStorage $usergroups, array &$usergroupArray): void {
		foreach ($usergroups as $usergroup) {
			$usergroupArray[] = $usergroup->getUid();
			$subUsergroups = $usergroup->getSubgroup();
			if (count($subUsergroups) > 0) {
				self::getAllUsergroups($subUsergroups, $usergroupArray);
			}
		}
	}
	

	protected static function getUsergroupArray (\In2code\Femanager\Domain\Model\User $user) {
		$usergroupArray = [];
		$usergroups = $user->getUsergroup();
		self::getAllUsergroups($usergroups, $usergroupArray);
		return $usergroupArray;
	}	
}