<?php
namespace DW\Trainingsplatz\Domain\Repository;

class SportRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	protected $defaultOrderings = ['sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING];
	
}