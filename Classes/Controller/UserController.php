<?php
namespace DW\Trainingsplatz\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;
use TYPO3\CMS\Core\Pagination\SimplePagination;

class UserController extends \In2code\Femanager\Controller\UserController {

    public function listAction (array $filter = []): ResponseInterface
    {
        $itemsPerPage = 20;
        $currentPage = 1;
		if ($this->request->hasArgument('currentPage')) {
			$currentPage = max([1, intval($this->request->getArgument('currentPage'))]);
		}

		$users = $this->userRepository->findByUsergroups(
        	$this->settings['list']['usergroup'] ?? '',
            $this->settings,
            $filter
        );
		
        $paginator = new QueryResultPaginator($users, $currentPage, $itemsPerPage);
        $pagination = new SimplePagination($paginator);

		$this->view->assignMultiple([
			'users' => $users,
			'filter' => $filter,
            'pagination' => $pagination,
            'paginator' => $paginator,
		]);
		$this->assignForAll();
		
		return $this->htmlResponse();
	}
}