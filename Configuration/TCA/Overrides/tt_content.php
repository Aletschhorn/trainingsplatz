<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

(static function (): void {
	ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'TrainingList',
		'Training List'
	);

	ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'TrainingEvaluation',
		'Training Evaluation'
	);

	ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'TrainingParticipation',
		'Training Participation'
	);

	ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'TrainingParticipationUser',
		'Training Participation User View'
	);

	ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'CompetitionRanking',
		'Competition Ranking'
	);

	ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'CompetitionUser',
		'Competition User View'
	);

	ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'Admin',
		'Trainingsplatz Admin Tools'
	);
		
	ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'Infomail',
		'Training Infomails'
	);
		
	ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'Birthday',
		'Member Birthdays'
	);
		
	ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'Messaging',
		'Member Messaging'
	);
		
	// register flexforms
	foreach (['traininglist', 'competitionranking', 'birthday'] as $plugin) {
		$pluginSignature = 'trainingsplatz_'.$plugin;
		$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
		ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:trainingsplatz/Configuration/FlexForms/flexform_'.$plugin.'.xml'); 
	}

})();
?>