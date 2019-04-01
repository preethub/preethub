<?php

 /*--------------
 * Setup 
 * Preethub
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * github.com/preethub/preethub
 *-------------*/


$config_sample = '
<?php
// Preethub 
// Version 0.3 

/* Mysql Database Hostname */
define("DB_HOST", "Localhost");

/* Mysql Database Usename */
define("DB_USER","Dbuser");

/*  Mysql Database Name  */
define("DB_NAME","Dbname");

/* Mysql Database Password */
define("DB_PASS","Dbpass");

/* Database Table Prefix */
define("TABLE_PREFIX","ph_");
';


function create_config_file(){
	
global	$config_sample;
	
	$replace = array('/Dbhost/','/Dbuser/','/Dbname/','/Dbpass/','/ph_/');
	
	$config = array(DB_HOST,DB_USER, DB_NAME,DB_PASS,TABLE_PREFIX);
	
$content =	preg_replace($replace,$config,$config_sample);
	
$fp = fopen('ph-config.php','w');   
	
fwrite($fp,trim($content));

fclose($fp);		

}

	
	/* Tables Structure */
	$tables_structure = "CREATE TABLE $phdb->pages (
	`page_id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) NOT NULL,
	`page_name` varchar(256) NOT NULL,
	`content` longtext NOT NULL,
	`publish` varchar(256) NOT NULL,
	`page_date` timestamp NOT NULL DEFAULT current_timestamp(),
 PRIMARY KEY (`page_id`), 
  KEY `user_id` (`user_id`) 
  )ENGINE=InnoDB DEFAULT CHARSET=utf8;  
	CREATE TABLE $phdb->users (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `role` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE $phdb->config (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(256) NOT NULL,
  `config_value` longtext NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

  
