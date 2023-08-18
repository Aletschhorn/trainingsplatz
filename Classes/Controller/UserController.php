<?php
namespace DW\Trainingsplatz\Controller;

use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use In2code\Femanager\Domain\Repository\UserRepository;

/**
 * UserController
 */
class UserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	private $userRepository;	
	
	public function __construct (UserRepository $userRepository) {
		$this->userRepository = $userRepository;
	}
	

	public function birthdayAction() {
		$usergroups = explode (',', $this->settings['usergroups']);
		$todayDate = new \DateTime ('now');
		$tomorrowDate = new \DateTime ('tomorrow');
		$todayUser = $this->userRepository->findBirthdayToday(0, $usergroups);
		$tomorrowUser = $this->userRepository->findBirthdayToday(1, $usergroups);
		$this->view->assignMultiple([
			'todayUser' => $todayUser,
			'tomorrowUser' => $tomorrowUser,
			'todayDate' => $todayDate,
			'tomorrowDate' => $tomorrowDate,
			'settings' => $this->settings,
		]);
	}


	public function messageAction() {
		if ($this->request->hasArgument('member')) {
			$memberId = intval($this->request->getArgument('member'));
			$member = $this->userRepository->findByUid($memberId);
		}
		$sent = 0;
		if ($this->request->hasArgument('sent')) {
			$sent = intval($this->request->getArgument('sent'));
		}
		
		$this->view->assignMultiple([
			'member' => $member,
			'sent' => $sent,
			'settings' => $this->settings,
		]);
	}


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
							$mail = GeneralUtility::makeInstance(FluidEmail::class);
							$mail
								->from(new Address('donotreply@freizeitsportler.ch', $sender->getName().' über freizeitsportler.ch'))
								->to(new Address($recipient->getEmail(), $recipient->getName()))
								->replyTo(new Address($sender->getEmail(), $sender->getName()))
								->subject($subject)
								->format(FluidEmail::FORMAT_BOTH)
								->embed(fopen('https://freizeitsportler.ch/typo3conf/ext/sitepackage_fsch/Resources/Public/Images/logo_full.svg', 'r'), 'logo')
								->setTemplate('Training')
								->assignMultiple([
									'logo' => '<img src="cid:logo" alt="freizeitsportler.ch-Logo" height="76" />',
									'headline' => $subject,
									'content' => $content,
									'contentHtml' => str_replace(chr(10),'<br />',$content),
									'note' => 'Diese Nachricht wurde mittels Formular auf freizeitsportler.ch versendet. Wenn du darauf antwortest, erreichst du den Absender über seine Mailadresse.'
								]);
							$mailerInterface = GeneralUtility::makeInstance(Mailer::class);
							$mailerInterface->send($mail);
						
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