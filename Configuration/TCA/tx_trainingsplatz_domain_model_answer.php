<?php
return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer',
		'label' => 'author',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'delete' => 'deleted',
		'versioningWS' => true,
		'enablecolumns' => [
			'disabled' => 'hidden',
		],
		'searchFields' => 'author,title,description,training,hash',
		'iconfile' => 'EXT:trainingsplatz/Public/Icons/tx_trainingsplatz_domain_model_answer.gif'
	],
	'types' => [
		'1' => ['showitem' => 'hidden;;1, creation_date, change_date, author, email, feuser, owntraining, title, description, cancelled, training, points, compensation, hash'],
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
		'creation_date' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.creation_date',
			'config' => [
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			],
		],
		'change_date' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.change_date',
			'config' => [
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			],
		],
		'author' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.author',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'email' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.email',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'feuser' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.feuser',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'foreign_table_where' => 'ORDER BY username',
				'items' => [
					['label' => '(nobody)', 'value' => 0]
				]
			],
		],
		'owntraining' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.owntraining',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'title' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'description' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.description',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 5,
				'eval' => 'trim'
			]
		],
		'cancelled' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.cancelled',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'training' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.training',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_trainingsplatz_domain_model_training',
				'minitems' => 0,
				'maxitems' => 1,
			],
		],
		'points' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.points',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['label' => 'Offen', 'value' => 0],
					['label' => '0 Punkte', 'value' => 1],
					['label' => '1 Punkt', 'value' => 2],
				],
			],
		],
		'compensation' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.compensation',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['label' => 'Offen', 'value' => 0],
					['label' => 'Nein', 'value' => 1],
					['label' => 'Ja', 'value' => 2],
				],
			],
		],
		'hash' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.hash',
			'config' => [
				'type' => 'input',
				'readOnly' => 1,
			]
		],
		
	],
];
?>