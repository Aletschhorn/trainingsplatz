<?php
namespace DW\Trainingsplatz\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use DW\Trainingsplatz\Domain\Model\Training;

class InfomailRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	public function findFuture(): QueryResultInterface 
	{
		$today = new \DateTime('today');
		$query = $this->createQuery();
		return $query
			->matching(
				$query->greaterThanOrEqual('training.trainingDate',$today->format('Y-m-d H-i-s'))
			)
			->setOrderings(['training.trainingDate' => QueryInterface::ORDER_ASCENDING])
			->execute();
	}

	public function findFutureByStatus(int $status = 0): QueryResultInterface
	{
		$today = new \DateTime('today');
		$query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
		return $query
			->matching(
				$query->logicalAnd(
					$query->equals('status',$status),
					$query->greaterThanOrEqual('training.trainingDate',$today->format('Y-m-d H-i-s'))
				)
			)
			->setOrderings(['training.trainingDate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING])
			->execute();
	}

	public function findPerTraining(Training $training): QueryResultInterface 
	{
		$query = $this->createQuery();
		return $query->matching(
			$query->equals('training',$training)
		)->execute();
	}

	public function countPerTraining(Training $training): int
	{
		$query = $this->createQuery();
		return $query->matching(
			$query->equals('training',$training)
		)->count();
	}

	public function findPerTrainingAndStatus(Training $training, int $status = 0): QueryResultInterface 
	{
		$query = $this->createQuery();
		return $query->matching(
			$query->logicalAnd(
				$query->equals('training',$training),
				$query->equals('status',$status)
			)
		)->execute();
	}

}