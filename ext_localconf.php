<?php

use DW\Trainingsplatz\Controller\TrainingController;
use DW\Trainingsplatz\Controller\InfomailController;
use DW\Trainingsplatz\Controller\UserController;

defined('TYPO3') or die();

(static function() {
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Trainingsplatz',
		'TrainingList',
		[TrainingController::class => 'list, show, new, create, edit, update, delete, cancel, activate, addAnswer, editAnswer, modifyAnswer, cancelAnswer, reactivateAnswer, message, messageSend, cancelRequestAnswer, cancelPublicAnswer'],
		[TrainingController::class => 'new, create, edit, update, delete, cancel, activate, addAnswer, editAnswer, modifyAnswer, cancelAnswer, reactivateAnswer, message, messageSend, cancelRequestAnswer, cancelPublicAnswer']
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Trainingsplatz',
		'TrainingEvaluation',
		[TrainingController::class => 'evaluate, close, billing, discount, finalize'],
		[TrainingController::class => 'close, billing, discount, finalize']
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Trainingsplatz',
		'TrainingParticipation',
		[TrainingController::class => 'participation, userParticipation'],
		[TrainingController::class => 'userParticipation']
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Trainingsplatz',
		'TrainingParticipationUser',
		[TrainingController::class => 'userParticipation'],
		[TrainingController::class => 'userParticipation']
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Trainingsplatz',
		'CompetitionRanking',
		[TrainingController::class => 'ranking'],
		[TrainingController::class => '']
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Trainingsplatz',
		'CompetitionUser',
		[TrainingController::class => 'userCompetition'],
		[TrainingController::class => '']
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Trainingsplatz',
		'Admin',
		[TrainingController::class => 'analysis, ranking, reports, single'],
		[TrainingController::class => '']
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Trainingsplatz',
		'Infomail',
		[InfomailController::class => 'list, show, review, copy, send, delete, deny, cancel'],
		[InfomailController::class => 'create, copy, send, delete, deny, cancel']
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Trainingsplatz',
		'Birthday',
		[UserController::class => 'birthday'],
		[UserController::class => '']
	);
	
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
		'Trainingsplatz',
		'Messaging',
		[UserController::class => 'message, messageSend'],
		[UserController::class => 'message, messageSend']
	);
	
	
	// Overwrite object classes to extend femanager fields
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Femanager\Controller\NewController::class] = ['className' => \DW\Trainingsplatz\Controller\NewController::class];
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Femanager\Controller\EditController::class] = ['className' => \DW\Trainingsplatz\Controller\EditController::class];
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Femanager\Controller\EditInitController::class] = ['className' => \DW\Trainingsplatz\Controller\EditInitController::class];
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Femanager\Domain\Model\User::class] = ['className' => \DW\Trainingsplatz\Domain\Model\User::class];
	
	// Register type converter
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter(\DW\Trainingsplatz\Property\TypeConverter\BitConverter::class);

})();