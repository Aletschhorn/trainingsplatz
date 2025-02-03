<?php
return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_motivation',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
		],
		'sortby' => 'sorting',
		'versioningWS' => true,
		'searchFields' => 'title,',
		'iconfile' => 'EXT:trainingsplatz/Resources/Public/Icons/tx_trainingsplatz_domain_model_motivation.gif'
	],
	'types' => [
		'1' => ['showitem' => 'hidden;;1, title'],
	],
	'palettes' => [
		'1' => ['showitem' => ''],
	],
	'columns' => [
		'hidden' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
			],
		],

		'title' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_motivation.title',
			'config' => [
				'type' => 'input',
				'eval' => 'trim'
			],
		],
		
	],
];
?>