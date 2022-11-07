<?php
return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => TRUE,
		'default_sortby' => 'ORDER BY training_date DESC',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'author,leader,creation_date,last_change,training_date,guided,title,description,start_text,start_coordinates,duration,distance,speed,route,picture,cancelled,intensity,sport,map,',
		'iconfile' => 'EXT:trainingsplatz/Resources/Public/Icons/tx_trainingsplatz_domain_model_training.png'
	),
	'interface' => array(
		'showRecordFieldList' => 'title, hidden, public, closed, author, creation_date, last_change, training_date, guided, leader, duration, distance, speed, cancelled, intensity, sport, map, map_center, map_zoom, map_type, infomail, notification',
	),
	'types' => array(
		'1' => array('showitem' => '--palette--;;displayOptions, --palette--;;creationChange, --palette--;;notifications, --div--;LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.tab_content, author, --palette--;;sportcoach, --palette--;;dateTitle, --palette--;;sportIntensity, start_text, duration, distance, speed, description, picture, --div--;LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.tab_map, start_option, start_coordinates, route, map, --palette--;;drawMap, --div--;LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.tab_series, series, series_start, series_end, series_period, series_number, series_weekday, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
		'displayOptions' => array('showitem' => 'hidden, public, cancelled, closed'),
		'creationChange' => array('showitem' => 'creation_date, last_change'),
		'notifications' => array('showitem' => 'infomail, notification'),
		'dateTitle' => array('showitem' => 'training_date, title'),
		'sportIntensity' => array('showitem' => 'sport, intensity'),
		'sportcoach' => array('showitem' => 'guided, leader'),
		'drawMap' => array('showitem' => 'map_center, map_zoom, map_type'),
	),
	'columns' => array(
	
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'title' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
			),
		),
		'author' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.author',
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
		'leader' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.leader',
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
		'creation_date' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.creation_date',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime',
				'default' => '0000-00-00 00:00:00'
			),
		),
		'last_change' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.last_change',
			'config' => array(
				'dbType' => 'datetime',
				'type' => 'input',
				'renderType' => 'inputDateTime',
				'eval' => 'datetime',
				'default' => '0000-00-00 00:00:00'
			),
		),
		'training_date' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.training_date',
			'config' => array(
				'type' => 'input',
				'dbType' => 'date',
				'renderType' => 'inputDateTime',
				'eval' => 'date,int',
			),
		),
		'guided' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.guided',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'start_text' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.start_text',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'start_option' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.start_option',
			'config' => array(
				'type' => 'input',
				'size' => 5,
				'eval' => 'int'
			),
		),
		'start_coordinates' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.start_coordinates',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'duration' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.duration',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'distance' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.distance',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'speed' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.speed',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			)
		),
		'route' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.route',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'picture' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.picture',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'cancelled' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.cancelled',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'intensity' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.intensity',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_trainingsplatz_domain_model_intensity',
			),
		),
		'sport' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.sport',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_trainingsplatz_domain_model_sport',
			),
		),
		'map' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.map',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_trainingsplatz_domain_model_map',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'map_center' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.map_center',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim'
			)
		),
		'map_zoom' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.map_zoom',
			'config' => array(
				'type' => 'input',
				'size' => 3,
				'eval' => 'int'
			)
		),
		'map_type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.map_type',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim'
			)
		),
		'infomail' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.infomail',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'notification' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.notification',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'public' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.public',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'closed' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.closed',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'series' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'series_start' => array(
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_start',
			'config' => array(
				'type' => 'input',
				'dbType' => 'date',
				'renderType' => 'inputDateTime',
				'eval' => 'date,int',
			),
		),
		'series_end' => array(
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_end',
			'config' => array(
				'type' => 'input',
				'dbType' => 'date',
				'renderType' => 'inputDateTime',
				'eval' => 'date,int',
			),
		),
		'series_period' => array(
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_period',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('wöchentlich', 0),
					array('monatlich', 1),
				),
			),
		),
		'series_number' => array(
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_number',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('ersten', 0),
					array('zweiten', 1),
					array('dritten', 2),
					array('vierten', 3),
					array('letzten', 4),
				),
			),
		),
		'series_weekday' => array(
			'displayCond' => 'FIELD:series:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:tx_trainingsplatz_domain_model_training.series_weekday',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('Montag', 0),
					array('Dienstag', 1),
					array('Mittwoch', 2),
					array('Donnerstag', 3),
					array('Freitag', 4),
					array('Samstag', 5),
					array('Sonntag', 6),
				),
			),
		),

	),
);
?>