<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(
    function () {

		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'Tp',
			'Trainingsplatz'
		);
		
		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'Tpadmin',
			'Trainingsplatz Admin Tools'
		);
		
		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'Map',
			'Route Maps'
		);
		
		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'Infomail',
			'Training Infomails'
		);
		
		ExtensionUtility::registerPlugin(
			'trainingsplatz',
			'User',
			'fs.ch User Functions'
		);
		
		
		// register flexform
		$pluginSignature = 'trainingsplatz_tp'; 
		$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'select_key'; 
		$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
		ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:trainingsplatz/Configuration/FlexForms/Training.xml'); 
		
		$pluginSignature = 'trainingsplatz_user';
		$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'select_key'; 
		$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
		ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:trainingsplatz/Configuration/FlexForms/User.xml'); 

    }
);
?>