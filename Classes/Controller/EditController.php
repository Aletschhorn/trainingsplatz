<?php
namespace DW\Trainingsplatz\Controller;

use Psr\Http\Message\ResponseInterface;
use DW\Trainingsplatz\Domain\Repository\MotivationRepository;
use DW\Trainingsplatz\Domain\Repository\SportRepository;
use DW\Trainingsplatz\Property\TypeConverter\BitConverter;
use In2code\Femanager\Domain\Model\User;

class EditController extends \In2code\Femanager\Controller\EditController {

	private $bitConverter;
	
	public function injectBitConverter (BitConverter $bitConverter) {
		$this->bitConverter = $bitConverter;
	}

    /**
     * action edit
     *
     */
    public function editAction(): ResponseInterface {
		$motivationRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(MotivationRepository::class);
		$motivations = $motivationRepository->findAll();
		$this->view->assign('motivations', $motivations);
		return parent::editAction();
	}

	/**
	* action initializeUpdate
	*
	*/
	public function initializeUpdateAction(): void {
		if ($this->arguments->hasArgument('user')) {
			$this->arguments->getArgument('user')->getPropertyMappingConfiguration()->forProperty('txTrainingsplatzSports')->setTypeConverter($this->bitConverter);
		}
	}

	/**
	* action update
	*
    * @TYPO3\CMS\Extbase\Annotation\Validate("In2code\Femanager\Domain\Validator\ServersideValidator", param="user")
    * @TYPO3\CMS\Extbase\Annotation\Validate("In2code\Femanager\Domain\Validator\PasswordValidator", param="user")
    * @TYPO3\CMS\Extbase\Annotation\Validate("In2code\Femanager\Domain\Validator\CaptchaValidator", param="captcha")
    */
    public function updateAction(User $user, string $captcha = null): ResponseInterface {
		$user->setName($user->getFirstName().' '.$user->getLastName());
		return parent::updateAction($user, $captcha);
	}

    /**
     * action delete
     *
     */
    public function deleteAction(User $user): ResponseInterface {
		$mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
		$mailtext = 'Das Mitglied '.$user->getName().' hat sein Profil auf freizeitsportler.ch gelöscht.'.chr(10).chr(10).'----------'.chr(10).'Das ist ein automatisch generiertes E-Mail. Bitte nicht darauf antworten.';
		$mail = new \TYPO3\CMS\Core\Mail\MailMessage;
		$mail->from(new \Symfony\Component\Mime\Address('notification@freizeitsportler.ch', 'freizeitsportler.ch'));
		$mail->to(new \Symfony\Component\Mime\Address('rolf.kaegi@freizeitsportler.ch', 'Rolf Kägi'), new \Symfony\Component\Mime\Address('db@freizeitsportler.ch', 'fs.ch-Adress-Datenbank'));
		$mail->subject('Mitglied gelöscht');
		$mail->text($mailtext);
		$mail->html('<div style="font-family:sans-serif">'.str_replace(chr(10),'<br />',$mailtext).'</div>');
		$mail->send();
		return parent::deleteAction($user);
    }

}
