<?php
namespace DW\Trainingsplatz\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Core\Context\Context;

use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;

use In2code\Femanager\Domain\Repository\UserRepository;

/**
 * UserController
 */
class UserController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	private $userRepository;	
	
	public function __construct (
			UserRepository $userRepository, 
			private readonly Context $context
	) {
		$this->userRepository = $userRepository;
	}
	

	public function birthdayAction(): ResponseInterface {
		$usergroups = explode (',', $this->settings['usergroups']);
		$todayDate = new \DateTime ('today');
		$tomorrowDate = new \DateTime ('tomorrow');
		$todayUser = $this->userRepository->findBirthdayToday(0, $usergroups);
		$tomorrowUser = $this->userRepository->findBirthdayToday(1, $usergroups);
		$this->view->assignMultiple([
			'todayUser' => $todayUser,
			'tomorrowUser' => $tomorrowUser,
			'todayDate' => $todayDate,
			'tomorrowDate' => $tomorrowDate,
		]);
		return $this->htmlResponse();
	}


	public function messageAction(): ResponseInterface {
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
		return $this->htmlResponse();
	}


	public function messageSendAction(): ResponseInterface {
		$arguments = $this->request->getArguments();
		if ($arguments['member']) {
			$recipient = $this->userRepository->findByUid(intval($arguments['member']));
			if ($recipient) {
				$senderId = $this->context->getPropertyFromAspect('frontend.user', 'id');
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
						
							$this->addFlashMessage('E-Mail wurde versendet','',ContextualFeedbackSeverity::OK);
							return $this->redirect('message','User','trainingsplatz',array('member' => $arguments['member'], 'sent' => 1));
						} else {
							$this->addFlashMessage('Betreff und Inhalt dürfen nicht leer sein','',ContextualFeedbackSeverity::WARNING);
							return $this->redirect('message','User','trainingsplatz',array('member' => $arguments['member'], 'sent' => 0));
						}
					} else {
						$this->addFlashMessage('E-Mail konnte nicht versendet werden','',ContextualFeedbackSeverity::WARNING);
						return $this->redirect('message','User','trainingsplatz',array('member' => $arguments['member'], 'sent' => 1));
					}
				} else {
					$this->addFlashMessage('E-Mail konnte nicht versendet werden','',ContextualFeedbackSeverity::WARNING);
					return $this->redirect('message','User','trainingsplatz',array('member' => $arguments['member'], 'sent' => 1));
				}
			} else {
				$this->addFlashMessage('E-Mail konnte nicht versendet werden','',ContextualFeedbackSeverity::WARNING);
				return $this->redirect('message','User','trainingsplatz',array('member' => $arguments['member'], 'sent' => 1));
			}
		} else {
			$this->addFlashMessage('E-Mail konnte nicht versendet werden','',ContextualFeedbackSeverity::WARNING);
			return $this->redirect('message','User','trainingsplatz',array('member' => $arguments['member'], 'sent' => 1));
		}
	}

}