<?php
namespace DW\Trainingsplatz\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 
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
 * Test case for class DW\Trainingsplatz\Controller\SportController.
 *
 */
class SportControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \DW\Trainingsplatz\Controller\SportController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('DW\\Trainingsplatz\\Controller\\SportController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllSportsFromRepositoryAndAssignsThemToView() {

		$allSports = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$sportRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$sportRepository->expects($this->once())->method('findAll')->will($this->returnValue($allSports));
		$this->inject($this->subject, 'sportRepository', $sportRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('sports', $allSports);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}
}
