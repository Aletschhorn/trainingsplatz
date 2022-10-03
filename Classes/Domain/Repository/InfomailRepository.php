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
 * The repository for Infomails
 */
class InfomailRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	* findFuture
	*
	* @return
	*/
	public function findFuture() {

		$today = new \DateTime('today');
		$query = $this->createQuery();
		$result = $query->matching(
			$query->greaterThanOrEqual('training.trainingDate',$today->format('Y-m-d H-i-s'))
		)->setOrderings(array('training.trainingDate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING))->execute();

		return $result;
	}

	/**
	* findFutureByStatus
	*
    * @param int $status
	* @return
	*/
	public function findFutureByStatus($status = 0) {

		$today = new \DateTime('today');
		$query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);
		$result = $query->matching(
			$query->logicalAnd(
				$query->equals('status',$status),
				$query->greaterThanOrEqual('training.trainingDate',$today->format('Y-m-d H-i-s'))
			)
		)->setOrderings(array('training.trainingDate' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING))->execute();

		return $result;
	}

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
	* countPerTraining
	*
    * @param \DW\Trainingsplatz\Domain\Model\Training $training
	* @return
	*/
	public function countPerTraining($training) {

		$query = $this->createQuery();
		$result = $query->matching(
			$query->equals('training',$training)
		)->count();

		return $result;
	}

	/**
	* findPerTrainingAndStatus
	*
    * @param \DW\Trainingsplatz\Domain\Model\Training $training
    * @param int $status
	* @return
	*/
	public function findPerTrainingAndStatus($training, $status = 0) {

		$query = $this->createQuery();
		$result = $query->matching(
			$query->logicalAnd(
				$query->equals('training',$training),
				$query->equals('status',$status)
			)
		)->execute();

		return $result;
	}

}