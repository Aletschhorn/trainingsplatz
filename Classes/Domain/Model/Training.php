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
 * Training
 */
class Training extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * author
	 *
	 * @var \In2code\Femanager\Domain\Model\User
	 */
	protected $author;

	/**
	 * leader
	 *
	 * @var \In2code\Femanager\Domain\Model\User
	 */
	protected $leader;

	/**
	 * creationDate
	 *
	 * @var \DateTime
	 */
	protected $creationDate = NULL;

	/**
	 * lastChange
	 *
	 * @var \DateTime
	 */
	protected $lastChange = NULL;

	/**
	 * trainingDate
	 *
	 * @var \DateTime
	 */
	protected $trainingDate = NULL;

	/**
	 * guided
	 *
	 * @var boolean
	 */
	protected $guided = FALSE;

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
	 * startText
	 *
	 * @var string
	 */
	protected $startText = '';

	/**
	 * startOption
	 *
	 * @var integer
	 */
	protected $startOption = 0;

	/**
	 * startCoordinates
	 *
	 * @var string
	 */
	protected $startCoordinates = '';

	/**
	 * duration
	 *
	 * @var string
	 */
	protected $duration = '';

	/**
	 * distance
	 *
	 * @var string
	 */
	protected $distance = '';

	/**
	 * speed
	 *
	 * @var string
	 */
	protected $speed = '';

	/**
	 * route
	 *
	 * @var string
	 */
	protected $route = '';

	/**
	 * picture
	 *
	 * @var string
	 */
	protected $picture = '';

	/**
	 * cancelled
	 *
	 * @var boolean
	 */
	protected $cancelled = FALSE;

	/**
	 * intensity
	 *
	 * @var \DW\Trainingsplatz\Domain\Model\Intensity
	 */
	protected $intensity = NULL;

	/**
	 * sport
	 *
	 * @var \DW\Trainingsplatz\Domain\Model\Sport
	 */
	protected $sport = NULL;

	/**
	 * map
	 *
	 * @var \DW\Trainingsplatz\Domain\Model\Map
	 */
	protected $map = NULL;

	/**
	 * mapCenter
	 *
	 * @var string
	 */
	protected $mapCenter = '';

	/**
	 * mapZoom
	 *
	 * @var integer
	 */
	protected $mapZoom = 0;

	/**
	 * mapType
	 *
	 * @var string
	 */
	protected $mapType = '';

	/**
	 * infomail
	 *
	 * @var boolean
	 */
	protected $infomail = FALSE;

	/**
	 * notification
	 *
	 * @var boolean
	 */
	protected $notification = FALSE;

	/**
	 * public
	 *
	 * @var boolean
	 */
	protected $public = FALSE;

	/**
	 * closed
	 *
	 * @var boolean
	 */
	protected $closed = FALSE;

	/**
	 * series
	 *
	 * @var boolean
	 */
	protected $series = FALSE;

	/**
	 * seriesStart
	 *
	 * @var \DateTime
	 */
	protected $seriesStart = NULL;

	/**
	 * seriesEnd
	 *
	 * @var \DateTime
	 */
	protected $seriesEnd = NULL;

	/**
	 * seriesPeriod
	 *
	 * @var int
	 */
	protected $seriesPeriod = 0;

	/**
	 * seriesNumber
	 *
	 * @var int
	 */
	protected $seriesNumber = 0;

	/**
	 * seriesWeekday
	 *
	 * @var int
	 */
	protected $seriesWeekday = 0;

	/**
	 * step
	 *
	 * @var int
	 */
	protected $step = 0;

	/**
	 * Returns the author
	 *
	 * @return \In2code\Femanager\Domain\Model\User $author
	 */
	public function getAuthor() {
		return $this->author;
	}

	/**
	 * Sets the author
	 *
	 * @param \In2code\Femanager\Domain\Model\User $author
	 * @return void
	 */
	public function setAuthor(\In2code\Femanager\Domain\Model\User $author) {
		$this->author = $author;
	}

	/**
	 * Returns the leader
	 *
	 * @return \In2code\Femanager\Domain\Model\User $leader
	 */
	public function getLeader() {
		return $this->leader;
	}

	/**
	 * Sets the leader
	 *
	 * @param \In2code\Femanager\Domain\Model\User $leader
	 * @return void
	 */
	public function setLeader(\In2code\Femanager\Domain\Model\User $leader) {
		$this->leader = $leader;
	}

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
	 * Returns the lastChange
	 *
	 * @return \DateTime $lastChange
	 */
	public function getLastChange() {
		return $this->lastChange;
	}

	/**
	 * Sets the lastChange
	 *
	 * @param \DateTime $lastChange
	 * @return void
	 */
	public function setLastChange(\DateTime $lastChange) {
		$this->lastChange = $lastChange;
	}

	/**
	 * Returns the trainingDate
	 *
	 * @return \DateTime $trainingDate
	 */
	public function getTrainingDate() {
		return $this->trainingDate;
	}

	/**
	 * Sets the trainingDate
	 *
	 * @param \DateTime $trainingDate
	 * @return void
	 */
	public function setTrainingDate($trainingDate) {
		$this->trainingDate = $trainingDate;
	}

	/**
	 * Returns the guided
	 *
	 * @return boolean $guided
	 */
	public function getGuided() {
		return $this->guided;
	}

	/**
	 * Sets the guided
	 *
	 * @param boolean $guided
	 * @return void
	 */
	public function setGuided($guided) {
		$this->guided = $guided;
	}

	/**
	 * Returns the boolean state of guided
	 *
	 * @return boolean
	 */
	public function isGuided() {
		return $this->guided;
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
	 * Returns the startText
	 *
	 * @return string $startText
	 */
	public function getStartText() {
		return $this->startText;
	}

	/**
	 * Sets the startText
	 *
	 * @param string $startText
	 * @return void
	 */
	public function setStartText($startText) {
		$this->startText = $startText;
	}

	/**
	 * Returns the startOption
	 *
	 * @return integer $startOption
	 */
	public function getStartOption() {
		return $this->startOption;
	}

	/**
	 * Sets the startOption
	 *
	 * @param integer $startOption
	 * @return void
	 */
	public function setStartOption($startOption) {
		$this->startOption = $startOption;
	}

	/**
	 * Returns the startCoordinates
	 *
	 * @return string $startCoordinates
	 */
	public function getStartCoordinates() {
		return $this->startCoordinates;
	}

	/**
	 * Sets the startCoordinates
	 *
	 * @param string $startCoordinates
	 * @return void
	 */
	public function setStartCoordinates($startCoordinates) {
		$this->startCoordinates = $startCoordinates;
	}

	/**
	 * Returns the duration
	 *
	 * @return string $duration
	 */
	public function getDuration() {
		return $this->duration;
	}

	/**
	 * Sets the duration
	 *
	 * @param string $duration
	 * @return void
	 */
	public function setDuration($duration) {
		$this->duration = $duration;
	}

	/**
	 * Returns the distance
	 *
	 * @return string $distance
	 */
	public function getDistance() {
		return $this->distance;
	}

	/**
	 * Sets the distance
	 *
	 * @param float $distance
	 * @return void
	 */
	public function setDistance($distance) {
		$this->distance = $distance;
	}

	/**
	 * Returns the speed
	 *
	 * @return float $speed
	 */
	public function getSpeed() {
		return $this->speed;
	}

	/**
	 * Sets the speed
	 *
	 * @param float $speed
	 * @return void
	 */
	public function setSpeed($speed) {
		$this->speed = $speed;
	}

	/**
	 * Returns the route
	 *
	 * @return string $route
	 */
	public function getRoute() {
		return $this->route;
	}

	/**
	 * Sets the route
	 *
	 * @param string $route
	 * @return void
	 */
	public function setRoute($route) {
		$this->route = $route;
	}

	/**
	 * Returns the picture
	 *
	 * @return string $picture
	 */
	public function getPicture() {
		return $this->picture;
	}

	/**
	 * Sets the picture
	 *
	 * @param string $picture
	 * @return void
	 */
	public function setPicture($picture) {
		$this->picture = $picture;
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
	 * Returns the intensity
	 *
	 * @return \DW\Trainingsplatz\Domain\Model\Intensity $intensity
	 */
	public function getIntensity() {
		return $this->intensity;
	}

	/**
	 * Sets the intensity
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Intensity $intensity
	 * @return void
	 */
	public function setIntensity(\DW\Trainingsplatz\Domain\Model\Intensity $intensity) {
		$this->intensity = $intensity;
	}

	/**
	 * Returns the sport
	 *
	 * @return \DW\Trainingsplatz\Domain\Model\Sport $sport
	 */
	public function getSport() {
		return $this->sport;
	}

	/**
	 * Sets the sport
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Sport $sport
	 * @return void
	 */
	public function setSport(\DW\Trainingsplatz\Domain\Model\Sport $sport) {
		$this->sport = $sport;
	}

	/**
	 * Returns the map
	 *
	 * @return \DW\Trainingsplatz\Domain\Model\Map $map
	 */
	public function getMap() {
		return $this->map;
	}

	/**
	 * Sets the map
	 *
	 * @param \DW\Trainingsplatz\Domain\Model\Map $map
	 * @return void
	 */
	public function setMap($map) {
		$this->map = $map;
	}

	/**
	 * Returns the mapCenter
	 *
	 * @return string $mapCenter
	 */
	public function getMapCenter() {
		return $this->mapCenter;
	}

	/**
	 * Sets the mapCenter
	 *
	 * @param string $mapCenter
	 * @return void
	 */
	public function setMapCenter($mapCenter) {
		$this->mapCenter = $mapCenter;
	}

	/**
	 * Returns the mapZoom
	 *
	 * @return string $mapZoom
	 */
	public function getMapZoom() {
		return $this->mapZoom;
	}

	/**
	 * Sets the mapZoom
	 *
	 * @param string $mapZoom
	 * @return void
	 */
	public function setMapZoom($mapZoom) {
		$this->mapZoom = $mapZoom;
	}

	/**
	 * Returns the mapType
	 *
	 * @return string $mapType
	 */
	public function getMapType() {
		return $this->mapType;
	}

	/**
	 * Sets the mapType
	 *
	 * @param string $mapType
	 * @return void
	 */
	public function setMapType($mapType) {
		$this->mapType = $mapType;
	}

	/**
	 * Returns the infomail
	 *
	 * @return boolean $infomail
	 */
	public function getInfomail() {
		return $this->infomail;
	}

	/**
	 * Sets the infomail
	 *
	 * @param boolean $infomail
	 * @return void
	 */
	public function setInfomail($infomail) {
		$this->infomail = $infomail;
	}

	/**
	 * Returns the boolean state of infomail
	 *
	 * @return boolean
	 */
	public function isInfomail() {
		return $this->infomail;
	}

	/**
	 * Returns the notification
	 *
	 * @return boolean $notification
	 */
	public function getNotification() {
		return $this->notification;
	}

	/**
	 * Sets the notification
	 *
	 * @param boolean $notification
	 * @return void
	 */
	public function setNotification($notification) {
		$this->notification = $notification;
	}

	/**
	 * Returns the boolean state of notification
	 *
	 * @return boolean
	 */
	public function isNotification() {
		return $this->notification;
	}

	/**
	 * Returns the public
	 *
	 * @return boolean $public
	 */
	public function getPublic() {
		return $this->public;
	}

	/**
	 * Sets the public
	 *
	 * @param boolean $public
	 * @return void
	 */
	public function setPublic($public) {
		$this->public = $public;
	}

	/**
	 * Returns the boolean state of public
	 *
	 * @return boolean
	 */
	public function isPublic() {
		return $this->public;
	}

	/**
	 * Returns the closed
	 *
	 * @return boolean $closed
	 */
	public function getClosed() {
		return $this->closed;
	}

	/**
	 * Sets the closed
	 *
	 * @param boolean $closed
	 * @return void
	 */
	public function setClosed($closed) {
		$this->closed = $closed;
	}

	/**
	 * Returns the boolean state of closed
	 *
	 * @return boolean
	 */
	public function isClosed() {
		return $this->closed;
	}

	/**
	 * Returns the series
	 *
	 * @return boolean $series
	 */
	public function getSeries() {
		return $this->series;
	}

	/**
	 * Sets the series
	 *
	 * @param boolean $series
	 * @return void
	 */
	public function setSeries($series) {
		$this->series = $series;
	}

	/**
	 * Returns the boolean state of series
	 *
	 * @return boolean
	 */
	public function isSeries() {
		return $this->series;
	}

	/**
	 * Returns the seriesStart
	 *
	 * @return \DateTime $seriesStart
	 */
	public function getSeriesStart() {
		return $this->seriesStart;
	}

	/**
	 * Sets the seriesStart
	 *
	 * @param \DateTime $seriesStart
	 * @return void
	 */
	public function setSeriesStart($seriesStart) {
		$this->seriesStart = $seriesStart;
	}

	/**
	 * Returns the seriesEnd
	 *
	 * @return \DateTime $seriesEnd
	 */
	public function getSeriesEnd() {
		return $this->seriesEnd;
	}

	/**
	 * Sets the seriesEnd
	 *
	 * @param \DateTime $seriesEnd
	 * @return void
	 */
	public function setSeriesEnd($seriesEnd) {
		$this->seriesEnd = $seriesEnd;
	}

	/**
	 * Returns the seriesPeriod
	 *
	 * @return int $seriesPeriod
	 */
	public function getSeriesPeriod() {
		return $this->seriesPeriod;
	}

	/**
	 * Sets the seriesPeriod
	 *
	 * @param int $seriesPeriod
	 * @return void
	 */
	public function setSeriesPeriod($seriesPeriod) {
		$this->seriesPeriod = $seriesPeriod;
	}

	/**
	 * Returns the seriesNumber
	 *
	 * @return int $seriesNumber
	 */
	public function getSeriesNumber() {
		return $this->seriesNumber;
	}

	/**
	 * Sets the seriesNumber
	 *
	 * @param int $seriesPeriod
	 * @return void
	 */
	public function setSeriesNumber($seriesNumber) {
		$this->seriesNumber = $seriesNumber;
	}

	/**
	 * Returns the seriesWeekday
	 *
	 * @return int $seriesWeekday
	 */
	public function getSeriesWeekday() {
		return $this->seriesWeekday;
	}

	/**
	 * Sets the seriesWeekday
	 *
	 * @param int $seriesWeekday
	 * @return void
	 */
	public function setSeriesWeekday($seriesWeekday) {
		$this->seriesWeekday = $seriesWeekday;
	}

	/**
	 * Returns the step
	 *
	 * @return int $step
	 */
	public function getStep() {
		return $this->step;
	}

	/**
	 * Sets the step
	 *
	 * @param int $step
	 * @return void
	 */
	public function setStep($step) {
		$this->step = $step;
	}


}