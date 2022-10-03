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
 * Map
 */
class Map extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

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
	 * route
	 *
	 * @var string
	 */
	protected $route = '';

	/**
	 * author
	 *
	 * @var string
	 */
	protected $author = '';

	/**
	 * center
	 *
	 * @var string
	 */
	protected $center = '';

	/**
	 * zoom
	 *
	 * @var integer
	 */
	protected $zoom = 0;

	/**
	 * maptype
	 *
	 * @var string
	 */
	protected $maptype = '';

	/**
	 * length
	 *
	 * @var integer
	 */
	protected $length = 0;

	/**
	 * milestones
	 *
	 * @var boolean
	 */
	protected $milestones = false;

	/**
	 * public
	 *
	 * @var integer
	 */
	protected $public = false;

	/**
	 * lastChange
	 *
	 * @var \DateTime
	 */
	protected $lastChange = NULL;

	/**
	 * sport
	 *
	 * @var \DW\Trainingsplatz\Domain\Model\Sport
	 */
	protected $sport = NULL;

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
	 * Returns the maptype
	 *
	 * @return string $maptype
	 */
	public function getMaptype() {
		return $this->maptype;
	}

	/**
	 * Sets the maptype
	 *
	 * @param string $maptype
	 * @return void
	 */
	public function setMaptype($maptype) {
		$this->maptype = $maptype;
	}

	/**
	 * Returns the center
	 *
	 * @return string $center
	 */
	public function getCenter() {
		return $this->center;
	}

	/**
	 * Sets the center
	 *
	 * @param string $center
	 * @return void
	 */
	public function setCenter($center) {
		$this->center = $center;
	}

	/**
	 * Returns the zoom
	 *
	 * @return integer $zoom
	 */
	public function getZoom() {
		return $this->zoom;
	}

	/**
	 * Sets the zoom
	 *
	 * @param integer $zoom
	 * @return void
	 */
	public function setZoom($zoom) {
		$this->zoom = $zoom;
	}

	/**
	 * Returns the length
	 *
	 * @return integer $length
	 */
	public function getLength() {
		return $this->length;
	}

	/**
	 * Sets the zoom
	 *
	 * @param integer $length
	 * @return void
	 */
	public function setLength($length) {
		$this->length = $length;
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
	 * Returns the milestones
	 *
	 * @return boolean $milestones
	 */
	public function getMilestones() {
		return $this->milestones;
	}

	/**
	 * Sets the milestones
	 *
	 * @param boolean $milestones
	 * @return void
	 */
	public function setMilestones($milestones) {
		$this->milestones = $milestones;
	}

	/**
	 * Returns the boolean state of milestones
	 *
	 * @return boolean
	 */
	public function isMilestones() {
		return $this->milestones;
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

}