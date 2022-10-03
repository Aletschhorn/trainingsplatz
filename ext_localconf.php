<?php
defined('TYPO3') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'DW.trainingsplatz',
	'Tp',
	[
		'Training' => 'short, list, show, new, create, edit, update, delete, cancel, activate, addAnswer, editAnswer, modifyAnswer, cancelAnswer, reactivateAnswer, evaluate, evaluate, close, billing, discount, finalize, message, messageSend, participation, userParticipation',
		'Intensity' => 'list',
		'Sport' => 'list',
		'Map' => '',
		'Answer' => 'list, show, new, create, edit, update, delete',
		'Infomail' => 'list',
	],
	// non-cacheable actions
	[
		'Training' => 'show, new, create, edit, update, delete, cancel, activate, addAnswer, editAnswer, modifyAnswer, cancelAnswer, reactivateAnswer, evaluate, evaluate, close, billing, discount, finalize, message, messageSend, participation, userParticipation',
		'Intensity' => '',
		'Sport' => '',
		'Map' => '',
		'Answer' => 'create, update, delete',
		'Infomail' => '',
	]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'DW.trainingsplatz',
	'Tpadmin',
	[
		'Training' => 'analysis, ranking, reports, single',
	],
	// non-cacheable actions
	[
		'Training' => 'analysis, ranking, reports',
	]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'DW.trainingsplatz',
	'Map',
	[
		'Map' => 'list, show, new, create, edit, update, delete',
	],
	// non-cacheable actions
	[
		'Map' => 'create, update, delete',
	]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'DW.trainingsplatz',
	'Infomail',
	[
		'Infomail' => 'list, show, review, copy, send, delete, deny, cancel',
	],
	// non-cacheable actions
	[
		'Infomail' => 'create, copy, send, delete, deny, cancel',
	]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'DW.trainingsplatz',
	'User',
	[
		'User' => 'birthday, message, messageSend',
	],
	// non-cacheable actions
	[
		'User' => 'message, messageSend',
	]
);

// Overwrite object classes to extend femanager fields
$extbaseObjectContainer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\Container\Container::class);
$extbaseObjectContainer->registerImplementation(
    \In2code\Femanager\Controller\NewController::class,
    \DW\Trainingsplatz\Controller\NewController::class
);
$extbaseObjectContainer->registerImplementation(
    \In2code\Femanager\Controller\EditController::class,
    \DW\Trainingsplatz\Controller\EditController::class
);
$extbaseObjectContainer->registerImplementation(
    \In2code\Femanager\Controller\EditInitController::class,
    \DW\Trainingsplatz\Controller\EditInitController::class
);
$extbaseObjectContainer->registerImplementation(
    \In2code\Femanager\Domain\Model\User::class,
    \DW\Trainingsplatz\Domain\Model\User::class
);

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Femanager\Controller\NewController::class] = ['className' => \DW\Trainingsplatz\Controller\NewController::class];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Femanager\Controller\EditController::class] = ['className' => \DW\Trainingsplatz\Controller\EditController::class];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Femanager\Controller\EditInitController::class] = ['className' => \DW\Trainingsplatz\Controller\EditInitController::class];
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\In2code\Femanager\Domain\Model\User::class] = ['className' => \DW\Trainingsplatz\Domain\Model\User::class];

// Register type converter
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter(\DW\Trainingsplatz\Property\TypeConverter\BitConverter::class);

