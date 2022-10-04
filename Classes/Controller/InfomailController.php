<?php
namespace DW\Trainingsplatz\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use DW\Trainingsplatz\Domain\Repository\InfomailRepository;
use DW\Trainingsplatz\Domain\Model\Infomail;
use In2code\Femanager\Domain\Repository\UserRepository;

class InfomailController extends ActionController {

	protected $infomailRepository;

	protected $userRepository;
	
	public function __construct (
			InfomailRepository $infomailRepository,
			UserRepository $userRepository
	) {
		$this->infomailRepository = $infomailRepository;
		$this->userRepository = $userRepository;
	}
	

	public function listAction(): ResponseInterface {
		$pending = $this->infomailRepository->findFutureByStatus(0);
		$sent = $this->infomailRepository->findFutureByStatus(1);
		$queued = $this->infomailRepository->findFutureByStatus(3);
		$inprogress = $this->infomailRepository->findFutureByStatus(4);
		$this->view->assignMultiple([
			'pending' => $pending,
			'sent' => $sent,
			'queued' => $queued,
			'inprogress' => $inprogress,
		]);
		return $this->htmlResponse();
	}


	public function showAction(Infomail $infomail): ResponseInterface {
		$js = '<script src="//maps.googleapis.com/maps/api/js?key='.$this->settings['googleMapsKey'].'" type="text/javascript"></script>'.chr(10).'<script src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/elabel.js" type="text/javascript"></script>'.chr(10).'<script type="text/javascript">'.chr(10).'var streckenfarbe = \''.$this->settings['routeColor'].'\'; '.chr(10).'var streckenbreite = '.$this->settings['routeWidth'].'; '.chr(10).'var tpicon = new GIcon(); '.chr(10).'tpicon.image = \''.$this->settings['meetingpointIcon'].'\'; '.chr(10).'tpicon.iconSize = new GSize('.$this->settings['meetingpointIconSize'].'); '.chr(10).'tpicon.iconAnchor = new GPoint('.$this->settings['meetingpointIconAnchor'].'); '.chr(10).'</script>'.chr(10).'<script type="text/javascript" src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/mapcontrol_newtraining.js"></script>';
	    $this->response->addAdditionalHeaderData($js);

		$this->view->assign('infomail', $infomail);
		return $this->htmlResponse();
	}


	public function reviewAction(Infomail $infomail): ResponseInterface {
		$js = '<script src="//maps.googleapis.com/maps/api/js?key='.$this->settings['googleMapsKey'].'" type="text/javascript"></script>'.chr(10).'<script src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/elabel.js" type="text/javascript"></script>'.chr(10).'<script type="text/javascript">'.chr(10).'var streckenfarbe = \''.$this->settings['routeColor'].'\'; '.chr(10).'var streckenbreite = '.$this->settings['routeWidth'].'; '.chr(10).'var tpicon = new GIcon(); '.chr(10).'tpicon.image = \''.$this->settings['meetingpointIcon'].'\'; '.chr(10).'tpicon.iconSize = new GSize('.$this->settings['meetingpointIconSize'].'); '.chr(10).'tpicon.iconAnchor = new GPoint('.$this->settings['meetingpointIconAnchor'].'); '.chr(10).'</script>'.chr(10).'<script type="text/javascript" src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/mapcontrol_newtraining.js"></script>';
	    $this->response->addAdditionalHeaderData($js);

		$this->view->assign('infomail', $infomail);
		return $this->htmlResponse();
	}


	public function copyAction(Infomail $infomail): ResponseInterface {
		$senduser = $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
		if ($senduser) {
			if (in_array($this->settings['usergroupAdmin'], self::getUsergroupArray($senduser))) {
				$newInfomail = new \DW\Trainingsplatz\Domain\Model\Infomail();
				$newInfomail->setTraining($infomail->getTraining());
				$newInfomail->setMailSubject($infomail->getMailSubject());
				$newInfomail->setMailBody($infomail->getMailBody());
				$newInfomail->setStatus(0);
				$UTC = new \DateTimeZone('UTC');
				$now = new \DateTime('now',$UTC);
				$newInfomail->setStatusDate($now);
				
				$this->infomailRepository->add($newInfomail);
				$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
				$persistenceManager->persistAll();
				if ($this->settings['deleteCachePid']) {
					$this->clearSpecificCache($this->settings['deleteCachePid']);
				}
				return $this->redirect('show','Infomail','trainingsplatz',array('infomail' => $newInfomail));
			}
		}
		return $this->redirect('list');
	}


	public function sendAction(Infomail $infomail): ResponseInterface {
		$senduser = $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
		if ($senduser) {
			if (in_array($this->settings['usergroupAdmin'], self::getUsergroupArray($senduser))) {
				$UTC = new \DateTimeZone('UTC');
				$now = new \DateTime('now',$UTC);
				$infomail->setStatusDate($now);
				$infomail->setStatus(3);
				$infomail->setSendUser($senduser);
		
				$this->infomailRepository->update($infomail);
				$this->addFlashMessage('InfoMail für den Versand vorbereitet.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
				if ($this->settings['deleteCachePid']) {
					$this->clearSpecificCache($this->settings['deleteCachePid']);
				}
			}
		}
		return $this->redirect('list');
	}


	public function deleteAction(Infomail $infomail): ResponseInterface {
		$this->redirect('list');
		return $this->htmlResponse();
	}


	public function denyAction(Infomail $infomail): ResponseInterface {
		$senduser = $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
		if ($senduser) {
			if (in_array($this->settings['usergroupAdmin'], self::getUsergroupArray($senduser))) {
				$UTC = new \DateTimeZone('UTC');
				$now = new \DateTime('now',$UTC);
				$infomail->setStatusDate($now);
				$infomail->setStatus(2);
				$infomail->setSendUser($senduser);
				$this->infomailRepository->update($infomail);
				$this->addFlashMessage('Der InfoMail-Antrag wurde entfernt', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
				if ($this->settings['deleteCachePid']) {
					$this->clearSpecificCache($this->settings['deleteCachePid']);
				}
			}
		}
		return $this->redirect('list');
	}


	public function cancelAction(Infomail $infomail): ResponseInterface {
		$senduser = $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
		if ($senduser) {
			if (in_array($this->settings['usergroupAdmin'], self::getUsergroupArray($senduser))) {
				if ($infomail->getStatus() == 3) {
					$UTC = new \DateTimeZone('UTC');
					$now = new \DateTime('now',$UTC);
					$infomail->setStatusDate($now);
					$infomail->setStatus(0);
					$infomail->setSendUser($senduser);
					$this->infomailRepository->update($infomail);
					$this->addFlashMessage('Das InfoMail wurde zu den pendenten InfoMails zurückverschoben.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
				} else {
					$this->addFlashMessage('Der Status des InfoMails wurde inzwischen geändert; der Versand konnte nicht gestoppt werden.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
				}
				if ($this->settings['deleteCachePid']) {
					$this->clearSpecificCache($this->settings['deleteCachePid']);
				}
			}
		}
		return $this->redirect('list');
	}


	protected static function getAllUsergroups (\TYPO3\CMS\Extbase\Persistence\ObjectStorage $usergroups, array &$usergroupArray) {
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


    protected function clearSpecificCache(string $pid) {
		$pageIds = explode(',',$pid);
		$this->cacheService->clearPageCache($pageIds);
    }

}