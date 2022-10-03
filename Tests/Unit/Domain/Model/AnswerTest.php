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
 * Test case for class \DW\Trainingsplatz\Domain\Model\Answer.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class AnswerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \DW\Trainingsplatz\Domain\Model\Answer
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \DW\Trainingsplatz\Domain\Model\Answer();
	}

	protected function tearDown() {
		unset($this->subject);
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
	public function getChangeDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getChangeDate()
		);
	}

	/**
	 * @test
	 */
	public function setChangeDateForDateTimeSetsChangeDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setChangeDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'changeDate',
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
	public function getTrainingReturnsInitialValueForTraining() {
		$this->assertEquals(
			NULL,
			$this->subject->getTraining()
		);
	}

	/**
	 * @test
	 */
	public function setTrainingForTrainingSetsTraining() {
		$trainingFixture = new \DW\Trainingsplatz\Domain\Model\Training();
		$this->subject->setTraining($trainingFixture);

		$this->assertAttributeEquals(
			$trainingFixture,
			'training',
			$this->subject
		);
	}
}
