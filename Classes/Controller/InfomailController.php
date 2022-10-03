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
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use DW\Trainingsplatz\Domain\Repository\InfomailRepository;
use In2code\Femanager\Domain\Repository\UserRepository;

/**
 * InfomailController
 */
class InfomailController extends ActionController {

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
	 * @param InfomailRepository $infomailRepository
	 * @param UserRepository $userRepository
	 */
	public function __construct (
			InfomailRepository $infomailRepository,
			UserRepository $userRepository
	) {
		$this->infomailRepository = $infomailRepository;
		$this->userRepository = $userRepository;
	}
	
	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$pending = $this->infomailRepository->findFutureByStatus(0);
		$sent = $this->infomailRepository->findFutureByStatus(1);
		$queued = $this->infomailRepository->findFutureByStatus(3);
		$inprogress = $this->infomailRepository->findFutureByStatus(4);
		$this->view->assignMultiple(array(
			'pending' => $pending,
			'sent' => $sent,
			'queued' => $queued,
			'inprogress' => $inprogress,
		));
	}

	/**
	 * action show
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Infomail $infomail
	 * @return void
	 */
	public function showAction(\DW\Trainingsplatz\Domain\Model\Infomail $infomail) {
		$js = '<script src="//maps.googleapis.com/maps/api/js?key='.$this->settings['googleMapsKey'].'" type="text/javascript"></script>'.chr(10).'<script src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/elabel.js" type="text/javascript"></script>'.chr(10).'<script type="text/javascript">'.chr(10).'var streckenfarbe = \''.$this->settings['routeColor'].'\'; '.chr(10).'var streckenbreite = '.$this->settings['routeWidth'].'; '.chr(10).'var tpicon = new GIcon(); '.chr(10).'tpicon.image = \''.$this->settings['meetingpointIcon'].'\'; '.chr(10).'tpicon.iconSize = new GSize('.$this->settings['meetingpointIconSize'].'); '.chr(10).'tpicon.iconAnchor = new GPoint('.$this->settings['meetingpointIconAnchor'].'); '.chr(10).'</script>'.chr(10).'<script type="text/javascript" src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/mapcontrol_newtraining.js"></script>';
	    $this->response->addAdditionalHeaderData($js);

		$this->view->assign('infomail', $infomail);	
	}

	/**
	 * action review
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Infomail $infomail
	 * @return void
	 */
	public function reviewAction(\DW\Trainingsplatz\Domain\Model\Infomail $infomail) {
		$js = '<script src="//maps.googleapis.com/maps/api/js?key='.$this->settings['googleMapsKey'].'" type="text/javascript"></script>'.chr(10).'<script src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/elabel.js" type="text/javascript"></script>'.chr(10).'<script type="text/javascript">'.chr(10).'var streckenfarbe = \''.$this->settings['routeColor'].'\'; '.chr(10).'var streckenbreite = '.$this->settings['routeWidth'].'; '.chr(10).'var tpicon = new GIcon(); '.chr(10).'tpicon.image = \''.$this->settings['meetingpointIcon'].'\'; '.chr(10).'tpicon.iconSize = new GSize('.$this->settings['meetingpointIconSize'].'); '.chr(10).'tpicon.iconAnchor = new GPoint('.$this->settings['meetingpointIconAnchor'].'); '.chr(10).'</script>'.chr(10).'<script type="text/javascript" src="'.PathUtility::stripPathSitePrefix(ExtensionManagementUtility::extPath('trainingsplatz')).'Resources/Public/Javascript/mapcontrol_newtraining.js"></script>';
	    $this->response->addAdditionalHeaderData($js);

		$this->view->assign('infomail', $infomail);
	}

	/**
	 * action copy
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Infomail $infomail
	 * @return void
	 */
	public function copyAction(\DW\Trainingsplatz\Domain\Model\Infomail $infomail) {
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
				$this->redirect('show','Infomail','trainingsplatz',array('infomail' => $newInfomail));
			}
		}
		$this->redirect('list');
	}

	/**
	 * action send
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Infomail $infomail
	 * @return void
	 */
	public function sendAction(\DW\Trainingsplatz\Domain\Model\Infomail $infomail) {
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
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Infomail $infomail
	 * @return void
	 */
	public function deleteAction(\DW\Trainingsplatz\Domain\Model\Infomail $infomail) {
		$this->redirect('list');
	}

	/**
	 * action deny
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Infomail $infomail
	 * @return void
	 */
	public function denyAction(\DW\Trainingsplatz\Domain\Model\Infomail $infomail) {
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
		$this->redirect('list');
	}

	/**
	 * action cancel
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Infomail $infomail
	 * @return void
	 */
	public function cancelAction(\DW\Trainingsplatz\Domain\Model\Infomail $infomail) {
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
		$this->redirect('list');
	}

	/**
	 * getAllUsergroups
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $usergroups
	 * @param array $usergroupArray
	 * @return void
	 */
	protected static function getAllUsergroups ($usergroups, &$usergroupArray) {
		foreach ($usergroups as $usergroup) {
			$usergroupArray[] = $usergroup->getUid();
			$subUsergroups = $usergroup->getSubgroup();
			if (count($subUsergroups) > 0) {
				self::getAllUsergroups($subUsergroups, $usergroupArray);
			}
		}
	}
	
	/**
	 * getUsergroupArray
	 *
	 * @param In2code\Femanager\Domain\Model\User $user
	 * @return array $usergroupArray
	 */
	protected static function getUsergroupArray ($user) {
		$usergroupArray = [];
		$usergroups = $user->getUsergroup();
		self::getAllUsergroups($usergroups, $usergroupArray);
		return $usergroupArray;
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