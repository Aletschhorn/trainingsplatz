<?php

namespace DW\Trainingsplatz\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \DW\Trainingsplatz\Domain\Model\Training.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class TrainingTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \DW\Trainingsplatz\Domain\Model\Training
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \DW\Trainingsplatz\Domain\Model\Training();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getAuthorReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAuthor()
		);
	}

	/**
	 * @test
	 */
	public function setAuthorForStringSetsAuthor() {
		$this->subject->setAuthor('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'author',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLeaderReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLeader()
		);
	}

	/**
	 * @test
	 */
	public function setLeaderForStringSetsLeader() {
		$this->subject->setLeader('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'leader',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCreationDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getCreationDate()
		);
	}

	/**
	 * @test
	 */
	public function setCreationDateForDateTimeSetsCreationDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setCreationDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'creationDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLastChangeReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getLastChange()
		);
	}

	/**
	 * @test
	 */
	public function setLastChangeForDateTimeSetsLastChange() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setLastChange($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'lastChange',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTrainingDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getTrainingDate()
		);
	}

	/**
	 * @test
	 */
	public function setTrainingDateForDateTimeSetsTrainingDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setTrainingDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'trainingDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGuidedReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getGuided()
		);
	}

	/**
	 * @test
	 */
	public function setGuidedForBooleanSetsGuided() {
		$this->subject->setGuided(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'guided',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() {
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStartTextReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getStartText()
		);
	}

	/**
	 * @test
	 */
	public function setStartTextForStringSetsStartText() {
		$this->subject->setStartText('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'startText',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStartCoordinatesReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getStartCoordinates()
		);
	}

	/**
	 * @test
	 */
	public function setStartCoordinatesForStringSetsStartCoordinates() {
		$this->subject->setStartCoordinates('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'startCoordinates',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDurationReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getDuration()
		);
	}

	/**
	 * @test
	 */
	public function setDurationForFloatSetsDuration() {
		$this->subject->setDuration(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'duration',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getDistanceReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getDistance()
		);
	}

	/**
	 * @test
	 */
	public function setDistanceForFloatSetsDistance() {
		$this->subject->setDistance(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'distance',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getSpeedReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getSpeed()
		);
	}

	/**
	 * @test
	 */
	public function setSpeedForFloatSetsSpeed() {
		$this->subject->setSpeed(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'speed',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getRouteReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getRoute()
		);
	}

	/**
	 * @test
	 */
	public function setRouteForStringSetsRoute() {
		$this->subject->setRoute('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'route',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPictureReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPicture()
		);
	}

	/**
	 * @test
	 */
	public function setPictureForStringSetsPicture() {
		$this->subject->setPicture('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'picture',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCancelledReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getCancelled()
		);
	}

	/**
	 * @test
	 */
	public function setCancelledForBooleanSetsCancelled() {
		$this->subject->setCancelled(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'cancelled',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIntensityReturnsInitialValueForIntensity() {
		$this->assertEquals(
			NULL,
			$this->subject->getIntensity()
		);
	}

	/**
	 * @test
	 */
	public function setIntensityForIntensitySetsIntensity() {
		$intensityFixture = new \DW\Trainingsplatz\Domain\Model\Intensity();
		$this->subject->setIntensity($intensityFixture);

		$this->assertAttributeEquals(
			$intensityFixture,
			'intensity',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSportReturnsInitialValueForSport() {
		$this->assertEquals(
			NULL,
			$this->subject->getSport()
		);
	}

	/**
	 * @test
	 */
	public function setSportForSportSetsSport() {
		$sportFixture = new \DW\Trainingsplatz\Domain\Model\Sport();
		$this->subject->setSport($sportFixture);

		$this->assertAttributeEquals(
			$sportFixture,
			'sport',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMapReturnsInitialValueForMap() {
		$this->assertEquals(
			NULL,
			$this->subject->getMap()
		);
	}

	/**
	 * @test
	 */
	public function setMapForMapSetsMap() {
		$mapFixture = new \DW\Trainingsplatz\Domain\Model\Map();
		$this->subject->setMap($mapFixture);

		$this->assertAttributeEquals(
			$mapFixture,
			'map',
			$this->subject
		);
	}
}
