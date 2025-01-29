<?php
namespace DW\Trainingsplatz\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class TrainingRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	protected $defaultOrderings = [
		'trainingDate' => QueryInterface::ORDER_ASCENDING, 
		'title' => QueryInterface::ORDER_ASCENDING
	];
	

	public function findFuture(int $limit = 0, bool $inclCancelled = 1): QueryResultInterface
	{
		$today = new \DateTime('today');
		$query = $this->createQuery();
		
		$constraints = array (
			$query->equals('public',1),
			$query->greaterThanOrEqual('trainingDate',$today->format('Y-m-d H-i-s'))
		);
		if ($inclCancelled == false) {
			$constraints[] = $query->equals('cancelled',0);
		}
		
		$query->matching($query->logicalAnd($constraints));
		if ($limit > 0) {
			$query->setLimit($limit);
		}

		return $query->execute();
	}

	public function findFutureFiltered(int $sportsUid, int $limit = 0, bool $inclCancelled = 1): QueryResultInterface 
	{
		$today = new \DateTime('today');
		$query = $this->createQuery();

		$constraints = array (
			$query->equals('public',1),
			$query->greaterThanOrEqual('trainingDate',$today->format('Y-m-d H-i-s')),
			$query->equals('sport',$sportsUid)
		);
		if ($inclCancelled == false) {
			$constraints[] = $query->equals('cancelled',0);
		}

		$query->matching($query->logicalAnd($constraints));
		if ($limit > 0) {
			$query->setLimit($limit);
		}

		return $query->execute();
	}

	public function findPast(): QueryResultInterface 
	{
		$today = new \DateTime('today');
		$query = $this->createQuery();
		return $query->matching(
			$query->logicalAnd(
				$query->equals('public',1),
				$query->lessThan('trainingDate',$today->format('Y-m-d H-i-s')),
				$query->equals('closed',0)
			)
		)->execute();
	}

	public function findClosed(\DateTime $startDate = NULL): QueryResultInterface
	{
		$today = new \DateTime('today');
		$query = $this->createQuery();
		$constraints = array(
			$query->equals('cancelled',0),
			$query->lessThan('trainingDate',$today->format('Y-m-d H-i-s')),
			$query->equals('closed',1),
		);
		if ($startDate) {
			$constraints[] = $query->greaterThanOrEqual('trainingDate',$startDate->format('Y-m-d H-i-s'));
		}
		return $query->matching($query->logicalAnd($constraints))->execute();
	}

	public function findClosedPerUser(int $userId, \DateTime $startDate = NULL): QueryResultInterface 
	{
		$today = new \DateTime('today');
		$query = $this->createQuery();
		$constraints = array(
			$query->equals('author',$userId),
			$query->equals('cancelled',0),
			$query->lessThan('trainingDate',$today->format('Y-m-d H-i-s')),
			$query->equals('closed',1),
		);
		if ($startDate) {
			$constraints[] = $query->greaterThanOrEqual('trainingDate',$startDate->format('Y-m-d H-i-s'));
		}
		return $query->matching($query->logicalAnd($constraints))->execute();
	}
	
	public function findPerYear(int $year, bool $inclCancelled = 1): QueryResultInterface
	{
		if ($year < 2016 or $year > date('Y')) {
			return false;
		}
		
		$query = $this->createQuery();
		$constraints = array (
			$query->equals('public',1),
			$query->greaterThanOrEqual('trainingDate',$year.'-01-01 00:00:00'),
			$query->lessThanOrEqual('trainingDate',$year.'-12-31 23:59:59'),			
		);
		if ($inclCancelled == false) {
			$constraints[] = $query->equals('cancelled',0);
		}
		return $query->matching($query->logicalAnd($constraints))->execute();
	}

}