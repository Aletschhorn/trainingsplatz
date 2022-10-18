<?php
namespace DW\Trainingsplatz\Controller;

use DW\Trainingsplatz\Domain\Repository\MotivationRepository;
use DW\Trainingsplatz\Domain\Repository\SportRepository;
use In2code\Femanager\Domain\Model\User;

class NewController extends \In2code\Femanager\Controller\NewController {

	protected $motivationRepository;
	
	protected $sportRepository;
	
	public function __construct (
			MotivationRepository $motivationRepository,
			SportRepository $sportRepository
	) {
		$this->motivationRepository = $motivationRepository;
		$this->sportRepository = $sportRepository;
	}
	

    /**
     * action new
     *
     */
    public function newAction(User $user = NULL): ResponseInterface {
		$motivations = $this->motivationRepository->findAll();
		$this->view->assign('motivations', $motivations);
		parent::newAction();
	}

	/**
	* action initializeCreate
	*
	*/
	public function initializeCreateAction() {
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
			$user->setDataType(\In2code\Femanager\Domain\Model\User::class);
		}
		// parent::initializeCreateAction();
	}

	/**
	* action create
	*
    * @TYPO3\CMS\Extbase\Annotation\Validate("In2code\Femanager\Domain\Validator\ServersideValidator", param="user")
    * @TYPO3\CMS\Extbase\Annotation\Validate("In2code\Femanager\Domain\Validator\PasswordValidator", param="user")
	* @return void
	*/
	public function createAction(User $user) {
		// Default values
		$user->setTxTrainingsplatzInfomail(1);
		$user->setTxTrainingsplatzNewsletter(1);
		$user->setTxTrainingsplatzContest(1);
		$user->setName($user->getFirstName().' '.$user->getLastName());
		
		parent::createAction($user);
	}
}
?>