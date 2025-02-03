<?php
return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_template',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
		'versioningWS' => true,
		'searchFields' => 'title,templatetext',
		'iconfile' => 'EXT:trainingsplatz/Resources/Public/Icons/tx_trainingsplatz_domain_model_template.png'
	],
	'types' => [
		'1' => ['showitem' => 'hidden, title, --palette--;;sportIntensity, templatetext, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, starttime, endtime'],
	],
	'palettes' => [
		'1' => ['showitem' => ''],
		'sportIntensity' => ['showitem' => 'sport, intensity, guided'],
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
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_template.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'templatetext' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_template.templatetext',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
			],
		],
		'guided' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_template.guided',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'intensity' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_template.intensity',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_trainingsplatz_domain_model_intensity',
			],
		],
		'sport' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_template.sport',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_trainingsplatz_domain_model_sport',
			],
		],

	],
];
?>