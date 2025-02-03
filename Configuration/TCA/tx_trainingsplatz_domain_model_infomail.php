<?php
return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_infomail',
		'label' => 'mail_subject',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'delete' => 'deleted',
		'versioningWS' => true,
		'enablecolumns' => [
			'disabled' => 'hidden',
		],
		'searchFields' => 'training,mail_subject,mail_body',
		'iconfile' => 'EXT:trainingsplatz/Resources/Public/Icons/tx_trainingsplatz_domain_model_infomail.gif'
	],
	'types' => [
		'1' => ['showitem' => 'hidden;;1, training, status, status_date, mail_subject, mail_body, send_user, send_receiver'],
	],
	'palettes' => [
		'1' => ['showitem' => ''],
	],
	'columns' => [
		'hidden' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
			],
		],

		'training' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.training',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_trainingsplatz_domain_model_training',
				'minitems' => 0,
				'maxitems' => 1,
			],
		],
		'status' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_infomail.status',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['label' => 'Waiting', 'value' => 0],
					['label' => 'Sent', 'value' => 1],
					['label' => 'Refused', 'value' => 2],
					['label' => 'Queued', 'value' => 3],
					['label' => 'In progress', 'value' => 4]
				]
			],
		],
		'status_date' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_infomail.status_date',
			'config' => [
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			],
		],
		'mail_subject' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_infomail.mail_subject',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'mail_body' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_infomail.mail_body',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			]
		],
		'send_user' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_infomail.send_user',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'items' => [
					['label' => '(Nobody)', 'value' => 0]
				],
			],
		],
		'send_receiver' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_infomail.send_receiver',
			'config' => [
				'type' => 'number',
				'size' => 10,
			],
		],
		
	],
];
?>