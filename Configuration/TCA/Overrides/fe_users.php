<?php
defined('TYPO3') or die();

$temporaryColumns = [
        'tx_trainingsplatz_membership' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_membership',
			'config' => [
				'type' => 'radio',
				'default' => 2,
				'items' => [
					['label' => '(offen)'],
					['label' => 'B-Mitglied'],
					['label' => 'A-Mitglied']
				],
			]
        ],
        'tx_trainingsplatz_guide' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_guide',
			'config' => [
				'type' => 'check',
				'renderType' => 'default',
				'default' => 0,
			]
        ],
        'tx_trainingsplatz_infomail' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_infomail',
			'config' => [
				'type' => 'check',
				'renderType' => 'default',
				'default' => 1,
			]
        ],
        'tx_trainingsplatz_newsletter' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_newsletter',
			'config' => [
				'type' => 'check',
				'renderType' => 'default',
				'default' => 1,
			]
        ],
        'tx_trainingsplatz_contest' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_contest',
			'config' => [
				'type' => 'check',
				'renderType' => 'default',
				'default' => 1,
			]
        ],
        'tx_trainingsplatz_contest_extra' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_contest_extra',
			'config' => [
				'type' => 'input',
				'eval' => 'int',
				'size' => 5,
			]
        ],
        'tx_trainingsplatz_sports' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_sports',
			'config' => [
				'type' => 'check',
				'renderType' => 'default',
				'cols' => 5,
				'items' => [
					['label' => 'Joggen'],
					['label' => 'Inlineskaten'],
					['label' => 'Velofahren'],
					['label' => 'Mountainbiken'],
					['label' => 'Schwimmen'],
				],
			]
        ],
        'tx_trainingsplatz_motivation' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_motivation',
			'config' => [
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_trainingsplatz_domain_model_motivation',
				'items' => [
					['(none)', 0]
				],		
			]
        ],
        'tx_trainingsplatz_club1_name' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_club1_name',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_club1_website' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_club1_website',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_club2_name' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_club2_name',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_club2_website' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_club2_website',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_goal' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_goal',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_hobby' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_hobby',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_music' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_music',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_food' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_food',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_like' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_like',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_dislike' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_dislike',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_job' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_job',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_love' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_love',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_meaningsport' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_meaningsport',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_motto' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_motto',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_sparetime' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_sparetime',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_dream' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_dream',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_notdisclaim' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_notdisclaim',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_book' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_book',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_weakness' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_weakness',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_strength' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_strength',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_ability' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_ability',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_drivecrazy' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_drivecrazy',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_laugh' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_laugh',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_spendmoney' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_spendmoney',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_description' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_description',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_pain' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_pain',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
        'tx_trainingsplatz_private_luxury' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_luxury',
			'config' => [
				'type' => 'input',
				'eval' => 'trim',
			]
        ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'fe_users',
        $temporaryColumns
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'fe_users',
        '--div--;LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tabs.trainingsplatz, tx_trainingsplatz_membership, tx_trainingsplatz_guide, tx_trainingsplatz_infomail, tx_trainingsplatz_newsletter, tx_trainingsplatz_contest, tx_trainingsplatz_contest_extra, tx_trainingsplatz_sports, tx_trainingsplatz_motivation, tx_trainingsplatz_club1_name, tx_trainingsplatz_club1_website, tx_trainingsplatz_club2_name, 	tx_trainingsplatz_club2_website, tx_trainingsplatz_private_goal, tx_trainingsplatz_private_hobby, tx_trainingsplatz_private_music, 	tx_trainingsplatz_private_food, tx_trainingsplatz_private_like, tx_trainingsplatz_private_dislike, tx_trainingsplatz_private_job, 	tx_trainingsplatz_private_love, tx_trainingsplatz_private_meaningsport, tx_trainingsplatz_private_motto, tx_trainingsplatz_private_sparetrim, 	tx_trainingsplatz_private_dream, tx_trainingsplatz_private_notdisclaim, tx_trainingsplatz_private_book, tx_trainingsplatz_private_weakness, tx_trainingsplatz_private_strength, tx_trainingsplatz_private_ability, tx_trainingsplatz_private_drivecrazy, tx_trainingsplatz_private_laugh, tx_trainingsplatz_private_spendmoney, tx_trainingsplatz_private_description, tx_trainingsplatz_private_pain, tx_trainingsplatz_private_luxury'
);

$GLOBALS['TCA']['fe_users']['columns']['image']['config']['uploadfolder'] = 'uploads/portrait';
$GLOBALS['TCA']['fe_users']['columns']['image']['config']['maxitems'] = 1;
$GLOBALS['TCA']['fe_users']['columns']['tx_extbase_type']['config']['default'] = 1;
$GLOBALS['TCA']['fe_users']['ctrl']['label'] = 'name';
$GLOBALS['TCA']['fe_users']['ctrl']['default_sortby'] = 'ORDER BY name';