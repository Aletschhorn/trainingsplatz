<?php
namespace DW\Trainingsplatz\Controller;

use DW\Trainingsplatz\Domain\Repository\MotivationRepository;
use DW\Trainingsplatz\Domain\Repository\SportRepository;
use In2code\Femanager\Domain\Model\User;

class EditController extends \In2code\Femanager\Controller\EditController {

    /**
     * action edit
     *
     * @return void
     */
    public function editAction(): ResponseInterface {
		$motivationRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(MotivationRepository::class);
		$motivations = $motivationRepository->findAll();
		$this->view->assign('motivations', $motivations);
		parent::editAction();
	}

	/**
	* action initializeUpdate
	*
	* @return void
	*/
	public function initializeUpdateAction() {
        $userValues = $this->request->getArgument('user');
		if ($source = $userValues['txTrainingsplatzSports']) {
			$sum = 0;
			if (is_array($source)) {
				foreach ($source as $key => $value) {
					$sum += $value;
				}
			} else {
				$sum = $source;
			}
			$this->pluginVariables['user']['txTrainingsplatzSports'] = $sum;
		}
		if ($this->arguments->hasArgument('user')) {
			$user = $this->arguments['user'];
			// $user->setDataType(\In2code\Femanager\Domain\Model\User::class);
		}
		parent::initializeUpdateAction();
	}

	/**
	* action update
	*
    * @TYPO3\CMS\Extbase\Annotation\Validate("In2code\Femanager\Domain\Validator\ServersideValidator", param="user")
    * @TYPO3\CMS\Extbase\Annotation\Validate("In2code\Femanager\Domain\Validator\PasswordValidator", param="user")
    */
    public function updateAction(User $user) {
		$user->setName($user->getFirstName().' '.$user->getLastName());
		parent::updateAction($user);
	}

    /**
     * action delete
     *
     */
    public function deleteAction(User $user) {
		$mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
		$mailtext = 'Das Mitglied '.$user->getName().' hat sein Profil auf freizeitsportler.ch gelöscht.'.chr(10).chr(10).'----------'.chr(10).'Das ist ein automatisch generiertes E-Mail. Bitte nicht darauf antworten.';
		$mail = new \TYPO3\CMS\Core\Mail\MailMessage;
		$mail->from(new \Symfony\Component\Mime\Address('notification@freizeitsportler.ch', 'freizeitsportler.ch'));
		$mail->to(new \Symfony\Component\Mime\Address('rolf.kaegi@freizeitsportler.ch', 'Rolf Kägi'), new \Symfony\Component\Mime\Address('db@freizeitsportler.ch', 'fs.ch-Adress-Datenbank'));
		$mail->subject('Mitglied gelöscht');
		$mail->text($mailtext);
		$mail->html('<div style="font-family:sans-serif">'.str_replace(chr(10),'<br />',$mailtext).'</div>');
		$mail->send();
		parent::deleteAction($user);
    }

}
?>