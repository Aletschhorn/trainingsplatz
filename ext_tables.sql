CREATE TABLE tx_trainingsplatz_domain_model_training (
	author int(11) unsigned DEFAULT '0' NOT NULL,
	leader int(11) unsigned DEFAULT '0' NOT NULL,
	creation_date datetime DEFAULT NULL,
	last_change datetime DEFAULT NULL,
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
);

CREATE TABLE tx_trainingsplatz_domain_model_intensity (
	title varchar(255) DEFAULT '' NOT NULL,
	description varchar(255) DEFAULT '' NOT NULL,
	picture varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_trainingsplatz_domain_model_sport (
	title varchar(255) DEFAULT '' NOT NULL,
	description varchar(255) DEFAULT '' NOT NULL,
	picture varchar(255) DEFAULT '' NOT NULL,
	picture_guided varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_trainingsplatz_domain_model_answer (
	creation_date datetime DEFAULT NULL,
	change_date datetime DEFAULT NULL,
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
	hash varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_trainingsplatz_domain_model_infomail (
	training int(11) unsigned DEFAULT '0' NOT NULL,
	status tinyint(4) unsigned DEFAULT '0' NOT NULL,
	status_date datetime DEFAULT NULL,
	mail_subject varchar(255) DEFAULT '' NOT NULL,
	mail_body text NOT NULL,	
	send_user int(11) unsigned DEFAULT '0' NOT NULL,
	send_receiver int(11) unsigned DEFAULT '0' NOT NULL,
);

CREATE TABLE tx_trainingsplatz_domain_model_motivation (
	title varchar(255) DEFAULT '' NOT NULL,
);

CREATE TABLE tx_trainingsplatz_domain_model_template (
	title varchar(255) DEFAULT '' NOT NULL,
	sport int(11) unsigned DEFAULT '0',
	intensity int(11) unsigned DEFAULT '0',
	guided tinyint(1) unsigned DEFAULT '0' NOT NULL,
	templatetext text NOT NULL,
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
