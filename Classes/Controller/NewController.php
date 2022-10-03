<?php
namespace DW\Trainingsplatz\Controller;

use DW\Trainingsplatz\Domain\Repository\MotivationRepository;
use DW\Trainingsplatz\Domain\Repository\SportRepository;

class NewController extends \In2code\Femanager\Controller\NewController {

	/**
	 * motivationRepository
	 *
	 * @var MotivationRepository
	 */
	protected $motivationRepository;
	
	/**
	 * sportRepository
	 *
	 * @var SportRepository
	 */
	protected $sportRepository;
	
	/**
	 * @param MotivationRepository $motivationRepository
	 * @param SportRepository $sportRepository
	 */
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
	 * @param In2code\Femanager\Domain\Model\User $user
     * @return void
     */
    public function newAction($user = NULL) {
		$motivations = $this->motivationRepository->findAll();
		$this->view->assign('motivations', $motivations);
		parent::newAction();
	}

	/**
	* action initializeCreate
	*
	* @return void
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
    * @param In2code\Femanager\Domain\Model\User $user
    * @TYPO3\CMS\Extbase\Annotation\Validate("In2code\Femanager\Domain\Validator\ServersideValidator", param="user")
    * @TYPO3\CMS\Extbase\Annotation\Validate("In2code\Femanager\Domain\Validator\PasswordValidator", param="user")
	* @return void
	*/
	public function createAction($user): void {
		// Default values
		$user->setTxTrainingsplatzInfomail(1);
		$user->setTxTrainingsplatzNewsletter(1);
		$user->setTxTrainingsplatzContest(1);
		$user->setName($user->getFirstName().' '.$user->getLastName());
		
		parent::createAction($user);
	}
}
?>