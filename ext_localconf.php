<?php
declare(strict_types=1);

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use DW\Trainingsplatz\Controller\TrainingController;
use DW\Trainingsplatz\Controller\InfomailController;
use DW\Trainingsplatz\Controller\MemberController;

defined('TYPO3') or die();

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'TrainingList',
	[TrainingController::class => 'list, show, new, create, edit, update, delete, cancel, activate, addAnswer, editAnswer, modifyAnswer, cancelAnswer, reactivateAnswer, deleteAnswer, message, messageSend, cancelRequestAnswer, cancelPublicAnswer'],
	[TrainingController::class => 'new, create, edit, update, delete, cancel, activate, addAnswer, editAnswer, modifyAnswer, cancelAnswer, reactivateAnswer, deleteAnswer, message, messageSend, cancelRequestAnswer, cancelPublicAnswer'],
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'TrainingEvaluation',
	[TrainingController::class => 'evaluate, close, billing, discount, finalize'],
	[TrainingController::class => 'close, billing, discount, finalize'],
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'TrainingParticipation',
	[TrainingController::class => 'participation, userParticipation'],
	[TrainingController::class => 'userParticipation'],
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'TrainingParticipationUser',
	[TrainingController::class => 'userParticipation'],
	[TrainingController::class => 'userParticipation'],
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'CompetitionRanking',
	[TrainingController::class => 'ranking'],
	[TrainingController::class => ''],
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'CompetitionUser',
	[TrainingController::class => 'userCompetition'],
	[TrainingController::class => ''],
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'Admin',
	[TrainingController::class => 'analysis, ranking, reports, single'],
	[TrainingController::class => ''],
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'Infomail',
	[InfomailController::class => 'list, show, review, copy, send, delete, deny, cancel'],
	[InfomailController::class => 'create, copy, send, delete, deny, cancel'],
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'Birthday',
	[MemberController::class => 'birthday'],
	[MemberController::class => ''],
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'Messaging',
	[MemberController::class => 'message, messageSend'],
	[MemberController::class => 'message, messageSend'],
);

// Overwrite object classes to extend femanager fields
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Femanager\Controller\NewController::class] = ['className' => \DW\Trainingsplatz\Controller\NewController::class];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Femanager\Controller\EditController::class] = ['className' => \DW\Trainingsplatz\Controller\EditController::class];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Femanager\Controller\UserController::class] = ['className' => \DW\Trainingsplatz\Controller\UserController::class];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Femanager\Domain\Model\User::class] = ['className' => \DW\Trainingsplatz\Domain\Model\User::class];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Femanager\Domain\Repository\UserRepository::class] = ['className' => \DW\Trainingsplatz\Domain\Repository\UserRepository::class];
