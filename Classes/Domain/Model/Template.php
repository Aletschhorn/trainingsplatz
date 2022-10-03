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
class Template extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

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
	 * templatetext
	 *
	 * @var string
	 */
	protected $templatetext = '';

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
	 * Returns the templatetext
	 *
	 * @return string $templatetext
	 */
	public function getTemplatetext() {
		return $this->templatetext;
	}

	/**
	 * Sets the templatetext
	 *
	 * @param string $templatetext
	 * @return void
	 */
	public function setTemplatetext($templatetext) {
		$this->templatetext = $templatetext;
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

}