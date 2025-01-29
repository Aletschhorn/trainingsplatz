<?php
declare(strict_types=1);

namespace DW\Trainingsplatz\Domain\Model;

class User extends \In2code\Femanager\Domain\Model\User { 

	protected $txTrainingsplatzMembership = 0;

	protected $txTrainingsplatzGuide = 0;

	protected $txTrainingsplatzInfomail = 0;

	protected $txTrainingsplatzNewsletter = 0;

	protected $txTrainingsplatzContest = 0;

	protected $txTrainingsplatzContestExtra = 0;

	protected $txTrainingsplatzSports = 0;

	protected $txTrainingsplatzMotivation = NULL;

	protected $txTrainingsplatzClub1Name = '';

	protected $txTrainingsplatzClub1Website = '';

	protected $txTrainingsplatzClub2Name = '';

	protected $txTrainingsplatzClub2Website = '';

	protected $txTrainingsplatzPrivateGoal = '';

	protected $txTrainingsplatzPrivateHobby = '';

	protected $txTrainingsplatzPrivateMusic = '';

	protected $txTrainingsplatzPrivateFood = '';

	protected $txTrainingsplatzPrivateLike = '';

	protected $txTrainingsplatzPrivateDislike = '';

	protected $txTrainingsplatzPrivateJob = '';

	protected $txTrainingsplatzPrivateLove = '';

	protected $txTrainingsplatzPrivateMeaningsport = '';

	protected $txTrainingsplatzPrivateMotto = '';

	protected $txTrainingsplatzPrivateSparetime = '';

	protected $txTrainingsplatzPrivateDream = '';

	protected $txTrainingsplatzPrivateNotdisclaim = '';

	protected $txTrainingsplatzPrivateBook = '';

	protected $txTrainingsplatzPrivateWeakness = '';

	protected $txTrainingsplatzPrivateStrength = '';

	protected $txTrainingsplatzPrivateAbility = '';

	protected $txTrainingsplatzPrivateDrivecrazy = '';

	protected $txTrainingsplatzPrivateLaugh = '';

	protected $txTrainingsplatzPrivateSpendmoney = '';

	protected $txTrainingsplatzPrivateDescription = '';

	protected $txTrainingsplatzPrivatePain = '';

	protected $txTrainingsplatzPrivateLuxury = '';

	public function getTxTrainingsplatzMembership(): int 
	{
		return $this->txTrainingsplatzMembership;
	}

	public function setTxTrainingsplatzMembership(int $txTrainingsplatzMembership): void 
	{
		$this->txTrainingsplatzMembership = $txTrainingsplatzMembership;
	}

	public function getTxTrainingsplatzGuide(): bool 
	{
		return $this->txTrainingsplatzGuide;
	}

	public function setTxTrainingsplatzGuide(bool $txTrainingsplatzGuide): void 
	{
		$this->txTrainingsplatzGuide = $txTrainingsplatzGuide;
	}

	public function isTxTrainingsplatzGuide(): bool 
	{
		return $this->txTrainingsplatzGuide;
	}

	public function getTxTrainingsplatzInfomail(): bool 
	{
		return $this->txTrainingsplatzInfomail;
	}

	public function setTxTrainingsplatzInfomail(bool $txTrainingsplatzInfomail): void 
	{
		$this->txTrainingsplatzInfomail = $txTrainingsplatzInfomail;
	}

	public function isTxTrainingsplatzInfomail(): bool 
	{
		return $this->txTrainingsplatzInfomail;
	}

	public function getTxTrainingsplatzNewsletter(): bool 
	{
		return $this->txTrainingsplatzNewsletter;
	}

	public function setTxTrainingsplatzNewsletter(bool $txTrainingsplatzNewsletter): void 
	{
		$this->txTrainingsplatzNewsletter = $txTrainingsplatzNewsletter;
	}

	public function isTxTrainingsplatzNewsletter(): bool 
	{
		return $this->txTrainingsplatzNewsletter;
	}

	public function getTxTrainingsplatzContest(): bool 
	{
		return $this->txTrainingsplatzContest;
	}

	public function setTxTrainingsplatzContest(bool $txTrainingsplatzContest): void 
	{
		$this->txTrainingsplatzContest = $txTrainingsplatzContest;
	}

	public function isTxTrainingsplatzContest(): bool 
	{
		return $this->txTrainingsplatzContest;
	}

	public function getTxTrainingsplatzContestExtra(): int 
	{
		return $this->txTrainingsplatzContestExtra;
	}

	public function setTxTrainingsplatzContestExtra(int $txTrainingsplatzContestExtra): void 
	{
		$this->txTrainingsplatzContestExtra = $txTrainingsplatzContestExtra;
	}

	public function getTxTrainingsplatzSports(): int 
	{
		return $this->txTrainingsplatzSports;
	}

	public function setTxTrainingsplatzSports(int $txTrainingsplatzSports): void 
	{
		$this->txTrainingsplatzSports = $txTrainingsplatzSports;
	}

	public function getTxTrainingsplatzMotivation(): \DW\Trainingsplatz\Domain\Model\Motivation 
	{
		return $this->txTrainingsplatzMotivation;
	}

	public function setTxTrainingsplatzMotivation(\DW\Trainingsplatz\Domain\Model\Motivation $txTrainingsplatzMotivation): void 
	{
		$this->txTrainingsplatzMotivation = $txTrainingsplatzMotivation;
	}

	public function getTxTrainingsplatzClub1Name(): string 
	{
		return $this->txTrainingsplatzClub1Name;
	}

	public function setTxTrainingsplatzClub1Name(string $txTrainingsplatzClub1Name): void 
	{
		$this->txTrainingsplatzClub1Name = $txTrainingsplatzClub1Name;
	}

	public function getTxTrainingsplatzClub1Website(): string 
	{
		return $this->txTrainingsplatzClub1Website;
	}

	public function setTxTrainingsplatzClub1Website(string $txTrainingsplatzClub1Website): void 
	{
		$this->txTrainingsplatzClub1Website = $txTrainingsplatzClub1Website;
	}

	public function getTxTrainingsplatzClub2Name(): string 
	{
		return $this->txTrainingsplatzClub2Name;
	}

	public function setTxTrainingsplatzClub2Name(string $txTrainingsplatzClub2Name): void 
	{
		$this->txTrainingsplatzClub2Name = $txTrainingsplatzClub2Name;
	}

	public function getTxTrainingsplatzClub2Website(): string 
	{
		return $this->txTrainingsplatzClub2Website;
	}

	public function setTxTrainingsplatzClub2Website(string $txTrainingsplatzClub2Website): void
	{
		$this->txTrainingsplatzClub2Website = $txTrainingsplatzClub2Website;
	}

	public function getTxTrainingsplatzPrivateGoal(): string 
	{
		return $this->txTrainingsplatzPrivateGoal;
	}

	public function setTxTrainingsplatzPrivateGoal(string $txTrainingsplatzPrivateGoal): void 
	{
		$this->txTrainingsplatzPrivateGoal = $txTrainingsplatzPrivateGoal;
	}

	public function getTxTrainingsplatzPrivateHobby(): string 
	{
		return $this->txTrainingsplatzPrivateHobby;
	}

	public function setTxTrainingsplatzPrivateHobby(string $txTrainingsplatzPrivateHobby): void 
	{
		$this->txTrainingsplatzPrivateHobby = $txTrainingsplatzPrivateHobby;
	}

	public function getTxTrainingsplatzPrivateMusic(): string 
	{
		return $this->txTrainingsplatzPrivateMusic;
	}

	public function setTxTrainingsplatzPrivateMusic(string $txTrainingsplatzPrivateMusic): void 
	{
		$this->txTrainingsplatzPrivateMusic = $txTrainingsplatzPrivateMusic;
	}

	public function getTxTrainingsplatzPrivateFood(): string 
	{
		return $this->txTrainingsplatzPrivateFood;
	}

	public function setTxTrainingsplatzPrivateFood(string $txTrainingsplatzPrivateFood): void 
	{
		$this->txTrainingsplatzPrivateFood = $txTrainingsplatzPrivateFood;
	}

	public function getTxTrainingsplatzPrivateLike(): string 
	{
		return $this->txTrainingsplatzPrivateLike;
	}

	public function setTxTrainingsplatzPrivateLike(string $txTrainingsplatzPrivateLike): void 
	{
		$this->txTrainingsplatzPrivateLike = $txTrainingsplatzPrivateLike;
	}

	public function getTxTrainingsplatzPrivateDislike(): string 
	{
		return $this->txTrainingsplatzPrivateDislike;
	}

	public function setTxTrainingsplatzPrivateDislike(string $txTrainingsplatzPrivateDislike): void 
	{
		$this->txTrainingsplatzPrivateDislike = $txTrainingsplatzPrivateDislike;
	}

	public function getTxTrainingsplatzPrivateJob(): string 
	{
		return $this->txTrainingsplatzPrivateJob;
	}

	public function setTxTrainingsplatzPrivateJob(string $txTrainingsplatzPrivateJob): void 
	{
		$this->txTrainingsplatzPrivateJob = $txTrainingsplatzPrivateJob;
	}

	public function getTxTrainingsplatzPrivateLove(): string 
	{
		return $this->txTrainingsplatzPrivateLove;
	}

	public function setTxTrainingsplatzPrivateLove(string $txTrainingsplatzPrivateLove): void 
	{
		$this->txTrainingsplatzPrivateLove = $txTrainingsplatzPrivateLove;
	}

	public function getTxTrainingsplatzPrivateMeaningsport(): string 
	{
		return $this->txTrainingsplatzPrivateMeaningsport;
	}

	public function setTxTrainingsplatzPrivateMeaningsport(string $txTrainingsplatzPrivateMeaningsport): void 
	{
		$this->txTrainingsplatzPrivateMeaningsport = $txTrainingsplatzPrivateMeaningsport;
	}

	public function getTxTrainingsplatzPrivateMotto(): string 
	{
		return $this->txTrainingsplatzPrivateMotto;
	}

	public function setTxTrainingsplatzPrivateMotto(string $txTrainingsplatzPrivateMotto): void 
	{
		$this->txTrainingsplatzPrivateMotto = $txTrainingsplatzPrivateMotto;
	}

	public function getTxTrainingsplatzPrivateSparetime(): string 
	{
		return $this->txTrainingsplatzPrivateSparetime;
	}

	public function setTxTrainingsplatzPrivateSparetime(string $txTrainingsplatzPrivateSparetime): void 
	{
		$this->txTrainingsplatzPrivateSparetime = $txTrainingsplatzPrivateSparetime;
	}

	public function getTxTrainingsplatzPrivateDream(): string 
	{
		return $this->txTrainingsplatzPrivateDream;
	}

	public function setTxTrainingsplatzPrivateDream(string $txTrainingsplatzPrivateDream): void 
	{
		$this->txTrainingsplatzPrivateDream = $txTrainingsplatzPrivateDream;
	}

	public function getTxTrainingsplatzPrivateNotdisclaim(): string 
	{
		return $this->txTrainingsplatzPrivateNotdisclaim;
	}

	public function setTxTrainingsplatzPrivateNotdisclaim(string $txTrainingsplatzPrivateNotdisclaim): void 
	{
		$this->txTrainingsplatzPrivateNotdisclaim = $txTrainingsplatzPrivateNotdisclaim;
	}

	public function getTxTrainingsplatzPrivateBook(): string 
	{
		return $this->txTrainingsplatzPrivateBook;
	}

	public function setTxTrainingsplatzPrivateBook(string $txTrainingsplatzPrivateBook): void 
	{
		$this->txTrainingsplatzPrivateBook = $txTrainingsplatzPrivateBook;
	}

	public function getTxTrainingsplatzPrivateWeakness(): string 
	{
		return $this->txTrainingsplatzPrivateWeakness;
	}

	public function setTxTrainingsplatzPrivateWeakness(string $txTrainingsplatzPrivateWeakness): void 
	{
		$this->txTrainingsplatzPrivateWeakness = $txTrainingsplatzPrivateWeakness;
	}

	public function getTxTrainingsplatzPrivateStrength(): string 
	{
		return $this->txTrainingsplatzPrivateStrength;
	}

	public function setTxTrainingsplatzPrivateStrength(string $txTrainingsplatzPrivateStrength): void 
	{
		$this->txTrainingsplatzPrivateStrength = $txTrainingsplatzPrivateStrength;
	}

	public function getTxTrainingsplatzPrivateAbility(): string 
	{
		return $this->txTrainingsplatzPrivateAbility;
	}

	public function setTxTrainingsplatzPrivateAbility(string $txTrainingsplatzPrivateAbility): void 
	{
		$this->txTrainingsplatzPrivateAbility = $txTrainingsplatzPrivateAbility;
	}

	public function getTxTrainingsplatzPrivateDrivecrazy(): string 
	{
		return $this->txTrainingsplatzPrivateDrivecrazy;
	}

	public function setTxTrainingsplatzPrivateDrivecrazy(string $txTrainingsplatzPrivateDrivecrazy): void 
	{
		$this->txTrainingsplatzPrivateDrivecrazy = $txTrainingsplatzPrivateDrivecrazy;
	}

	public function getTxTrainingsplatzPrivateLaugh(): string 
	{
		return $this->txTrainingsplatzPrivateLaugh;
	}

	public function setTxTrainingsplatzPrivateLaugh(string $txTrainingsplatzPrivateLaugh): void 
	{
		$this->txTrainingsplatzPrivateLaugh = $txTrainingsplatzPrivateLaugh;
	}

	public function getTxTrainingsplatzPrivateSpendmoney(): string 
	{
		return $this->txTrainingsplatzPrivateSpendmoney;
	}

	public function setTxTrainingsplatzPrivateSpendmoney(string $txTrainingsplatzPrivateSpendmoney): void 
	{
		$this->txTrainingsplatzPrivateSpendmoney = $txTrainingsplatzPrivateSpendmoney;
	}

	public function getTxTrainingsplatzPrivateDescription(): string 
	{
		return $this->txTrainingsplatzPrivateDescription;
	}

	public function setTxTrainingsplatzPrivateDescription(string $txTrainingsplatzPrivateDescription): void 
	{
		$this->txTrainingsplatzPrivateDescription = $txTrainingsplatzPrivateDescription;
	}

	public function getTxTrainingsplatzPrivatePain(): string 
	{
		return $this->txTrainingsplatzPrivatePain;
	}

	public function setTxTrainingsplatzPrivatePain(string $txTrainingsplatzPrivatePain): void 
	{
		$this->txTrainingsplatzPrivatePain = $txTrainingsplatzPrivatePain;
	}

	public function getTxTrainingsplatzPrivateLuxury(): string 
	{
		return $this->txTrainingsplatzPrivateLuxury;
	}

	public function setTxTrainingsplatzPrivateLuxury(string $txTrainingsplatzPrivateLuxury): void 
	{
		$this->txTrainingsplatzPrivateLuxury = $txTrainingsplatzPrivateLuxury;
	}

}