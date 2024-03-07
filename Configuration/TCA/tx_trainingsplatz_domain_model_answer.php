<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer',
		'label' => 'author',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
		),
		'searchFields' => 'creation_date,change_date,author,owntraining,title,description,cancelled,training,hash',
		'iconfile' => 'EXT:trainingsplatz/Public/Icons/tx_trainingsplatz_domain_model_answer.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'hidden, creation_date, change_date, author, email, feuser, owntraining, title, description, cancelled, training, points, compensation, hash',
	),
	'types' => array(
		'1' => array('showitem' => 'hidden;;1, creation_date, change_date, author, email, feuser, owntraining, title, description, cancelled, training, points, compensation, hash'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'creation_date' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.creation_date',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'change_date' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.change_date',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'size' => 12,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => '0000-00-00 00:00:00'
			),
		),
		'author' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.author',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'feuser' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.feuser',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'foreign_table_where' => 'ORDER BY username',
				'items' => array (
					array ('(nobody)', 0)
				)
			),
		),
		'owntraining' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.owntraining',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 5,
				'eval' => 'trim'
			)
		),
		'cancelled' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.cancelled',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'training' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.training',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_trainingsplatz_domain_model_training',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'points' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.points',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array (
					array ('Offen', 0),
					array ('0 Punkte', 1),
					array ('1 Punkt', 2),
				),
			),
		),
		'compensation' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.compensation',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array (
					array ('Offen', 0),
					array ('Nein', 1),
					array ('Ja', 2),
				),
			),
		),
		'hash' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_answer.hash',
			'config' => array(
				'type' => 'input',
				'readOnly' => 1,
			)
		),
		
	),
);
?>