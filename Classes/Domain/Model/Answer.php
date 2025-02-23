<?php
declare(strict_types=1);

namespace DW\Trainingsplatz\Domain\Model;

class Answer extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	protected $creationDate = NULL;

	protected $changeDate = NULL;

	protected $author = '';

	protected $email = '';

	protected $feuser = NULL;

	protected $owntraining = FALSE;

	protected $title = '';

	protected $description = '';

	protected $cancelled = FALSE;

	protected $points = 0;

	protected $compensation = 0;

	protected $training = NULL;

	protected $hash = '';

	public function getCreationDate(): null|\DateTime 
	{
		return $this->creationDate;
	}

	public function setCreationDate(\DateTime $creationDate): void 
	{
		$this->creationDate = $creationDate;
	}

	public function getChangeDate(): null|\DateTime 
	{
		return $this->changeDate;
	}

	public function setChangeDate(\DateTime $changeDate): void 
	{
		$this->changeDate = $changeDate;
	}

	public function getAuthor(): string 
	{
		return $this->author;
	}

	public function setAuthor($author): void 
	{
		$this->author = $author;
	}

	public function getEmail(): string 
	{
		return $this->email;
	}

	public function setEmail($email): void 
	{
		$this->email = $email;
	}

	public function getFeuser(): null|\In2code\Femanager\Domain\Model\User 
	{
		return $this->feuser;
	}

	public function setFeuser(\In2code\Femanager\Domain\Model\User $feuser): void 
	{
		$this->feuser = $feuser;
	}

	public function getOwntraining(): bool 
	{
		return $this->owntraining;
	}

	public function setOwntraining(bool $owntraining): void 
	{
		$this->owntraining = $owntraining;
	}

	public function isOwntraining(): bool 
	{
		return $this->owntraining;
	}

	public function getTitle(): string 
	{
		return $this->title;
	}

	public function setTitle(string $title): void 
	{
		$this->title = $title;
	}

	public function getDescription(): string 
	{
		return $this->description;
	}

	public function setDescription(string $description): void {
		$this->description = $description;
	}

	public function getCancelled(): bool 
	{
		return $this->cancelled;
	}

	public function setCancelled(bool $cancelled): void 
	{
		$this->cancelled = $cancelled;
	}

	public function isCancelled(): bool 
	{
		return $this->cancelled;
	}

	public function getPoints(): int 
	{
		return $this->points;
	}

	public function setPoints(int $points): void 
	{
		$this->points = $points;
	}

	public function getCompensation(): int 
	{
		return $this->compensation;
	}

	public function setCompensation(int $compensation): void 
	{
		$this->compensation = $compensation;
	}

	public function getTraining(): \DW\Trainingsplatz\Domain\Model\Training 
	{
		return $this->training;
	}

	public function setTraining(\DW\Trainingsplatz\Domain\Model\Training $training): void 
	{
		$this->training = $training;
	}

	public function getHash(): string 
	{
		return strval($this->hash);
	}

	public function setHash(string $hash): void 
	{
		$this->hash = $hash;
	}

}