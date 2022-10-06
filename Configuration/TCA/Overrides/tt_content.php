<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(
    function () {
		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'TrainingList',
			'Training List'
		);

		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'TrainingEvaluation',
			'Training Evaluation'
		);

		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'TrainingParticipation',
			'Training Participation'
		);

		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'TrainingParticipationUser',
			'Training Participation User View'
		);

		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'CompetitionRanking',
			'Competition Ranking'
		);

		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'CompetitionUser',
			'Competition User View'
		);

		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'Admin',
			'Trainingsplatz Admin Tools'
		);
		
		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'Infomail',
			'Training Infomails'
		);
		
		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'Birthday',
			'Member Birthdays'
		);
		
		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'Messaging',
			'Member Messaging'
		);
		
		// register flexforms
		foreach (['traininglist', 'competitionranking', 'birthday'] as $plugin) {
			$pluginSignature = 'trainingsplatz_'.$plugin;
			$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
			ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:trainingsplatz/Configuration/FlexForms/flexform_'.$plugin.'.xml'); 
		}
    }
);
?>