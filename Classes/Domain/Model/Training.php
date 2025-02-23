<?php
declare(strict_types=1);

namespace DW\Trainingsplatz\Domain\Model;

class Training extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	protected $author;

	protected $leader;

	protected $creationDate = NULL;

	protected $lastChange = NULL;

	protected $trainingDate = NULL;

	protected $guided = FALSE;

	protected $title = '';

	protected $description = '';

	protected $startText = '';

	protected $startOption = 0;

	protected $startCoordinates = '';

	protected $duration = '';

	protected $distance = '';

	protected $speed = '';

	protected $route = '';

	protected $picture = '';

	protected $cancelled = FALSE;

	protected $intensity = NULL;

	protected $sport = NULL;

	protected $mapCenter = '';

	protected $mapZoom = 0;

	protected $mapType = '';

	protected $infomail = FALSE;

	protected $notification = FALSE;

	protected $public = FALSE;

	protected $closed = FALSE;

	protected $series = FALSE;

	protected $seriesStart = NULL;

	protected $seriesEnd = NULL;

	protected $seriesPeriod = 0;

	protected $seriesNumber = 0;

	protected $seriesWeekday = 0;

	protected $step = 0;

	public function getAuthor(): null|\In2code\Femanager\Domain\Model\User 
	{
		return $this->author;
	}

	public function setAuthor(\In2code\Femanager\Domain\Model\User $author): void 
	{
		$this->author = $author;
	}

	public function getLeader(): null|\In2code\Femanager\Domain\Model\User 
	{
		return $this->leader;
	}

	public function setLeader(\In2code\Femanager\Domain\Model\User $leader): void 
	{
		$this->leader = $leader;
	}

	public function getCreationDate(): null|\DateTime 
	{
		return $this->creationDate;
	}

	public function setCreationDate(\DateTime $creationDate): void 
	{
		$this->creationDate = $creationDate;
	}

	public function getLastChange(): null|\DateTime 
	{
		return $this->lastChange;
	}

	public function setLastChange(\DateTime $lastChange): void 
	{
		$this->lastChange = $lastChange;
	}

	public function getTrainingDate(): null|\DateTime 
	{
		return $this->trainingDate;
	}

	public function setTrainingDate(null|\DateTime $trainingDate): void 
	{
		$this->trainingDate = $trainingDate;
	}

	public function getGuided(): bool 
	{
		return $this->guided;
	}

	public function setGuided(bool $guided): void 
	{
		$this->guided = $guided;
	}

	public function isGuided(): bool 
	{
		return $this->guided;
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

	public function setDescription(string $description): void 
	{
		$this->description = $description;
	}

	public function getStartText(): string 
	{
		return $this->startText;
	}

	public function setStartText(string $startText): void 
	{
		$this->startText = $startText;
	}

	public function getStartOption(): int 
	{
		return $this->startOption;
	}

	public function setStartOption(int $startOption): void 
	{
		$this->startOption = $startOption;
	}

	public function getStartCoordinates(): string 
	{
		return $this->startCoordinates;
	}

	public function setStartCoordinates(string $startCoordinates): void 
	{
		$this->startCoordinates = $startCoordinates;
	}

	public function getDuration(): string 
	{
		return $this->duration;
	}

	public function setDuration(string $duration): void 
	{
		$this->duration = $duration;
	}

	public function getDistance(): string 
	{
		return $this->distance;
	}

	public function setDistance(string $distance): void 
	{
		$this->distance = $distance;
	}

	public function getSpeed(): string 
	{
		return $this->speed;
	}

	public function setSpeed(string $speed): void 
	{
		$this->speed = $speed;
	}

	public function getRoute(): string 
	{
		return $this->route;
	}

	public function setRoute(string $route): void 
	{
		$this->route = $route;
	}

	public function getPicture(): string 
	{
		return $this->picture;
	}

	public function setPicture(string $picture): void 
	{
		$this->picture = $picture;
	}

	public function getCancelled(): bool {
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

	public function getIntensity(): null|\DW\Trainingsplatz\Domain\Model\Intensity 
	{
		return $this->intensity;
	}

	public function setIntensity(\DW\Trainingsplatz\Domain\Model\Intensity $intensity): void 
	{
		$this->intensity = $intensity;
	}

	public function getSport(): null|\DW\Trainingsplatz\Domain\Model\Sport 
	{
		return $this->sport;
	}

	public function setSport(\DW\Trainingsplatz\Domain\Model\Sport $sport): void 
	{
		$this->sport = $sport;
	}

	public function getMapCenter(): string 
	{
		return $this->mapCenter;
	}

	public function setMapCenter(string $mapCenter): void 
	{
		$this->mapCenter = $mapCenter;
	}

	public function getMapZoom(): string 
	{
		return $this->mapZoom;
	}

	public function setMapZoom(string $mapZoom): void 
	{
		$this->mapZoom = $mapZoom;
	}

	public function getMapType(): string 
	{
		return $this->mapType;
	}

	public function setMapType(string $mapType): void 
	{
		$this->mapType = $mapType;
	}

	public function getInfomail(): bool 
	{
		return $this->infomail;
	}

	public function setInfomail(bool $infomail): void 
	{
		$this->infomail = $infomail;
	}

	public function isInfomail(): bool 
	{
		return $this->infomail;
	}

	public function getNotification(): bool 
	{
		return $this->notification;
	}

	public function setNotification(bool $notification): void 
	{
		$this->notification = $notification;
	}

	public function isNotification(): bool 
	{
		return $this->notification;
	}

	public function getPublic(): bool 
	{
		return $this->public;
	}

	public function setPublic(bool $public): void 
	{
		$this->public = $public;
	}

	public function isPublic(): bool 
	{
		return $this->public;
	}

	public function getClosed(): bool 
	{
		return $this->closed;
	}

	public function setClosed(bool $closed): void 
	{
		$this->closed = $closed;
	}

	public function isClosed(): bool 
	{
		return $this->closed;
	}

	public function getSeries(): bool 
	{
		return $this->series;
	}

	public function setSeries(bool $series): void 
	{
		$this->series = $series;
	}

	public function isSeries(): bool 
	{
		return $this->series;
	}

	public function getSeriesStart(): null|\DateTime 
	{
		return $this->seriesStart;
	}

	public function setSeriesStart(null|\DateTime $seriesStart): void 
	{
		$this->seriesStart = $seriesStart;
	}

	public function getSeriesEnd(): null|\DateTime 
	{
		return $this->seriesEnd;
	}

	public function setSeriesEnd(null|\DateTime $seriesEnd): void 
	{
		$this->seriesEnd = $seriesEnd;
	}

	public function getSeriesPeriod(): int 
	{
		return $this->seriesPeriod;
	}

	public function setSeriesPeriod(int $seriesPeriod): void 
	{
		$this->seriesPeriod = $seriesPeriod;
	}

	public function getSeriesNumber(): int 
	{
		return $this->seriesNumber;
	}

	public function setSeriesNumber(int $seriesNumber): void 
	{
		$this->seriesNumber = $seriesNumber;
	}

	public function getSeriesWeekday(): int 
	{
		return $this->seriesWeekday;
	}

	public function setSeriesWeekday(int $seriesWeekday): void 
	{
		$this->seriesWeekday = $seriesWeekday;
	}

	public function getStep(): int 
	{
		return $this->step;
	}

	public function setStep(int $step): void 
	{
		$this->step = $step;
	}

}