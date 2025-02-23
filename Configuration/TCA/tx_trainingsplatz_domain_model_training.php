<?php
return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
		],
		'default_sortby' => 'ORDER BY training_date DESC',
		'searchFields' => 'title,description,start_text,start_coordinates,duration,distance,speed,route',
		'iconfile' => 'EXT:trainingsplatz/Resources/Public/Icons/tx_trainingsplatz_domain_model_training.png'
	],
	'types' => [
		'1' => ['showitem' => '--palette--;;displayOptions, --palette--;;creationChange, --palette--;;notifications, --div--;LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.tab_content, author, --palette--;;sportcoach, --palette--;;dateTitle, --palette--;;sportIntensity, start_text, duration, distance, speed, description, picture, --div--;LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.tab_map, start_option, start_coordinates, route, --palette--;;drawMap, --div--;LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.tab_series, series, series_start, series_end, series_period, series_number, series_weekday, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access'],
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
		'hidden' => [
			'exclude' => true,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
			]
		],
		'title' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			]
		],
		'description' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.description',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
			]
		],
		'author' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.author',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'foreign_table_where' => 'ORDER BY username',
				'items' => [
					['label' => '(nobody)', 'value' => 0]
				]
			]
		],
		'leader' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.leader',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'foreign_table_where' => 'ORDER BY username',
				'items' => [
					['label' => '(nobody)', 'value' => 0]
				]
			]
		],
		'creation_date' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.creation_date',
			'config' => [
				'type' => 'datetime',
				'dbType' => 'datetime',
				'nullable' => true,
			],
		],
		'last_change' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.last_change',
			'config' => [
				'type' => 'datetime',
				'dbType' => 'datetime',
				'nullable' => true,
			]
		],
		'training_date' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.training_date',
			'config' => [
				'type' => 'datetime',
				'dbType' => 'date',
				'format' => 'date',
				'nullable' => true,
			]
		],
		'guided' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.guided',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'start_text' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.start_text',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'start_option' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.start_option',
			'config' => [
				'type' => 'number',
				'size' => 10,
			],
		],
		'start_coordinates' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.start_coordinates',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'duration' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.duration',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			]
		],
		'distance' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.distance',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			]
		],
		'speed' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.speed',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			]
		],
		'route' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.route',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			]
		],
		'picture' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.picture',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			],
		],
		'cancelled' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.cancelled',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'intensity' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.intensity',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_trainingsplatz_domain_model_intensity',
			],
		],
		'sport' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.sport',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_trainingsplatz_domain_model_sport',
			],
		],
		'map_center' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.map_center',
			'config' => [
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim'
			]
		],
		'map_zoom' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.map_zoom',
			'config' => [
				'type' => 'number',
				'size' => 10,
			]
		],
		'map_type' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.map_type',
			'config' => [
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim'
			]
		],
		'infomail' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.infomail',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'notification' => [
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.notification',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'public' => array(
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.public',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'closed' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.closed',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'series' => [
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series',
			'config' => [
				'type' => 'check',
				'default' => 0
			]
		],
		'series_start' => [
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_start',
			'config' => [
				'type' => 'datetime',
				'dbType' => 'date',
				'format' => 'date',
				'nullable' => true,
			],
		],
		'series_end' => [
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_end',
			'config' => [
				'type' => 'datetime',
				'dbType' => 'date',
				'format' => 'date',
				'nullable' => true,
			],
		],
		'series_period' => [
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_period',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['label' => 'wöchentlich', 'value' => 0],
					['label' => 'monatlich', 'value' => 1],
				],
			],
		],
		'series_number' => [
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_number',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['label' => 'ersten', 'value' => 0],
					['label' => 'zweiten', 'value' => 1],
					['label' => 'dritten', 'value' => 2],
					['label' => 'vierten', 'value' => 3],
					['label' => 'letzten', 'value' => 4],
				],
			],
		],
		'series_weekday' => [
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => true,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_weekday',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => [
					['label' => 'Montag', 'value' => 0],
					['label' => 'Dienstag', 'value' => 1],
					['label' => 'Mittwoch', 'value' => 2],
					['label' => 'Donnerstag', 'value' => 3],
					['label' => 'Freitag', 'value' => 4],
					['label' => 'Samstag', 'value' => 5],
					['label' => 'Sonntag', 'value' => 6],
				],
			],
		],

	],
];
?>