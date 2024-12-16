<?php
declare(strict_types=1);
namespace DW\Trainingsplatz\Domain\Model;

class User extends \In2code\Femanager\Domain\Model\User { 

	/**
	 * txTrainingsplatzMembership
	 *
	 * @var integer
	 */
	protected $txTrainingsplatzMembership = 0;

	/**
	 * txTrainingsplatzGuide
	 *
	 * @var boolean
	 */
	protected $txTrainingsplatzGuide = 0;

	/**
	 * txTrainingsplatzInfomail
	 *
	 * @var boolean
	 */
	protected $txTrainingsplatzInfomail = 0;

	/**
	 * txTrainingsplatzNewsletter
	 *
	 * @var boolean
	 */
	protected $txTrainingsplatzNewsletter = 0;

	/**
	 * txTrainingsplatzContest
	 *
	 * @var boolean
	 */
	protected $txTrainingsplatzContest = 0;

	/**
	 * txTrainingsplatzContestExtra
	 *
	 * @var integer
	 */
	protected $txTrainingsplatzContestExtra = 0;

	/**
	 * txTrainingsplatzSports
	 *
	 * @var integer
	 */
	protected $txTrainingsplatzSports = 0;

	/**
	 * txTrainingsplatzMotivation
	 *
	 * @var \DW\Trainingsplatz\Domain\Model\Motivation
	 */
	protected $txTrainingsplatzMotivation = NULL;

	/**
	 * txTrainingsplatzClub1Name
	 *
	 * @var string
	 */
	protected $txTrainingsplatzClub1Name = '';

	/**
	 * txTrainingsplatzClub1Website
	 *
	 * @var string
	 */
	protected $txTrainingsplatzClub1Website = '';

	/**
	 * txTrainingsplatzClub2Name
	 *
	 * @var string
	 */
	protected $txTrainingsplatzClub2Name = '';

	/**
	 * txTrainingsplatzClub2Website
	 *
	 * @var string
	 */
	protected $txTrainingsplatzClub2Website = '';

	/**
	 * txTrainingsplatzPrivateGoal
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateGoal = '';

	/**
	 * txTrainingsplatzPrivateHobby
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateHobby = '';

	/**
	 * txTrainingsplatzPrivateMusic
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateMusic = '';

	/**
	 * txTrainingsplatzPrivateFood
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateFood = '';

	/**
	 * txTrainingsplatzPrivateLike
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateLike = '';

	/**
	 * txTrainingsplatzPrivateDislike
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateDislike = '';

	/**
	 * txTrainingsplatzPrivateJob
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateJob = '';

	/**
	 * txTrainingsplatzPrivateLove
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateLove = '';

	/**
	 * txTrainingsplatzPrivateMeaningsport
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateMeaningsport = '';

	/**
	 * txTrainingsplatzPrivateMotto
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateMotto = '';

	/**
	 * txTrainingsplatzPrivateSparetime
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateSparetime = '';

	/**
	 * txTrainingsplatzPrivateDream
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateDream = '';

	/**
	 * txTrainingsplatzPrivateNotdisclaim
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateNotdisclaim = '';

	/**
	 * txTrainingsplatzPrivateBook
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateBook = '';

	/**
	 * txTrainingsplatzPrivateWeakness
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateWeakness = '';

	/**
	 * txTrainingsplatzPrivateStrength
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateStrength = '';

	/**
	 * txTrainingsplatzPrivateAbility
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateAbility = '';

	/**
	 * txTrainingsplatzPrivateDrivecrazy
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateDrivecrazy = '';

	/**
	 * txTrainingsplatzPrivateLaugh
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateLaugh = '';

	/**
	 * txTrainingsplatzPrivateSpendmoney
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateSpendmoney = '';

	/**
	 * txTrainingsplatzPrivateDescription
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateDescription = '';

	/**
	 * txTrainingsplatzPrivatePain
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivatePain = '';

	/**
	 * txTrainingsplatzPrivateLuxury
	 *
	 * @var string
	 */
	protected $txTrainingsplatzPrivateLuxury = '';

	/**
	 * Returns the txTrainingsplatzMembership
	 *
	 * @return integer $txTrainingsplatzMembership
	 */
	public function getTxTrainingsplatzMembership() {
		return $this->txTrainingsplatzMembership;
	}

	/**
	 * Sets the txTrainingsplatzMembership
	 *
	 * @param integer $txTrainingsplatzMembership
	 * @return void
	 */
	public function setTxTrainingsplatzMembership($txTrainingsplatzMembership) {
		$this->txTrainingsplatzMembership = $txTrainingsplatzMembership;
	}

	/**
	 * Returns the txTrainingsplatzGuide
	 *
	 * @return boolean $txTrainingsplatzGuide
	 */
	public function getTxTrainingsplatzGuide() {
		return $this->txTrainingsplatzGuide;
	}

	/**
	 * Sets the txTrainingsplatzGuide
	 *
	 * @param boolean $txTrainingsplatzGuide
	 * @return void
	 */
	public function setTxTrainingsplatzGuide($txTrainingsplatzGuide) {
		$this->txTrainingsplatzGuide = $txTrainingsplatzGuide;
	}

	/**
	 * Returns the boolean state of txTrainingsplatzGuide
	 *
	 * @return boolean
	 */
	public function isTxTrainingsplatzGuide() {
		return $this->txTrainingsplatzGuide;
	}

	/**
	 * Returns the txTrainingsplatzInfomail
	 *
	 * @return boolean $txTrainingsplatzInfomail
	 */
	public function getTxTrainingsplatzInfomail() {
		return $this->txTrainingsplatzInfomail;
	}

	/**
	 * Sets the txTrainingsplatzInfomail
	 *
	 * @param boolean $txTrainingsplatzInfomail
	 * @return void
	 */
	public function setTxTrainingsplatzInfomail($txTrainingsplatzInfomail) {
		$this->txTrainingsplatzInfomail = $txTrainingsplatzInfomail;
	}

	/**
	 * Returns the boolean state of txTrainingsplatzInfomail
	 *
	 * @return boolean
	 */
	public function isTxTrainingsplatzInfomail() {
		return $this->txTrainingsplatzInfomail;
	}

	/**
	 * Returns the txTrainingsplatzNewsletter
	 *
	 * @return boolean $txTrainingsplatzNewsletter
	 */
	public function getTxTrainingsplatzNewsletter() {
		return $this->txTrainingsplatzNewsletter;
	}

	/**
	 * Sets the txTrainingsplatzNewsletter
	 *
	 * @param boolean $txTrainingsplatzNewsletter
	 * @return void
	 */
	public function setTxTrainingsplatzNewsletter($txTrainingsplatzNewsletter) {
		$this->txTrainingsplatzNewsletter = $txTrainingsplatzNewsletter;
	}

	/**
	 * Returns the boolean state of txTrainingsplatzNewsletter
	 *
	 * @return boolean
	 */
	public function isTxTrainingsplatzNewsletter() {
		return $this->txTrainingsplatzNewsletter;
	}

	/**
	 * Returns the txTrainingsplatzContest
	 *
	 * @return boolean $txTrainingsplatzContest
	 */
	public function getTxTrainingsplatzContest() {
		return $this->txTrainingsplatzContest;
	}

	/**
	 * Sets the txTrainingsplatzContest
	 *
	 * @param boolean $txTrainingsplatzContest
	 * @return void
	 */
	public function setTxTrainingsplatzContest($txTrainingsplatzContest) {
		$this->txTrainingsplatzContest = $txTrainingsplatzContest;
	}

	/**
	 * Returns the boolean state of txTrainingsplatzContest
	 *
	 * @return boolean
	 */
	public function isTxTrainingsplatzContest() {
		return $this->txTrainingsplatzContest;
	}

	/**
	 * Returns the txTrainingsplatzContestExtra
	 *
	 * @return integer $txTrainingsplatzContestExtra
	 */
	public function getTxTrainingsplatzContestExtra() {
		return $this->txTrainingsplatzContestExtra;
	}

	/**
	 * Sets the txTrainingsplatzContestExtra
	 *
	 * @param integer $txTrainingsplatzContestExtra
	 * @return void
	 */
	public function setTxTrainingsplatzContestExtra($txTrainingsplatzContestExtra) {
		$this->txTrainingsplatzContestExtra = $txTrainingsplatzContestExtra;
	}

	/**
	 * Returns the txTrainingsplatzSports
	 *
	 * @return integer $txTrainingsplatzSports
	 */
	public function getTxTrainingsplatzSports() {
		return $this->txTrainingsplatzSports;
	}

	/**
	 * Sets the txTrainingsplatzSports
	 *
	 * @param integer $txTrainingsplatzSports
	 * @return void
	 */
	public function setTxTrainingsplatzSports($txTrainingsplatzSports) {
		$this->txTrainingsplatzSports = $txTrainingsplatzSports;
	}

	/**
	 * Returns the txTrainingsplatzMotivation
	 *
	 * @return \DW\Trainingsplatz\Domain\Model\Motivation $txTrainingsplatzMotivation
	 */
	public function getTxTrainingsplatzMotivation() {
		return $this->txTrainingsplatzMotivation;
	}

	/**
	 * Sets the txTrainingsplatzMotivation
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Motivation $txTrainingsplatzMotivation
	 * @return void
	 */
	public function setTxTrainingsplatzMotivation(\DW\Trainingsplatz\Domain\Model\Motivation $txTrainingsplatzMotivation) {
		$this->txTrainingsplatzMotivation = $txTrainingsplatzMotivation;
	}

	/**
	 * Returns the txTrainingsplatzClub1Name
	 *
	 * @return string $txTrainingsplatzClub1Name
	 */
	public function getTxTrainingsplatzClub1Name() {
		return $this->txTrainingsplatzClub1Name;
	}

	/**
	 * Sets the txTrainingsplatzClub1Name
	 *
	 * @param string $txTrainingsplatzClub1Name
	 * @return void
	 */
	public function setTxTrainingsplatzClub1Name($txTrainingsplatzClub1Name) {
		$this->txTrainingsplatzClub1Name = $txTrainingsplatzClub1Name;
	}

	/**
	 * Returns the txTrainingsplatzClub1Website
	 *
	 * @return string $txTrainingsplatzClub1Website
	 */
	public function getTxTrainingsplatzClub1Website() {
		return $this->txTrainingsplatzClub1Website;
	}

	/**
	 * Sets the txTrainingsplatzClub1Website
	 *
	 * @param string $txTrainingsplatzClub1Website
	 * @return void
	 */
	public function setTxTrainingsplatzClub1Website($txTrainingsplatzClub1Website) {
		$this->txTrainingsplatzClub1Website = $txTrainingsplatzClub1Website;
	}

	/**
	 * Returns the txTrainingsplatzClub2Name
	 *
	 * @return string $txTrainingsplatzClub2Name
	 */
	public function getTxTrainingsplatzClub2Name() {
		return $this->txTrainingsplatzClub2Name;
	}

	/**
	 * Sets the txTrainingsplatzClub2Name
	 *
	 * @param string $txTrainingsplatzClub2Name
	 * @return void
	 */
	public function setTxTrainingsplatzClub2Name($txTrainingsplatzClub2Name) {
		$this->txTrainingsplatzClub2Name = $txTrainingsplatzClub2Name;
	}

	/**
	 * Returns the txTrainingsplatzClub2Website
	 *
	 * @return string $txTrainingsplatzClub2Website
	 */
	public function getTxTrainingsplatzClub2Website() {
		return $this->txTrainingsplatzClub2Website;
	}

	/**
	 * Sets the txTrainingsplatzClub2Website
	 *
	 * @param string $txTrainingsplatzClub2Website
	 * @return void
	 */
	public function setTxTrainingsplatzClub2Website($txTrainingsplatzClub2Website) {
		$this->txTrainingsplatzClub2Website = $txTrainingsplatzClub2Website;
	}

	/**
	 * Returns the txTrainingsplatzPrivateGoal
	 *
	 * @return string $txTrainingsplatzPrivateGoal
	 */
	public function getTxTrainingsplatzPrivateGoal() {
		return $this->txTrainingsplatzPrivateGoal;
	}

	/**
	 * Sets the txTrainingsplatzPrivateGoal
	 *
	 * @param string $txTrainingsplatzPrivateGoal
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateGoal($txTrainingsplatzPrivateGoal) {
		$this->txTrainingsplatzPrivateGoal = $txTrainingsplatzPrivateGoal;
	}

	/**
	 * Returns the txTrainingsplatzPrivateHobby
	 *
	 * @return string $txTrainingsplatzPrivateHobby
	 */
	public function getTxTrainingsplatzPrivateHobby() {
		return $this->txTrainingsplatzPrivateHobby;
	}

	/**
	 * Sets the txTrainingsplatzPrivateHobby
	 *
	 * @param string $txTrainingsplatzPrivateHobby
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateHobby($txTrainingsplatzPrivateHobby) {
		$this->txTrainingsplatzPrivateHobby = $txTrainingsplatzPrivateHobby;
	}

	/**
	 * Returns the txTrainingsplatzPrivateMusic
	 *
	 * @return string $txTrainingsplatzPrivateMusic
	 */
	public function getTxTrainingsplatzPrivateMusic() {
		return $this->txTrainingsplatzPrivateMusic;
	}

	/**
	 * Sets the txTrainingsplatzPrivateMusic
	 *
	 * @param string $txTrainingsplatzPrivateMusic
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateMusic($txTrainingsplatzPrivateMusic) {
		$this->txTrainingsplatzPrivateMusic = $txTrainingsplatzPrivateMusic;
	}

	/**
	 * Returns the txTrainingsplatzPrivateFood
	 *
	 * @return string $txTrainingsplatzPrivateFood
	 */
	public function getTxTrainingsplatzPrivateFood() {
		return $this->txTrainingsplatzPrivateFood;
	}

	/**
	 * Sets the txTrainingsplatzPrivateFood
	 *
	 * @param string $txTrainingsplatzPrivateFood
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateFood($txTrainingsplatzPrivateFood) {
		$this->txTrainingsplatzPrivateFood = $txTrainingsplatzPrivateFood;
	}

	/**
	 * Returns the txTrainingsplatzPrivateLike
	 *
	 * @return string $txTrainingsplatzPrivateLike
	 */
	public function getTxTrainingsplatzPrivateLike() {
		return $this->txTrainingsplatzPrivateLike;
	}

	/**
	 * Sets the txTrainingsplatzPrivateLike
	 *
	 * @param string $txTrainingsplatzPrivateLike
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateLike($txTrainingsplatzPrivateLike) {
		$this->txTrainingsplatzPrivateLike = $txTrainingsplatzPrivateLike;
	}

	/**
	 * Returns the txTrainingsplatzPrivateDislike
	 *
	 * @return string $txTrainingsplatzPrivateDislike
	 */
	public function getTxTrainingsplatzPrivateDislike() {
		return $this->txTrainingsplatzPrivateDislike;
	}

	/**
	 * Sets the txTrainingsplatzPrivateDislike
	 *
	 * @param string $txTrainingsplatzPrivateDislike
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateDislike($txTrainingsplatzPrivateDislike) {
		$this->txTrainingsplatzPrivateDislike = $txTrainingsplatzPrivateDislike;
	}

	/**
	 * Returns the txTrainingsplatzPrivateJob
	 *
	 * @return string $txTrainingsplatzPrivateJob
	 */
	public function getTxTrainingsplatzPrivateJob() {
		return $this->txTrainingsplatzPrivateJob;
	}

	/**
	 * Sets the txTrainingsplatzPrivateJob
	 *
	 * @param string $txTrainingsplatzPrivateJob
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateJob($txTrainingsplatzPrivateJob) {
		$this->txTrainingsplatzPrivateJob = $txTrainingsplatzPrivateJob;
	}

	/**
	 * Returns the txTrainingsplatzPrivateLove
	 *
	 * @return string $txTrainingsplatzPrivateLove
	 */
	public function getTxTrainingsplatzPrivateLove() {
		return $this->txTrainingsplatzPrivateLove;
	}

	/**
	 * Sets the txTrainingsplatzPrivateLove
	 *
	 * @param string $txTrainingsplatzPrivateLove
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateLove($txTrainingsplatzPrivateLove) {
		$this->txTrainingsplatzPrivateLove = $txTrainingsplatzPrivateLove;
	}

	/**
	 * Returns the txTrainingsplatzPrivateMeaningsport
	 *
	 * @return string $txTrainingsplatzPrivateMeaningsport
	 */
	public function getTxTrainingsplatzPrivateMeaningsport() {
		return $this->txTrainingsplatzPrivateMeaningsport;
	}

	/**
	 * Sets the txTrainingsplatzPrivateMeaningsport
	 *
	 * @param string $txTrainingsplatzPrivateMeaningsport
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateMeaningsport($txTrainingsplatzPrivateMeaningsport) {
		$this->txTrainingsplatzPrivateMeaningsport = $txTrainingsplatzPrivateMeaningsport;
	}

	/**
	 * Returns the txTrainingsplatzPrivateMotto
	 *
	 * @return string $txTrainingsplatzPrivateMotto
	 */
	public function getTxTrainingsplatzPrivateMotto() {
		return $this->txTrainingsplatzPrivateMotto;
	}

	/**
	 * Sets the txTrainingsplatzPrivateMotto
	 *
	 * @param string $txTrainingsplatzPrivateMotto
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateMotto($txTrainingsplatzPrivateMotto) {
		$this->txTrainingsplatzPrivateMotto = $txTrainingsplatzPrivateMotto;
	}

	/**
	 * Returns the txTrainingsplatzPrivateSparetime
	 *
	 * @return string $txTrainingsplatzPrivateSparetime
	 */
	public function getTxTrainingsplatzPrivateSparetime() {
		return $this->txTrainingsplatzPrivateSparetime;
	}

	/**
	 * Sets the txTrainingsplatzPrivateSparetime
	 *
	 * @param string $txTrainingsplatzPrivateSparetime
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateSparetime($txTrainingsplatzPrivateSparetime) {
		$this->txTrainingsplatzPrivateSparetime = $txTrainingsplatzPrivateSparetime;
	}

	/**
	 * Returns the txTrainingsplatzPrivateDream
	 *
	 * @return string $txTrainingsplatzPrivateDream
	 */
	public function getTxTrainingsplatzPrivateDream() {
		return $this->txTrainingsplatzPrivateDream;
	}

	/**
	 * Sets the txTrainingsplatzPrivateDream
	 *
	 * @param string $txTrainingsplatzPrivateDream
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateDream($txTrainingsplatzPrivateDream) {
		$this->txTrainingsplatzPrivateDream = $txTrainingsplatzPrivateDream;
	}

	/**
	 * Returns the txTrainingsplatzPrivateNotdisclaim
	 *
	 * @return string $txTrainingsplatzPrivateNotdisclaim
	 */
	public function getTxTrainingsplatzPrivateNotdisclaim() {
		return $this->txTrainingsplatzPrivateNotdisclaim;
	}

	/**
	 * Sets the txTrainingsplatzPrivateNotdisclaim
	 *
	 * @param string $txTrainingsplatzPrivateNotdisclaim
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateNotdisclaim($txTrainingsplatzPrivateNotdisclaim) {
		$this->txTrainingsplatzPrivateNotdisclaim = $txTrainingsplatzPrivateNotdisclaim;
	}

	/**
	 * Returns the txTrainingsplatzPrivateBook
	 *
	 * @return string $txTrainingsplatzPrivateBook
	 */
	public function getTxTrainingsplatzPrivateBook() {
		return $this->txTrainingsplatzPrivateBook;
	}

	/**
	 * Sets the txTrainingsplatzPrivateBook
	 *
	 * @param string $txTrainingsplatzPrivateBook
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateBook($txTrainingsplatzPrivateBook) {
		$this->txTrainingsplatzPrivateBook = $txTrainingsplatzPrivateBook;
	}

	/**
	 * Returns the txTrainingsplatzPrivateWeakness
	 *
	 * @return string $txTrainingsplatzPrivateWeakness
	 */
	public function getTxTrainingsplatzPrivateWeakness() {
		return $this->txTrainingsplatzPrivateWeakness;
	}

	/**
	 * Sets the txTrainingsplatzPrivateWeakness
	 *
	 * @param string $txTrainingsplatzPrivateWeakness
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateWeakness($txTrainingsplatzPrivateWeakness) {
		$this->txTrainingsplatzPrivateWeakness = $txTrainingsplatzPrivateWeakness;
	}

	/**
	 * Returns the txTrainingsplatzPrivateStrength
	 *
	 * @return string $txTrainingsplatzPrivateStrength
	 */
	public function getTxTrainingsplatzPrivateStrength() {
		return $this->txTrainingsplatzPrivateStrength;
	}

	/**
	 * Sets the txTrainingsplatzPrivateStrength
	 *
	 * @param string $txTrainingsplatzPrivateStrength
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateStrength($txTrainingsplatzPrivateStrength) {
		$this->txTrainingsplatzPrivateStrength = $txTrainingsplatzPrivateStrength;
	}

	/**
	 * Returns the txTrainingsplatzPrivateAbility
	 *
	 * @return string $txTrainingsplatzPrivateAbility
	 */
	public function getTxTrainingsplatzPrivateAbility() {
		return $this->txTrainingsplatzPrivateAbility;
	}

	/**
	 * Sets the txTrainingsplatzPrivateAbility
	 *
	 * @param string $txTrainingsplatzPrivateAbility
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateAbility($txTrainingsplatzPrivateAbility) {
		$this->txTrainingsplatzPrivateAbility = $txTrainingsplatzPrivateAbility;
	}

	/**
	 * Returns the txTrainingsplatzPrivateDrivecrazy
	 *
	 * @return string $txTrainingsplatzPrivateDrivecrazy
	 */
	public function getTxTrainingsplatzPrivateDrivecrazy() {
		return $this->txTrainingsplatzPrivateDrivecrazy;
	}

	/**
	 * Sets the txTrainingsplatzPrivateDrivecrazy
	 *
	 * @param string $txTrainingsplatzPrivateDrivecrazy
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateDrivecrazy($txTrainingsplatzPrivateDrivecrazy) {
		$this->txTrainingsplatzPrivateDrivecrazy = $txTrainingsplatzPrivateDrivecrazy;
	}

	/**
	 * Returns the txTrainingsplatzPrivateLaugh
	 *
	 * @return string $txTrainingsplatzPrivateLaugh
	 */
	public function getTxTrainingsplatzPrivateLaugh() {
		return $this->txTrainingsplatzPrivateLaugh;
	}

	/**
	 * Sets the txTrainingsplatzPrivateLaugh
	 *
	 * @param string $txTrainingsplatzPrivateLaugh
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateLaugh($txTrainingsplatzPrivateLaugh) {
		$this->txTrainingsplatzPrivateLaugh = $txTrainingsplatzPrivateLaugh;
	}

	/**
	 * Returns the txTrainingsplatzPrivateSpendmoney
	 *
	 * @return string $txTrainingsplatzPrivateSpendmoney
	 */
	public function getTxTrainingsplatzPrivateSpendmoney() {
		return $this->txTrainingsplatzPrivateSpendmoney;
	}

	/**
	 * Sets the txTrainingsplatzPrivateSpendmoney
	 *
	 * @param string $txTrainingsplatzPrivateSpendmoney
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateSpendmoney($txTrainingsplatzPrivateSpendmoney) {
		$this->txTrainingsplatzPrivateSpendmoney = $txTrainingsplatzPrivateSpendmoney;
	}

	/**
	 * Returns the txTrainingsplatzPrivateDescription
	 *
	 * @return string $txTrainingsplatzPrivateDescription
	 */
	public function getTxTrainingsplatzPrivateDescription() {
		return $this->txTrainingsplatzPrivateDescription;
	}

	/**
	 * Sets the txTrainingsplatzPrivateDescription
	 *
	 * @param string $txTrainingsplatzPrivateDescription
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateDescription($txTrainingsplatzPrivateDescription) {
		$this->txTrainingsplatzPrivateDescription = $txTrainingsplatzPrivateDescription;
	}

	/**
	 * Returns the txTrainingsplatzPrivatePain
	 *
	 * @return string $txTrainingsplatzPrivatePain
	 */
	public function getTxTrainingsplatzPrivatePain() {
		return $this->txTrainingsplatzPrivatePain;
	}

	/**
	 * Sets the txTrainingsplatzPrivatePain
	 *
	 * @param string $txTrainingsplatzPrivatePain
	 * @return void
	 */
	public function setTxTrainingsplatzPrivatePain($txTrainingsplatzPrivatePain) {
		$this->txTrainingsplatzPrivatePain = $txTrainingsplatzPrivatePain;
	}

	/**
	 * Returns the txTrainingsplatzPrivateLuxury
	 *
	 * @return string $txTrainingsplatzPrivateLuxury
	 */
	public function getTxTrainingsplatzPrivateLuxury() {
		return $this->txTrainingsplatzPrivateLuxury;
	}

	/**
	 * Sets the txTrainingsplatzPrivateLuxury
	 *
	 * @param string $txTrainingsplatzPrivateLuxury
	 * @return void
	 */
	public function setTxTrainingsplatzPrivateLuxury($txTrainingsplatzPrivateLuxury) {
		$this->txTrainingsplatzPrivateLuxury = $txTrainingsplatzPrivateLuxury;
	}

}