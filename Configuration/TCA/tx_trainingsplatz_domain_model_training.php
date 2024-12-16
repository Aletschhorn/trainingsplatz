<?php
return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => TRUE,
		'default_sortby' => 'ORDER BY training_date DESC',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
		'searchFields' => 'author,leader,creation_date,last_change,training_date,guided,title,description,start_text,start_coordinates,duration,distance,speed,route,picture,cancelled,intensity,sport,map,',
		'iconfile' => 'EXT:trainingsplatz/Resources/Public/Icons/tx_trainingsplatz_domain_model_training.png'
	],
	'interface' => [
		'showRecordFieldList' => 'title, hidden, public, closed, author, creation_date, last_change, training_date, guided, leader, duration, distance, speed, cancelled, intensity, sport, map, map_center, map_zoom, map_type, infomail, notification',
	],
	'types' => [
		'1' => ['showitem' => '--palette--;;displayOptions, --palette--;;creationChange, --palette--;;notifications, --div--;LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.tab_content, author, --palette--;;sportcoach, --palette--;;dateTitle, --palette--;;sportIntensity, start_text, duration, distance, speed, description, picture, --div--;LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.tab_map, start_option, start_coordinates, route, map, --palette--;;drawMap, --div--;LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.tab_series, series, series_start, series_end, series_period, series_number, series_weekday, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'],
	],
	'palettes' => [
		'1' => ['showitem' => ''],
		'displayOptions' => ['showitem' => 'hidden, public, cancelled, closed'],
		'creationChange' => ['showitem' => 'creation_date, last_change'],
		'notifications' => ['showitem' => 'infomail, notification'],
		'dateTitle' => ['showitem' => 'training_date, title'],
		'sportIntensity' => ['showitem' => 'sport, intensity'],
		'sportcoach' =>['showitem' => 'guided, leader'],
		'drawMap' => ['showitem' => 'map_center, map_zoom, map_type'],
	],
	'columns' => [
	
		't3ver_label' => [
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			]
		],
	
		'hidden' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
			]
		],
		'starttime' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				],
			]
		],
		'endtime' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				]
			]
		],

		'title' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			]
		],
		'description' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.description',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
			]
		],
		'author' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.author',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'foreign_table_where' => 'ORDER BY username',
				'items' => [
					['(nobody)', 0]
				]
			]
		],
		'leader' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.leader',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'foreign_table_where' => 'ORDER BY username',
				'items' => [
					['(nobody)', 0]
				]
			]
		],
		'creation_date' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.creation_date',
			'config' => [
				'dbType' => 'datetime',
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime',
				'default' => '0000-00-00 00:00:00'
			],
		],
		'last_change' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.last_change',
			'config' => [
				'dbType' => 'datetime',
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime',
				'default' => '0000-00-00 00:00:00'
			]
		],
		'training_date' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.training_date',
			'config' => [
				'type' => 'input',
				'dbType' => 'date',
				'renderType' => 'inputDateTime',
				'eval' => 'date,int',
			]
		],
		'guided' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.guided',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'start_text' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.start_text',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'start_option' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.start_option',
			'config' => [
				'type' => 'input',
				'size' => 5,
				'eval' => 'int'
			],
		],
		'start_coordinates' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.start_coordinates',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'duration' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.duration',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			]
		],
		'distance' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.distance',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			]
		],
		'speed' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.speed',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			]
		],
		'route' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.route',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			]
		],
		'picture' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.picture',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'cancelled' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.cancelled',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'intensity' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.intensity',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_trainingsplatz_domain_model_intensity',
			],
		],
		'sport' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.sport',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_trainingsplatz_domain_model_sport',
			],
		],
		'map' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.map',
			'config' => [
				'type' => 'inline',
				'foreign_table' => 'tx_trainingsplatz_domain_model_map',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => [
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				],
			],
		],
		'map_center' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.map_center',
			'config' => [
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim'
			]
		],
		'map_zoom' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.map_zoom',
			'config' => [
				'type' => 'input',
				'size' => 3,
				'eval' => 'int'
			]
		],
		'map_type' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.map_type',
			'config' => [
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim'
			]
		],
		'infomail' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.infomail',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'notification' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.notification',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'public' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.public',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'closed' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.closed',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'series' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'series_start' => [
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_start',
			'config' => [
				'type' => 'input',
				'dbType' => 'date',
				'renderType' => 'inputDateTime',
				'eval' => 'date,int',
			],
		],
		'series_end' => [
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_end',
			'config' => [
				'type' => 'input',
				'dbType' => 'date',
				'renderType' => 'inputDateTime',
				'eval' => 'date,int',
			],
		],
		'series_period' => [
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_period',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['wöchentlich', 0],
					['monatlich', 1],
				],
			],
		],
		'series_number' => [
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_number',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['ersten', 0],
					['zweiten', 1],
					['dritten', 2],
					['vierten', 3],
					['letzten', 4],
				],
			],
		],
		'series_weekday' => [
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_weekday',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['Montag', 0],
					['Dienstag', 1],
					['Mittwoch', 2],
					['Donnerstag', 3],
					['Freitag', 4],
					['Samstag', 5],
					['Sonntag', 6],
				],
			],
		],

	],
];
?>