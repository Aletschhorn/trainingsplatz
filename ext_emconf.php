<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "trainingsplatz"
 *
 * Auto generated by Extension Builder 2015-11-05
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
	'title' => 'Trainingsplatz',
	'description' => '',
	'category' => 'plugin',
	'author' => 'Daniel Widmer',
	'author_email' => 'daniel.widmer@freizeitsportler.ch',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '3.7.0',
	'constraints' => [
		'depends' => [
			'typo3' => '10.4.0-11.5.99',
		],
		'conflicts' => [
		],
		'suggests' => [
		],
	],
];


/***********************************************
 * Version 1.2.0
 * -------------                    
 * Constant to suppress sending of e-mails
 * Shows number of participants per training in Training/ShortAction, crops title of training to limit to 2 lines
 * Shows name of user below avatar for User/BirthdayAction and Training/RankingAction
 * InfoMail content is updated if training properties are modified
 * Cache of defined pages is cleared after creation, modification or deletion of an answer
 * For non-guided trainings an answer is automatically created for training author when billing (if not existing yet)
 * Competition ranking list correct even if last date is a future date (but must be sorted by increasing date)
 *
 * Version 1.2.1
 * -------------                    
 * Function BitConverter: changed "return 12;" to "return $sum;"
 *
 * Version 1.3.0
 * -------------                    
 * Sending of InfoMails via scheduler instead of directly
 *
 * Version 1.3.1
 * -------------                    
 * Sending of InfoMails via scheduler in slices of 100 recipients
 *
 * Version 1.3.2
 * -------------                    
 * Number of mails per batch flexible with constants
 *
 * Version 1.3.3
 * -------------                    
 * Correction to avoid timeout during sending with scheduler
 *
 * Version 2.0.0
 * -------------                    
 * Compatible for PHP7:
 *   New Xclass extending core function Argument
 *   Using initial classes for user in EditController (Femanagerextended)
 * E-mail notification if user deletes his profile
 *
 * Version 2.0.1
 * -------------                    
 * Bugfix in TrainingController, RankingAction: check if $answer->getFeuser give a valid user
 *
 * Version 2.1.0
 * -------------                    
 * Allow length for training title changed from 80 to 120 characters
 * LinksInText viewhelper allows to transform url addresses into clickable links
 * Admin frontend users can modify the author of a training
 * Verifies that any training date is entered when creating and updating a training before validating the date
 * FE usergroup IDs are extension constants instead of hard-coded
 * Login page PID is an extension constant instead of hard-coded
 * Verification of admin usergroup to sent, deny, and copy infomails
 * Formating FlashMessages with separate "Alert" partial layout
 * Admins, training authors, and training leaders can send e-mail message to all participants of a training
 * Sending e-mails to users via online form
 * Template text for training description (new table, AJAX functionality via eID)
 *
 * Version 2.1.1
 * -------------                    
 * Show button per training to e-mail to participants in every case but disabled if number of participants = 0
 * Default leader for training is creating user, if he is in SportCoach user group
 *
 * Version 2.2.0
 * -------------                    
 * Preparation for new guide concept: added participation action
 *
 * Version 2.2.1
 * -------------                    
 * Billing allows for SportCoach compensation even for non-guided trainings
 *
 * Version 2.2.2
 * -------------                    
 * Further developed userParticipation action
 * Correction in participation action to get correct sorting
 *
 * Version 2.3.0
 * -------------                    
 * New analysis (per year) action for trainings
 *
 * Version 2.4.0
 * -------------                    
 * Replaced function getRankingStartDate by getRankingDateRange in Training controller
 * Added analysis of reports and competition (Sportler des Jahres) per year
 *
 * Version 2.4.1
 * -------------                    
 * Allow to see details of a training from analysis view (new action single)
 * Removed training admin options from Tp plugin (now only via Tpadmin plugin)
 *
 * Version 2.4.2
 * -------------                    
 * Added sports swimming for field tx_trainingsplatz_sports in table fe_users
 * Removed option of guided trainings for new and edit trainings (in partial "step2")
 *
 * Version 2.5.0 (compatible for TYPO3 8.7)
 * -------------                    
 * Removed "parent::initializeCreateAction()" in NewController::initializeCreateAction()
 *
 * Version 2.5.1
 * -------------
 * Store $filter value in session cookie for show action
 * Corrections ins NewController.php
 *
 * Version 2.6.0
 * -------------
 * Added feature that users that subscribed for a training as non-users can cancel the subscription via e-mail link (nneds DB update!)
 *
 * Version 2.6.1
 * -------------
 * Set default sorting for trainings to TrainingDate ASC, title ASC
 *
 * Version 2.6.2
 * -------------
 * Minor change in partial template Description.html and in LinkInText viewhelper to show links correctly
 *
 * Version 2.7.0
 * -------------
 * Change from Google Maps PAI version 2 to version 3
 *
 * Version 2.7.1
 * -------------
 * Hinder cancellation of trainings on the next or a later day
 *
 * Version 2.8.0
 * -------------
 * Year nagivation in participation list (Guide training list)
 *
 * Version 2.8.1
 * -------------
 * Rename of Aktivmitglied -> A-Mitglied and Passivmitglied -> B-Mitglied in TCA-Overrides for fe_users
 *
 * Version 2.9.0
 * -------------
 * Added possibility to create training series
 *
 * Version 2.9.1
 * -------------
 * Minor corrections is variable seriesDates for EditAction in TrainingController
 *
 * Version 2.9.2
 * -------------
 * Several corrections for DateTime objects in TrainingController
 *
 * Version 3.1.0
 * -------------
 * Compatibility with TYPO3 version 10
 *
 * Version 3.2.0
 * -------------
 * Intermediate version that allows to transfer the training date from DateTime to only date
 *
 * Version 3.3.0
 * -------------
 * Training date stored only as date (not dateTime)
 *
 * Version 3.4.0
 * -------------
 * Corrected bug: path of meeting point icon in TrainingController corrected
 * Removed option of showing training reout (in training edit step 3)
 * Renamed typoscript files from .txt to .typoscript
 *
 * Version 3.4.1
 * -------------
 * Re-enabled usage of flexforms
 *
 * Version 3.5.0
 * -------------
 * Get rid of switchable actions in plugin flexforms
 * Get rid of cache clearing in extension (to be done with PageTS instead)
 * Tidying up controller files
 *
 * Version 3.5.1
 * -------------
 * Corrected URL in informails
 *
 * Version 3.5.2
 * -------------
 * Corrected partial template Step3.html to allow setting a training startpoiint in Google Maps
 *
 * Version 3.5.3
 * -------------
 * Corrected trainings dates of a series
 *
 * Version 3.5.4
 * -------------
 * Deleted twice "return htmlResponse" from TrainingController
 *
 * Version 3.5.5
 * -------------
 * Corrections in user participation
 * Correction of link creation for trainings answer cancellation link of non-members
 *
 * Version 3.6.0
 * -------------
 * Use fluid-based e-mails
 *
 * Version 3.6.1
 * -------------
 * Embed logo in fluid-based e-mails (InfoMails)
 *
 * Version 3.6.2
 * -------------
 * Embed logo in all other fluid-based e-mails
 *
 * Version 3.6.3
 * -------------
 * Reduce loading duration of training list
 *
 * Version 3.7.0
 * -------------
 * Provides deletion button per answer in training show action for admins
 *
**/