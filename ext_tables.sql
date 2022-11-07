#
# Table structure for table 'tx_trainingsplatz_domain_model_training'
#
CREATE TABLE tx_trainingsplatz_domain_model_training (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	author int(11) unsigned DEFAULT '0' NOT NULL,
	leader int(11) unsigned DEFAULT '0' NOT NULL,
	creation_date datetime DEFAULT '0000-00-00 00:00:00',
	last_change datetime DEFAULT '0000-00-00 00:00:00',
	training_date date DEFAULT NULL,
	guided tinyint(1) unsigned DEFAULT '0' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,
	description text NOT NULL,
	start_text varchar(255) DEFAULT '' NOT NULL,
	start_option int(11) unsigned DEFAULT '0' NOT NULL,
	start_coordinates varchar(255) DEFAULT '' NOT NULL,
	duration varchar(255) DEFAULT '' NOT NULL,
	distance varchar(255) DEFAULT '' NOT NULL,
	speed varchar(255) DEFAULT '' NOT NULL,
	route text NOT NULL,
	picture varchar(255) DEFAULT '' NOT NULL,
	cancelled tinyint(1) unsigned DEFAULT '0' NOT NULL,
	intensity int(11) unsigned DEFAULT '0',
	sport int(11) unsigned DEFAULT '0',
	map int(11) unsigned DEFAULT '0',
	map_center varchar(255) DEFAULT '' NOT NULL,
	map_zoom tinyint(4) unsigned DEFAULT '0',
	map_type varchar(255) DEFAULT '' NOT NULL,
	infomail tinyint(1) unsigned DEFAULT '0' NOT NULL,
	notification tinyint(1) unsigned DEFAULT '0' NOT NULL,
	public tinyint(1) unsigned DEFAULT '0' NOT NULL,
	closed tinyint(1) unsigned DEFAULT '0' NOT NULL,
	series tinyint(1) unsigned DEFAULT '0' NOT NULL,
	series_start date DEFAULT NULL,
	series_end date DEFAULT NULL,
	series_period int(11) unsigned DEFAULT '0',
	series_number int(11) unsigned DEFAULT '0',
	series_weekday int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid)

);

#
# Table structure for table 'tx_trainingsplatz_domain_model_intensity'
#
CREATE TABLE tx_trainingsplatz_domain_model_intensity (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	description varchar(255) DEFAULT '' NOT NULL,
	picture varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_trainingsplatz_domain_model_sport'
#
CREATE TABLE tx_trainingsplatz_domain_model_sport (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	description varchar(255) DEFAULT '' NOT NULL,
	picture int(11) unsigned NOT NULL default '0',
	picture_guided int(11) unsigned NOT NULL default '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_trainingsplatz_domain_model_map'
#
CREATE TABLE tx_trainingsplatz_domain_model_map (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	description text NOT NULL,
	author varchar(255) DEFAULT '' NOT NULL,
	maptype varchar(255) DEFAULT '' NOT NULL,
	center varchar(255) DEFAULT '' NOT NULL,
	zoom int(11) DEFAULT '0' NOT NULL,
	route text NOT NULL,
	length int(11) DEFAULT '0' NOT NULL,
	milestones tinyint(4) unsigned DEFAULT '0' NOT NULL,
	sport int(11) unsigned DEFAULT '0',
	public tinyint(4) unsigned DEFAULT '0' NOT NULL,
	last_change datetime DEFAULT '0000-00-00 00:00:00',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_trainingsplatz_domain_model_answer'
#
CREATE TABLE tx_trainingsplatz_domain_model_answer (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	creation_date datetime DEFAULT '0000-00-00 00:00:00',
	change_date datetime DEFAULT '0000-00-00 00:00:00',
	author varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	feuser int(11) unsigned DEFAULT '0' NOT NULL,
	owntraining tinyint(4) unsigned DEFAULT '0' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,
	description text NOT NULL,
	cancelled tinyint(1) unsigned DEFAULT '0' NOT NULL,
	training int(11) unsigned DEFAULT '0',
	points int(11) unsigned DEFAULT '0',
	compensation int(11) unsigned DEFAULT '0',
	hash varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_trainingsplatz_domain_model_infomail'
#
CREATE TABLE tx_trainingsplatz_domain_model_infomail (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	training int(11) unsigned DEFAULT '0' NOT NULL,
	status tinyint(4) unsigned DEFAULT '0' NOT NULL,
	status_date datetime DEFAULT '0000-00-00 00:00:00',
	mail_subject varchar(255) DEFAULT '' NOT NULL,
	mail_body text NOT NULL,	
	send_user int(11) unsigned DEFAULT '0' NOT NULL,
	send_receiver int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_trainingsplatz_domain_model_motivation'
#
CREATE TABLE tx_trainingsplatz_domain_model_motivation (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

	sorting int(11) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_trainingsplatz_domain_model_template'
#
CREATE TABLE tx_trainingsplatz_domain_model_template (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	sport int(11) unsigned DEFAULT '0',
	intensity int(11) unsigned DEFAULT '0',
	guided tinyint(1) unsigned DEFAULT '0' NOT NULL,
	templatetext text NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
 KEY language (l10n_parent,sys_language_uid)

);

#
# Extend table 'fe_users'
#
CREATE TABLE fe_users (
	tx_trainingsplatz_membership tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_trainingsplatz_guide tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_trainingsplatz_infomail tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_trainingsplatz_newsletter tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_trainingsplatz_contest tinyint(1) unsigned DEFAULT '0' NOT NULL,
	tx_trainingsplatz_contest_extra tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_trainingsplatz_sports int(11) unsigned DEFAULT '0' NOT NULL,
	tx_trainingsplatz_motivation int(11) unsigned DEFAULT '0' NOT NULL,
	tx_trainingsplatz_club1_name tinytext,
	tx_trainingsplatz_club1_website tinytext,
	tx_trainingsplatz_club2_name tinytext,
	tx_trainingsplatz_club2_website tinytext,
	tx_trainingsplatz_private_goal tinytext,
	tx_trainingsplatz_private_hobby tinytext,
	tx_trainingsplatz_private_music tinytext,
	tx_trainingsplatz_private_food tinytext,
	tx_trainingsplatz_private_like tinytext,
	tx_trainingsplatz_private_dislike tinytext,
	tx_trainingsplatz_private_job tinytext,
	tx_trainingsplatz_private_love tinytext,
	tx_trainingsplatz_private_meaningsport tinytext,
	tx_trainingsplatz_private_motto tinytext,
	tx_trainingsplatz_private_sparetime tinytext,
	tx_trainingsplatz_private_dream tinytext,
	tx_trainingsplatz_private_notdisclaim tinytext,
	tx_trainingsplatz_private_book tinytext,
	tx_trainingsplatz_private_weakness tinytext,
	tx_trainingsplatz_private_strength tinytext,
	tx_trainingsplatz_private_ability tinytext,
	tx_trainingsplatz_private_drivecrazy tinytext,
	tx_trainingsplatz_private_laugh tinytext,
	tx_trainingsplatz_private_spendmoney tinytext,
	tx_trainingsplatz_private_description tinytext,
	tx_trainingsplatz_private_pain tinytext,
	tx_trainingsplatz_private_luxury tinytext,
);
