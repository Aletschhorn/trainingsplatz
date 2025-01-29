<?php
namespace DW\Trainingsplatz\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class MotivationRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	protected $defaultOrderings = ['sorting' => QueryInterface::ORDER_ASCENDING];
	
	public function findAll(): QueryResultInterface 
	{
        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
        return $query->execute();
	}

}