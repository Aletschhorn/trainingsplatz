<?php
declare(strict_types=1);

use TYPO3\CMS\Extbase\Utility\ExtensionUtility;
use DW\Trainingsplatz\Controller\TrainingController;
use DW\Trainingsplatz\Controller\InfomailController;
use DW\Trainingsplatz\Controller\UserController;

defined('TYPO3') or die();

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'TrainingList',
	[TrainingController::class => 'list, show, new, create, edit, update, delete, cancel, activate, addAnswer, editAnswer, modifyAnswer, cancelAnswer, reactivateAnswer, deleteAnswer, message, messageSend, cancelRequestAnswer, cancelPublicAnswer'],
	[TrainingController::class => 'new, create, edit, update, delete, cancel, activate, addAnswer, editAnswer, modifyAnswer, cancelAnswer, reactivateAnswer, deleteAnswer, message, messageSend, cancelRequestAnswer, cancelPublicAnswer'],
	ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'TrainingEvaluation',
	[TrainingController::class => 'evaluate, close, billing, discount, finalize'],
	[TrainingController::class => 'close, billing, discount, finalize'],
	ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'TrainingParticipation',
	[TrainingController::class => 'participation, userParticipation'],
	[TrainingController::class => 'userParticipation'],
	ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'TrainingParticipationUser',
	[TrainingController::class => 'userParticipation'],
	[TrainingController::class => 'userParticipation'],
	ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'CompetitionRanking',
	[TrainingController::class => 'ranking'],
	[TrainingController::class => ''],
	ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'CompetitionUser',
	[TrainingController::class => 'userCompetition'],
	[TrainingController::class => ''],
	ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'Admin',
	[TrainingController::class => 'analysis, ranking, reports, single'],
	[TrainingController::class => ''],
	ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'Infomail',
	[InfomailController::class => 'list, show, review, copy, send, delete, deny, cancel'],
	[InfomailController::class => 'create, copy, send, delete, deny, cancel'],
	ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'Birthday',
	[UserController::class => 'birthday'],
	[UserController::class => ''],
	ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
	'Trainingsplatz',
	'Messaging',
	[UserController::class => 'message, messageSend'],
	[UserController::class => 'message, messageSend'],
	ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);
