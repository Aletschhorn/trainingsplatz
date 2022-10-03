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

use In2code\Femanager\Domain\Repository\UserRepository;

/**
 * UserController
 */
class UserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * userRepository
	 *
	 * @var UserRepository
	 */
	protected $userRepository;
	
	/**
	 * @param UserRepository $userRepository
	 */
	public function __construct (
			UserRepository $userRepository
	) {
		$this->userRepository = $userRepository;
	}
	
	/**
	 * action birthday
	 *
	 * @return void
	 */
	public function birthdayAction() {
		$usergroups = explode (',', $this->settings['usergroups']);
		$todayDate = new \DateTime ('now');
		$tomorrowDate = new \DateTime ('tomorrow');
		$todayUser = $this->userRepository->findBirthdayToday(0, $usergroups);
		$tomorrowUser = $this->userRepository->findBirthdayToday(1, $usergroups);
		$this->view->assignMultiple(array(
			'todayUser' => $todayUser,
			'tomorrowUser' => $tomorrowUser,
			'todayDate' => $todayDate,
			'tomorrowDate' => $tomorrowDate,
			'settings' => $this->settings,
		));
	}

	/**
	 * action reactivation
	 *
	 * @return void
	 */
	public function reactivationAction() {
		$userId = $GLOBALS['TSFE']->fe_user->user['uid'];
		if ($userId) {
			$feuser = $this->userRepository->findByUid($userId);
		}

		$this->view->assignMultiple(array(
			'user' => $feuser,
			'userId' => $userId,
		));
	}

	/**
	 * action message
	 *
	 * @return void
	 */
	public function messageAction() {
		if ($this->request->hasArgument('member')) {
			$memberId = intval($this->request->getArgument('member'));
			$member = $this->userRepository->findByUid($memberId);
		}
		$sent = 0;
		if ($this->request->hasArgument('sent')) {
			$sent = intval($this->request->getArgument('sent'));
		}
		
		$this->view->assignMultiple(array(
			'member' => $member,
			'sent' => $sent,
			'settings' => $this->settings,
		));
	}

	/**
	 * action messageSend
	 *
	 * @return void
	 */
	public function messageSendAction() {
		$arguments = $this->request->getArguments();
		if ($arguments['member']) {
			$recipient = $this->userRepository->findByUid(intval($arguments['member']));
			if ($recipient) {
				$senderId = $GLOBALS['TSFE']->fe_user->user['uid'];
				if ($senderId > 0) {
					$sender = $this->userRepository->findByUid($senderId);
					if ($sender->getEmail() and $recipient->getEmail()) {
						$subject = trim($arguments['subject']);
						$content = trim($arguments['content']);
						if (strlen($subject) > 0 and strlen($content) > 0) {

							// send message
							if (! $this->settings['suppressMails']) {
								$mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
								$mail->from(new \Symfony\Component\Mime\Address($sender->getEmail(), $sender->getName()));
								$mail->to(new \Symfony\Component\Mime\Address($recipient->getEmail(), $recipient->getName()));
								$mail->subject($subject);
								$content .= chr(10).chr(10).'----------'.chr(10).'Diese Nachricht wurde mittels Formular auf freizeitsportler.ch versendet.';
								$mail->text($content);
								$mail->html('<div style="font-family:sans-serif">'.str_replace(chr(10),'<br />',$content).'</div>');
								$mail->send();
							}
						
							$this->addFlashMessage('E-Mail wurde versendet','',\TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
							$this->redirect('message','User','trainingsplatz',array('member' => $arguments['member'], 'sent' => 1));
						} else {
							$this->addFlashMessage('Betreff und Inhalt dürfen nicht leer sein','',\TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
							$this->redirect('message','User','trainingsplatz',array('member' => $arguments['member'], 'sent' => 0));
						}
					} else {
						$this->addFlashMessage('E-Mail konnte nicht versendet werden','',\TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
						$this->redirect('message','User','trainingsplatz',array('member' => $arguments['member'], 'sent' => 1));
					}
				} else {
					$this->addFlashMessage('E-Mail konnte nicht versendet werden','',\TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
					$this->redirect('message','User','trainingsplatz',array('member' => $arguments['member'], 'sent' => 1));
				}
			} else {
				$this->addFlashMessage('E-Mail konnte nicht versendet werden','',\TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
				$this->redirect('message','User','trainingsplatz',array('member' => $arguments['member'], 'sent' => 1));
			}
		} else {
			$this->addFlashMessage('E-Mail konnte nicht versendet werden','',\TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
			$this->redirect('message','User','trainingsplatz',array('member' => $arguments['member'], 'sent' => 1));
		}
	}

}