<?php
declare(strict_types=1);

namespace DW\Trainingsplatz\Domain\Model;

class Infomail extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	protected $training = NULL;

	protected $status = 0;

	protected $statusDate = NULL;

	protected $mailSubject = '';

	protected $mailBody = '';

	protected $sendUser = NULL;

	protected $sendReceiver = 0;

	public function getTraining(): \DW\Trainingsplatz\Domain\Model\Training 
	{
		return $this->training;
	}

	public function setTraining(\DW\Trainingsplatz\Domain\Model\Training $training): void 
	{
		$this->training = $training;
	}

	public function getStatus(): int 
	{
		return $this->status;
	}

	public function setStatus(int $status): void 
	{
		$this->status = $status;
	}

	public function getStatusDate(): null|\DateTime 
	{
		return $this->statusDate;
	}

	public function setStatusDate(\DateTime $statusDate): void 
	{
		$this->statusDate = $statusDate;
	}

	public function getMailSubject(): string 
	{
		return $this->mailSubject;
	}

	public function setMailSubject(string $mailSubject): void 
	{
		$this->mailSubject = $mailSubject;
	}

	public function getMailBody(): string 
	{
		return $this->mailBody;
	}

	public function setMailBody(string $mailBody): void 
	{
		$this->mailBody = $mailBody;
	}

	public function getSendUser(): null|\In2code\Femanager\Domain\Model\User
	{
		return $this->sendUser;
	}

	public function setSendUser(\In2code\Femanager\Domain\Model\User $sendUser): void 
	{
		$this->sendUser = $sendUser;
	}

	public function getSendReceiver(): int 
	{
		return $this->sendReceiver;
	}

	public function setSendReceiver(int $sendReceiver): void 
	{
		$this->sendReceiver = $sendReceiver;
	}

}