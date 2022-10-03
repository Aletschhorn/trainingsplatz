<?php
namespace DW\Trainingsplatz\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * The repository for Answers
 */
class AnswerRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	* defaultOrderings
	*
	* @var array
	*/
	protected $defaultOrderings = array('creationDate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING);
	
	/**
	* findPerTraining
	*
    * @param \DW\Trainingsplatz\Domain\Model\Training $training
	* @return
	*/
	public function findPerTraining($training) {

		$query = $this->createQuery();
		$result = $query->matching(
			$query->equals('training',$training)
		)->execute();

		return $result;
	}

	/**
	* countPerTrainingAndNotMember
	*
    * @param \DW\Trainingsplatz\Domain\Model\Training $training
	* @return
	*/
	public function countPerTrainingAndNotMember($training) {

		$query = $this->createQuery();
		$result = $query->matching(
			$query->logicalAnd(
				$query->equals('training',$training),
				$query->equals('feuser',''),
				$query->equals('cancelled',0)
			)
		)->execute()->count();

		return $result;
	}

	/**
	* findPerTrainingAndPerson
	*
    * @param \DW\Trainingsplatz\Domain\Model\Training $training
    * @param \In2code\Femanager\Domain\Model\User $author
	* @return
	*/
	public function findPerTrainingAndPerson($training, $author) {

		$query = $this->createQuery();
		$result = $query->matching(
			$query->logicalAnd(
				$query->equals('training',$training),
				$query->equals('feuser',$author)
			)
		)->execute();

		return $result;
	}

	/**
	* findPerTrainingAndEmail
	*
    * @param \DW\Trainingsplatz\Domain\Model\Training $training
    * @param \string $email
	* @return
	*/
	public function findPerTrainingAndEmail($training, $email) {

		$query = $this->createQuery();
		$result = $query->matching(
			$query->logicalAnd(
				$query->equals('training',$training),
				$query->equals('email',$email),
				$query->equals('cancelled',0)
			)
		)->execute();

		return $result;
	}

	/**
	* findPerTrainingCorrected
	*
    * @param \DW\Trainingsplatz\Domain\Model\Training $training
	* @return
	*/
	public function findPerTrainingCorrected($training) {

		$query = $this->createQuery();
		$result = $query->matching(
			$query->logicalAnd(
				$query->equals('training',$training),
				$query->equals('cancelled',false),
				$query->equals('owntraining',false)
			)
		)->count();

		return $result;
	}

	/**
	* findPerTrainings
	*
    * @param array $trainings List of training UIDs
	* @return
	*/
	public function findPerTrainings($trainings) {

		$query = $this->createQuery();
		$result = $query->matching(
			$query->in('training',$trainings)
		)->execute();

		return $result;
	}

	/**
	* findByTrainingAndUser
	*
    * @param \DW\Trainingsplatz\Domain\Model\Training $training
    * @param \int $userId
	* @return
	*/
	public function findByTrainingAndUser($training, $userId) {

		$query = $this->createQuery();
		$result = $query->matching(
			$query->logicalAnd(
				$query->equals('training',$training),
				$query->equals('feuser',$userId)
			)
		)->execute();

		return $result;
	}
	
	/**
	* findRated
	*
    * @param DateTime $startDate
    * @param DateTime $endDate
	* @return
	*/
	public function findRated($startDate = NULL, $endDate = NULL) {
		$query = $this->createQuery();
		$contraints = [$query->equals('points',2)];
		if ($startDate) {
			$contraints[] = $query->greaterThanOrEqual('training.trainingDate',$startDate->format('Y-m-d H-i-s'));
		}
		if ($endDate) {
			$contraints[] = $query->lessThan('training.trainingDate',$endDate->format('Y-m-d H-i-s'));
		}
		$query->matching($query->logicalAnd($contraints));
		return $query->execute();
	}
	
	/**
	* findEvaluatedByUser
	*
    * @param int $user ID of frontend user
    * @param DateTime $startDate
	* @return
	*/
	public function findEvaluatedByUser($user, $startDate = NULL) {	
		$today = new \DateTime('today');
		$query = $this->createQuery();
		$constraints = array(
			$query->equals('feuser',$user),
			$query->equals('training.cancelled',0),
			$query->lessThan('training.trainingDate',$today->format('Y-m-d H-i-s'))		
		);
		if ($startDate) {
			$constraints[] = $query->greaterThanOrEqual('training.trainingDate',$startDate->format('Y-m-d H-i-s'));
		}
		$query->matching($query->logicalAnd($constraints));
		return $query->execute();
	}
	
	/**
	* countPointsByUser
	*
    * @param int $user ID of frontend user
    * @param DateTime $startDate
	* @return
	*/
	public function countPointsByUser($user, $startDate = NULL) {
		$today = new \DateTime('today');
		$query = $this->createQuery();
		$constraints = array(
			$query->equals('feuser',$user),
			$query->equals('points',2),
			$query->equals('training.cancelled',0),
			$query->lessThan('training.trainingDate',$today->format('Y-m-d H-i-s'))
		);
		if ($startDate) {
			$constraints[] = $query->greaterThanOrEqual('training.trainingDate',$startDate->format('Y-m-d H-i-s'));
		}
		$query->matching($query->logicalAnd($constraints));
		return $query->count();
	}

	/**
	* findCompensated
	*
    * @param DateTime $startDate
	* @return
	*/
	public function findCompensated($startDate = NULL) {	
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
		$query->matching($query->logicalAnd($constraints));
		return $query->execute();
	}
	
	/**
	* findCompensatedByTrainer
	*
    * @param int $user ID of frontend user
    * @param DateTime $startDate
	* @return
	*/
	public function findCompensatedByTrainer($user, $startDate = NULL) {	
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
		$query->matching($query->logicalAnd($constraints));
		$query->setOrderings(array('training.trainingDate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
		return $query->execute();
	}
	
	/**
	* countCompensatedByTrainer
	*
    * @param int $user ID of frontend user
    * @param DateTime $startDate
	* @return
	*/
	public function countCompensatedByTrainer($user, $startDate = NULL) {	
		$today = new \DateTime('today');
		$query = $this->createQuery();
		$constraints = array(
			$query->equals('training.author',$user),
			$query->equals('training.cancelled',0),
			$query->lessThan('training.trainingDate',$today->format('Y-m-d H-i-s')),
			$query->equals('training.closed',1),
			$query->equals('compensation',2)
		);
		if ($startDate) {
			$constraints[] = $query->greaterThanOrEqual('training.trainingDate',$startDate->format('Y-m-d H-i-s'));
		}
		$query->matching($query->logicalAnd($constraints));
		return $query->count();
	}
	

}