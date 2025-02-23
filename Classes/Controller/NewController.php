<?php
namespace DW\Trainingsplatz\Controller;

use Psr\Http\Message\ResponseInterface;
use DW\Trainingsplatz\Domain\Repository\MotivationRepository;
use DW\Trainingsplatz\Property\TypeConverter\BitConverter;
use In2code\Femanager\Domain\Model\User;

class NewController extends \In2code\Femanager\Controller\NewController {
	
	private $bitConverter;
	
	public function injectBitConverter (BitConverter $bitConverter) {
		$this->bitConverter = $bitConverter;
	}

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
			$this->arguments->getArgument('user')->getPropertyMappingConfiguration()->forProperty('txTrainingsplatzSports')->setTypeConverter($this->bitConverter);
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
		$user->setTxTrainingsplatzInfomail(true);
		$user->setTxTrainingsplatzNewsletter(true);
		$user->setTxTrainingsplatzContest(true);
		$user->setName($user->getFirstName().' '.$user->getLastName());
		
		return parent::createAction($user, $captcha);

	}
}
?>