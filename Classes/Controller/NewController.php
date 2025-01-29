<?php
namespace DW\Trainingsplatz\Controller;

use Psr\Http\Message\ResponseInterface;
use DW\Trainingsplatz\Domain\Repository\MotivationRepository;
use In2code\Femanager\Domain\Model\User;

class NewController extends \In2code\Femanager\Controller\NewController {

    /**
     * action new
     *
     */
    public function newAction(User $user = NULL): ResponseInterface {
		$motivationRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(MotivationRepository::class);
		$motivations = $motivationRepository->findAll();
		$this->view->assign('motivations', $motivations);
		parent::newAction();
		return $this->htmlResponse();
	}

	/**
	* action initializeCreate
	*
	*/
	public function initializeCreateAction(): void {
		if ($this->arguments->hasArgument('user')) {
			$this->arguments->getArgument('user')->getPropertyMappingConfiguration()->forProperty('txTrainingsplatzSports')->setTypeConverter(
				$this->objectManager->get(\DW\Trainingsplatz\Property\TypeConverter\BitConverter::class)
			);
		}
	}

	/**
	* action create
	*
    * @TYPO3\CMS\Extbase\Annotation\Validate("In2code\Femanager\Domain\Validator\ServersideValidator", param="user")
    * @TYPO3\CMS\Extbase\Annotation\Validate("In2code\Femanager\Domain\Validator\PasswordValidator", param="user")
    * @TYPO3\CMS\Extbase\Annotation\Validate("In2code\Femanager\Domain\Validator\CaptchaValidator", param="captcha")
	* @return void
	*/
	public function createAction(User $user, string $captcha = null): ResponseInterface {
		// Default values
		$user->setTxTrainingsplatzInfomail(1);
		$user->setTxTrainingsplatzNewsletter(1);
		$user->setTxTrainingsplatzContest(1);
		$user->setName($user->getFirstName().' '.$user->getLastName());
		
		parent::createAction($user, $captcha);
		return $this->htmlResponse();
	}
}
?>