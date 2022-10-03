<?php
namespace DW\Trainingsplatz\Domain\Model;

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
 * Answer
 */
class Answer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * creationDate
	 *
	 * @var \DateTime
	 */
	protected $creationDate = NULL;

	/**
	 * changeDate
	 *
	 * @var \DateTime
	 */
	protected $changeDate = NULL;

	/**
	 * author
	 *
	 * @var string
	 */
	protected $author = '';

	/**
	 * email
	 *
	 * @var string
	 */
	protected $email = '';

	/**
	 * feuser
	 *
	 * @var \In2code\Femanager\Domain\Model\User
	 */
	protected $feuser = '';

	/**
	 * owntraining
	 *
	 * @var int
	 */
	protected $owntraining = 0;

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * cancelled
	 *
	 * @var boolean
	 */
	protected $cancelled = FALSE;

	/**
	 * points
	 *
	 * @var int
	 */
	protected $points = 0;

	/**
	 * compensation
	 *
	 * @var int
	 */
	protected $compensation = 0;

	/**
	 * training
	 *
	 * @var \DW\Trainingsplatz\Domain\Model\Training
	 */
	protected $training = NULL;

	/**
	 * hash
	 *
	 * @var string
	 */
	protected $hash = '';

	/**
	 * Returns the creationDate
	 *
	 * @return \DateTime $creationDate
	 */
	public function getCreationDate() {
		return $this->creationDate;
	}

	/**
	 * Sets the creationDate
	 *
	 * @param \DateTime $creationDate
	 * @return void
	 */
	public function setCreationDate(\DateTime $creationDate) {
		$this->creationDate = $creationDate;
	}

	/**
	 * Returns the changeDate
	 *
	 * @return \DateTime $changeDate
	 */
	public function getChangeDate() {
		return $this->changeDate;
	}

	/**
	 * Sets the changeDate
	 *
	 * @param \DateTime $changeDate
	 * @return void
	 */
	public function setChangeDate(\DateTime $changeDate) {
		$this->changeDate = $changeDate;
	}

	/**
	 * Returns the author
	 *
	 * @return string $author
	 */
	public function getAuthor() {
		return $this->author;
	}

	/**
	 * Sets the author
	 *
	 * @param string $author
	 * @return void
	 */
	public function setAuthor($author) {
		$this->author = $author;
	}

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the feuser
	 *
	 * @return \In2code\Femanager\Domain\Model\User feuser
	 */
	public function getFeuser() {
		return $this->feuser;
	}

	/**
	 * Sets the feuser
	 *
	 * @param \In2code\Femanager\Domain\Model\User $feuser
	 * @return void
	 */
	public function setFeuser(\In2code\Femanager\Domain\Model\User $feuser) {
		$this->feuser = $feuser;
	}

	/**
	 * Returns the owntraining
	 *
	 * @return boolean $owntraining
	 */
	public function getOwntraining() {
		return $this->owntraining;
	}

	/**
	 * Sets the owntraining
	 *
	 * @param boolean $owntraining
	 * @return void
	 */
	public function setOwntraining($owntraining) {
		$this->owntraining = $owntraining;
	}

	/**
	 * Returns the boolean state of owntraining
	 *
	 * @return boolean
	 */
	public function isOwntraining() {
		return $this->owntraining;
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the cancelled
	 *
	 * @return boolean $cancelled
	 */
	public function getCancelled() {
		return $this->cancelled;
	}

	/**
	 * Sets the cancelled
	 *
	 * @param boolean $cancelled
	 * @return void
	 */
	public function setCancelled($cancelled) {
		$this->cancelled = $cancelled;
	}

	/**
	 * Returns the boolean state of cancelled
	 *
	 * @return boolean
	 */
	public function isCancelled() {
		return $this->cancelled;
	}

	/**
	 * Returns the points
	 *
	 * @return int $points
	 */
	public function getPoints() {
		return $this->points;
	}

	/**
	 * Sets the points
	 *
	 * @param int $points
	 * @return void
	 */
	public function setPoints($points) {
		$this->points = $points;
	}

	/**
	 * Returns the compensation
	 *
	 * @return int $compensation
	 */
	public function getCompensation() {
		return $this->compensation;
	}

	/**
	 * Sets the compensation
	 *
	 * @param int $compensation
	 * @return void
	 */
	public function setCompensation($compensation) {
		$this->compensation = $compensation;
	}

	/**
	 * Returns the training
	 *
	 * @return \DW\Trainingsplatz\Domain\Model\Training $training
	 */
	public function getTraining() {
		return $this->training;
	}

	/**
	 * Sets the training
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Training $training
	 * @return void
	 */
	public function setTraining(\DW\Trainingsplatz\Domain\Model\Training $training) {
		$this->training = $training;
	}

	/**
	 * Returns the hash
	 *
	 * @return int $hash
	 */
	public function getHash() {
		return $this->hash;
	}

	/**
	 * Sets the hash
	 *
	 * @param int $hash
	 * @return void
	 */
	public function setHash($hash) {
		$this->hash = $hash;
	}

}