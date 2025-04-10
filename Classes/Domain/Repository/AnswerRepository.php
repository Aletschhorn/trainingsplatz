<?php

namespace DW\Trainingsplatz\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use DW\Trainingsplatz\Domain\Model\Training;

class AnswerRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	protected $defaultOrderings = ['creationDate' => QueryInterface::ORDER_ASCENDING];
	
	public function findPerTraining(Training $training): QueryResultInterface 
	{
		$query = $this->createQuery();
		return $query->matching(
			$query->equals('training',$training)
		)->execute();
	}

	public function countPerTrainingAndNotMember(Training $training): int
	{
		$query = $this->createQuery();
		return $query->matching(
			$query->logicalAnd(
				$query->equals('training',$training),
				$query->equals('feuser',''),
				$query->equals('cancelled',0)
			)
		)->execute()->count();
	}

	public function findPerTrainingAndPerson(Training $training, \In2code\Femanager\Domain\Model\User $author): QueryResultInterface 
	{
		$query = $this->createQuery();
		return $query->matching(
			$query->logicalAnd(
				$query->equals('training',$training),
				$query->equals('feuser',$author)
			)
		)->execute();
	}

	public function findPerTrainingAndEmail(Training $training, string $email): QueryResultInterface 
	{
		$query = $this->createQuery();
		return $query->matching(
			$query->logicalAnd(
				$query->equals('training',$training),
				$query->equals('email',$email),
				$query->equals('cancelled',0)
			)
		)->execute();
	}

	public function findPerTrainingCorrected(Training $training): int
	{
		$query = $this->createQuery();
		return $query->matching(
			$query->logicalAnd(
				$query->equals('training',$training),
				$query->equals('cancelled',false),
				$query->equals('owntraining',false)
			)
		)->count();
	}

	public function findPerTrainings(array $trainingUids): QueryResultInterface 
	{
		$query = $this->createQuery();
		return $query->matching(
			$query->in('training',$trainingUids)
		)->execute();
	}

	public function findByTrainingAndUser(Training $training, int $userId): QueryResultInterface 
	{
		$query = $this->createQuery();
		return $query->matching(
			$query->logicalAnd(
				$query->equals('training',$training),
				$query->equals('feuser',$userId)
			)
		)->execute();
	}
	
	public function findRated(\DateTime $startDate = NULL, \DateTime $endDate = NULL): QueryResultInterface 
	{
		$query = $this->createQuery();
		$contraints = [$query->equals('points',2)];
		if ($startDate) {
			$contraints[] = $query->greaterThanOrEqual('training.trainingDate',$startDate->format('Y-m-d H-i-s'));
		}
		if ($endDate) {
			$contraints[] = $query->lessThan('training.trainingDate',$endDate->format('Y-m-d H-i-s'));
		}
		$query->matching($query->logicalAnd(...$contraints));
		return $query->execute();
	}
	
	public function findEvaluatedByUser(int $userId, \DateTime $startDate = NULL): QueryResultInterface 
	{	
		$today = new \DateTime('today');
		$query = $this->createQuery();
		$constraints = array(
			$query->equals('feuser',$userId),
			$query->equals('training.cancelled',0),
			$query->lessThan('training.trainingDate',$today->format('Y-m-d H-i-s'))		
		);
		if ($startDate) {
			$constraints[] = $query->greaterThanOrEqual('training.trainingDate',$startDate->format('Y-m-d H-i-s'));
		}
		$query->matching($query->logicalAnd(...$constraints));
		return $query->execute();
	}
	
	public function countPointsByUser(int $userId, \DateTime $startDate = NULL): int
	{
		$today = new \DateTime('today');
		$query = $this->createQuery();
		$constraints = array(
			$query->equals('feuser',$userId),
			$query->equals('points',2),
			$query->equals('training.cancelled',0),
			$query->lessThan('training.trainingDate',$today->format('Y-m-d H-i-s'))
		);
		if ($startDate) {
			$constraints[] = $query->greaterThanOrEqual('training.trainingDate',$startDate->format('Y-m-d H-i-s'));
		}
		$query->matching($query->logicalAnd(...$constraints));
		return $query->count();
	}

	public function findCompensated(\DateTime $startDate = NULL): QueryResultInterface 
	{	
		$today = new \DateTime('today');
		$query = $this->createQuery();
		$constraints = array(
			$query->equals('compensation',2),
			$query->equals('training.cancelled',0),
			$query->equals('training.closed',1),
			$query->lessThan('training.trainingDate',$today->format('Y-m-d H-i-s'))		
		);
		if ($startDate) {
			$constraints[] = $query->greaterThanOrEqual('training.trainingDate',$startDate->format('Y-m-d H-i-s'));
		}
		$query->matching($query->logicalAnd(...$constraints));
		return $query->execute();
	}
	
	public function findCompensatedByTrainer(\DW\Trainingsplatz\Domain\Model\User $user, \DateTime $startDate = NULL): QueryResultInterface 
	{	
		$today = new \DateTime('today');
		$query = $this->createQuery();
		$constraints = array(
			$query->equals('compensation',2),
			$query->logicalOr($query->equals('training.author',$user),$query->equals('training.leader',$user)),
			$query->equals('training.cancelled',0),
			$query->equals('training.closed',1),
			$query->lessThan('training.trainingDate',$today->format('Y-m-d H-i-s'))		
		);
		if ($startDate) {
			$constraints[] = $query->greaterThanOrEqual('training.trainingDate',$startDate->format('Y-m-d H-i-s'));
		}
		$query->matching($query->logicalAnd(...$constraints));
		$query->setOrderings(array('training.trainingDate' => QueryInterface::ORDER_ASCENDING));
		return $query->execute();
	}
	
	public function countCompensatedByTrainer(int $userId, \DateTime $startDate = NULL): int
	{	
		$today = new \DateTime('today');
		$query = $this->createQuery();
		$constraints = array(
			$query->equals('training.author',$userId),
			$query->equals('training.cancelled',0),
			$query->lessThan('training.trainingDate',$today->format('Y-m-d H-i-s')),
			$query->equals('training.closed',1),
			$query->equals('compensation',2)
		);
		if ($startDate) {
			$constraints[] = $query->greaterThanOrEqual('training.trainingDate',$startDate->format('Y-m-d H-i-s'));
		}
		$query->matching($query->logicalAnd(...$constraints));
		return $query->count();
	}

}