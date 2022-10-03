<?php
defined('TYPO3_MODE') or die();


// Add some fields to FE Users table to show TCA fields definitions
// USAGE: TCA Reference > $TCA array reference > ['columns'][fieldname]['config'] / TYPE: "select"
$temporaryColumns = array (
        'tx_trainingsplatz_membership' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_membership',
			'config' => array (
					'type' => 'radio',
					'default' => 2,
					'items' => array (
							array ('(offen)', 0),
							array ('B-Mitglied', 1),
							array ('A-Mitglied', 2)
					),
			)
        ),
        'tx_trainingsplatz_guide' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_guide',
			'config' => array (
					'type' => 'check',
					'default' => 0,
			)
        ),
        'tx_trainingsplatz_infomail' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_infomail',
			'config' => array (
					'type' => 'check',
					'default' => 1,
			)
        ),
        'tx_trainingsplatz_newsletter' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_newsletter',
			'config' => array (
					'type' => 'check',
					'default' => 1,
			)
        ),
        'tx_trainingsplatz_contest' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_contest',
			'config' => array (
					'type' => 'check',
					'default' => 1,
			)
        ),
        'tx_trainingsplatz_contest_extra' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_contest_extra',
			'config' => array (
					'type' => 'input',
					'eval' => 'int',
					'size' => 5,
			)
        ),
        'tx_trainingsplatz_sports' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_sports',
			'config' => array (
				'type' => 'check',
				'cols' => 5,
				'items' => array (
					array('Joggen', ''),
					array('Inlineskaten', ''),
					array('Velofahren', ''),
					array('Mountainbiken', ''),
					array('Schwimmen', ''),
				),
			)
        ),
        'tx_trainingsplatz_motivation' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_motivation',
			'config' => array (
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'tx_trainingsplatz_domain_model_motivation',
				'items' => array (
					array('(none)', 0)
				),		
			)
        ),
        'tx_trainingsplatz_club1_name' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_club1_name',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_club1_website' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_club1_website',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_club2_name' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_club2_name',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_club2_website' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_club2_website',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_goal' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_goal',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_hobby' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_hobby',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_music' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_music',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_food' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_food',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_like' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_like',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_dislike' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_dislike',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_job' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_job',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_love' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_love',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_meaningsport' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_meaningsport',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_motto' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_motto',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_sparetime' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_sparetime',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_dream' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_dream',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_notdisclaim' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_notdisclaim',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_book' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_book',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_weakness' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_weakness',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_strength' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_strength',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_ability' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_ability',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_drivecrazy' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_drivecrazy',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_laugh' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_laugh',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_spendmoney' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_spendmoney',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_description' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_description',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_pain' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_pain',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
        'tx_trainingsplatz_private_luxury' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:trainingsplatz/Resources/Private/Language/locallang_db.xlf:fe_users.tx_trainingsplatz_private_luxury',
			'config' => array (
				'type' => 'input',
				'eval' => 'trim',
			)
        ),
);

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