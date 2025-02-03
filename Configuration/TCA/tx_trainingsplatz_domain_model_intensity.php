<?php
return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_intensity',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
		'sortby' => 'sorting',
		'versioningWS' => true,
		'searchFields' => 'title,description',
		'iconfile' => 'EXT:trainingsplatz/Resources/Public/Icons/tx_trainingsplatz_domain_model_intensity.gif',
		'security' => [
			'ignorePageTypeRestriction' => TRUE,
		],
	],
	'types' => [
		'1' => ['showitem' => 'hidden;;1, title, description, picture, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, starttime, endtime'],
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
		'starttime' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'datetime',
				'format' => 'datetime',
				'default' => 0,
			],
		],
		'endtime' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'datetime',
				'format' => 'datetime',
				'default' => 0,
			],
		],

		'title' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_intensity.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'description' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_intensity.description',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'picture' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_intensity.picture',
			'config' => [
				'type' => 'file',
				'maxitems' => 1,
				'allowed' => 'common-image-types',
			],
		],
		
	],
];
