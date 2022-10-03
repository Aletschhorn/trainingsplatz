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
 * Test case for class DW\Trainingsplatz\Controller\TrainingController.
 *
 */
class TrainingControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \DW\Trainingsplatz\Controller\TrainingController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('DW\\Trainingsplatz\\Controller\\TrainingController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllTrainingsFromRepositoryAndAssignsThemToView() {

		$allTrainings = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$trainingRepository = $this->getMock('DW\\Trainingsplatz\\Domain\\Repository\\TrainingRepository', array('findAll'), array(), '', FALSE);
		$trainingRepository->expects($this->once())->method('findAll')->will($this->returnValue($allTrainings));
		$this->inject($this->subject, 'trainingRepository', $trainingRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('trainings', $allTrainings);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenTrainingToView() {
		$training = new \DW\Trainingsplatz\Domain\Model\Training();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('training', $training);

		$this->subject->showAction($training);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenTrainingToView() {
		$training = new \DW\Trainingsplatz\Domain\Model\Training();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newTraining', $training);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($training);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenTrainingToTrainingRepository() {
		$training = new \DW\Trainingsplatz\Domain\Model\Training();

		$trainingRepository = $this->getMock('DW\\Trainingsplatz\\Domain\\Repository\\TrainingRepository', array('add'), array(), '', FALSE);
		$trainingRepository->expects($this->once())->method('add')->with($training);
		$this->inject($this->subject, 'trainingRepository', $trainingRepository);

		$this->subject->createAction($training);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenTrainingToView() {
		$training = new \DW\Trainingsplatz\Domain\Model\Training();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('training', $training);

		$this->subject->editAction($training);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenTrainingInTrainingRepository() {
		$training = new \DW\Trainingsplatz\Domain\Model\Training();

		$trainingRepository = $this->getMock('DW\\Trainingsplatz\\Domain\\Repository\\TrainingRepository', array('update'), array(), '', FALSE);
		$trainingRepository->expects($this->once())->method('update')->with($training);
		$this->inject($this->subject, 'trainingRepository', $trainingRepository);

		$this->subject->updateAction($training);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenTrainingFromTrainingRepository() {
		$training = new \DW\Trainingsplatz\Domain\Model\Training();

		$trainingRepository = $this->getMock('DW\\Trainingsplatz\\Domain\\Repository\\TrainingRepository', array('remove'), array(), '', FALSE);
		$trainingRepository->expects($this->once())->method('remove')->with($training);
		$this->inject($this->subject, 'trainingRepository', $trainingRepository);

		$this->subject->deleteAction($training);
	}
}
