<?php
defined('TYPO3_MODE') || die();

foreach (['training', 'intensity', 'sport', 'map', 'answer', 'infomail', 'motivation', 'template'] as $table) {
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_trainingsplatz_domain_model_' . $table);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_trainingsplatz_domain_model_' . $table, 
	'EXT:trainingsplatz/Resources/Private/Language/locallang_csh_tx_trainingsplatz_domain_model_' . $table . '.xlf');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('trainingsplatz', 'Configuration/TypoScript', 'Trainingsplatz');

