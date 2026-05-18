<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') or die();

(static function (): void {
	$pluginSignature = ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'TrainingList',
		'Training List',
		null,
		'Trainingsplatz',
		'List and details of trainings',
		'FILE:EXT:trainingsplatz/Configuration/FlexForms/flexform_traininglist.xml'
	);
	ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--div--;Configuration,pi_flexform,', $pluginSignature, 'after:subheader');
	ExtensionManagementUtility::addPiFlexFormValue('', 'FILE:EXT:trainingsplatz/Configuration/FlexForms/flexform_traininglist.xml', $pluginSignature);

	$pluginSignature = ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'TrainingEvaluation',
		'Training Evaluation',
		null,
		'Trainingsplatz',
		'Evaluation of past trainings to set compoetition points'
	);

	$pluginSignature = ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'TrainingParticipation',
		'Training Participation',
		null,
		'Trainingsplatz',
		'List of who participated in which trainings'
	);

	$pluginSignature = ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'TrainingParticipationUser',
		'Training Participation User View',
		null,
		'Trainingsplatz',
		'Person-dependent list in which trainings the user participated'
	);
	ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--div--;Configuration,pi_flexform,', $pluginSignature, 'after:subheader');
	ExtensionManagementUtility::addPiFlexFormValue('', 'FILE:EXT:trainingsplatz/Configuration/FlexForms/flexform_userParticipation.xml', $pluginSignature);

	$pluginSignature = ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'CompetitionRanking',
		'Competition Ranking',
		null,
		'Trainingsplatz',
		'Ranking list of training competition',
		'FILE:EXT:trainingsplatz/Configuration/FlexForms/flexform_competitionranking.xml'
	);
	ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--div--;Configuration,pi_flexform,', $pluginSignature, 'after:subheader');
	ExtensionManagementUtility::addPiFlexFormValue('', 'FILE:EXT:trainingsplatz/Configuration/FlexForms/flexform_competitionranking.xml', $pluginSignature);

	$pluginSignature = ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'CompetitionUser',
		'Competition User View',
		null,
		'Trainingsplatz',
		'Person-dependent list of points for training competition'
	);

	$pluginSignature = ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'Admin',
		'Trainingsplatz Admin Tools',
		null,
		'Trainingsplatz',
		'Various functions for admins only'
	);
	ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--div--;Configuration,pi_flexform,', $pluginSignature, 'after:subheader');
	ExtensionManagementUtility::addPiFlexFormValue('', 'FILE:EXT:trainingsplatz/Configuration/FlexForms/flexform_admin.xml', $pluginSignature);
		
	$pluginSignature = ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'Infomail',
		'Training Infomails',
		null,
		'Trainingsplatz',
		'Management of training Infomail'
	);
		
	$pluginSignature = ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'Birthday',
		'Member Birthdays',
		null,
		'Member Management',
		'List of member birthdays',
		'FILE:EXT:trainingsplatz/Configuration/FlexForms/flexform_birthday.xml'
	);
	ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--div--;Configuration,pi_flexform,', $pluginSignature, 'after:subheader');
	ExtensionManagementUtility::addPiFlexFormValue('', 'FILE:EXT:trainingsplatz/Configuration/FlexForms/flexform_birthday.xml', $pluginSignature);
		
	$pluginSignature = ExtensionUtility::registerPlugin(
		'Trainingsplatz',
		'Messaging',
		'Member Messaging',
		null,
		'Member Management',
		'Sending e-mail to another member'
	);

})();
?>