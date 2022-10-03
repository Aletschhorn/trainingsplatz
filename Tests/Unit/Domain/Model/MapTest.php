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
 * Test case for class \DW\Trainingsplatz\Domain\Model\Map.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class MapTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \DW\Trainingsplatz\Domain\Model\Map
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \DW\Trainingsplatz\Domain\Model\Map();
	}

	protected function tearDown() {
		unset($this->subject);
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
	public function getCenterReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCenter()
		);
	}

	/**
	 * @test
	 */
	public function setCenterForStringSetsCenter() {
		$this->subject->setCenter('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'center',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZoomReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getZoom()
		);
	}

	/**
	 * @test
	 */
	public function setZoomForIntegerSetsZoom() {
		$this->subject->setZoom(12);

		$this->assertAttributeEquals(
			12,
			'zoom',
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
}
