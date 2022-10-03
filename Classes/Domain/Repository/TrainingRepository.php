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
 * The repository for Trainings
 */
class TrainingRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	* defaultOrderings
	*
	* @var array
	*/
	protected $defaultOrderings = array(
		'trainingDate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING, 
		'title' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);
	

	/**
	* findFuture
	*
    * @param int $limit
    * @param boolean $inclCancelled
	* @return
	*/
	public function findFuture($limit = 0, $inclCancelled = 1) {

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

	/**
	* findFutureFiltered
	*
    * @param int $sportsUid
    * @param int $limit
    * @param boolean $inclCancelled
	* @return
	*/
	public function findFutureFiltered($sportsUid, $limit = 0, $inclCancelled = 1) {

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

	/**
	* findPast
	*
	* @return
	*/
	public function findPast() {

		$today = new \DateTime('today');
		$query = $this->createQuery();
		$result = $query->matching(
			$query->logicalAnd(
				$query->equals('public',1),
				$query->lessThan('trainingDate',$today->format('Y-m-d H-i-s')),
				$query->equals('closed',0)
			)
		)->execute();

		return $result;
	}

	/**
	* findClosed
	*
    * @param DateTime $startDate
	* @return
	*/
	public function findClosed($startDate = NULL) {
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
		$query->matching($query->logicalAnd($constraints));
		return $query->execute();
	}

	/**
	* findClosedPerUser
	*
    * @param int $user ID of frontend user
    * @param DateTime $startDate
	* @return
	*/
	public function findClosedPerUser($user, $startDate = NULL) {
		$today = new \DateTime('today');
		$query = $this->createQuery();
		$constraints = array(
			$query->equals('author',$user),
			$query->equals('cancelled',0),
			$query->lessThan('trainingDate',$today->format('Y-m-d H-i-s')),
			$query->equals('closed',1),
		);
		if ($startDate) {
			$constraints[] = $query->greaterThanOrEqual('trainingDate',$startDate->format('Y-m-d H-i-s'));
		}
		$query->matching($query->logicalAnd($constraints));
		return $query->execute();
	}
	
	/**
	* findPerYear
	*
    * @param int $year
    * @param boolean $inclCancelled
	* @return
	*/
	public function findPerYear($year, $inclCancelled = 1) {
		
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
		
		$query->matching($query->logicalAnd($constraints));

		return $query->execute();
	}

}