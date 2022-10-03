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
class Infomail extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * training
	 *
	 * @var \DW\Trainingsplatz\Domain\Model\Training
	 */
	protected $training = NULL;

	/**
	 * status
	 *
	 * @var int
	 */
	protected $status = 0;

	/**
	 * statusDate
	 *
	 * @var \DateTime
	 */
	protected $statusDate = NULL;

	/**
	 * mailSubject
	 *
	 * @var string
	 */
	protected $mailSubject = '';

	/**
	 * mailBody
	 *
	 * @var string
	 */
	protected $mailBody = '';

	/**
	 * sendUser
	 *
	 * @var \In2code\Femanager\Domain\Model\User
	 */
	protected $sendUser = '';

	/**
	 * sendReceiver
	 *
	 * @var int
	 */
	protected $sendReceiver = 0;

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
	 * Returns the status
	 *
	 * @return int $status
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Sets the status
	 *
	 * @param int $status
	 * @return void
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * Returns the statusDate
	 *
	 * @return \DateTime $statusDate
	 */
	public function getStatusDate() {
		return $this->statusDate;
	}

	/**
	 * Sets the statusDate
	 *
	 * @param \DateTime $statusDate
	 * @return void
	 */
	public function setStatusDate(\DateTime $statusDate) {
		$this->statusDate = $statusDate;
	}

	/**
	 * Returns the mailSubject
	 *
	 * @return string $mailSubject
	 */
	public function getMailSubject() {
		return $this->mailSubject;
	}

	/**
	 * Sets the mailSubject
	 *
	 * @param string $mailSubject
	 * @return void
	 */
	public function setMailSubject($mailSubject) {
		$this->mailSubject = $mailSubject;
	}

	/**
	 * Returns the mailBody
	 *
	 * @return string $mailBody
	 */
	public function getMailBody() {
		return $this->mailBody;
	}

	/**
	 * Sets the mailBody
	 *
	 * @param string $mailBody
	 * @return void
	 */
	public function setMailBody($mailBody) {
		$this->mailBody = $mailBody;
	}

	/**
	 * Returns the sendUser
	 *
	 * @return \In2code\Femanager\Domain\Model\User $sendUser
	 */
	public function getSendUser() {
		return $this->sendUser;
	}

	/**
	 * Sets the sendUser
	 *
	 * @param \In2code\Femanager\Domain\Model\User $sendUser
	 * @return void
	 */
	public function setSendUser(\In2code\Femanager\Domain\Model\User $sendUser) {
		$this->sendUser = $sendUser;
	}

	/**
	 * Returns the sendReceiver
	 *
	 * @return int $sendReceiver
	 */
	public function getSendReceiver() {
		return $this->sendReceiver;
	}

	/**
	 * Sets the sendReceiver
	 *
	 * @param int $sendReceiver
	 * @return void
	 */
	public function setSendReceiver($sendReceiver) {
		$this->sendReceiver = $sendReceiver;
	}

}