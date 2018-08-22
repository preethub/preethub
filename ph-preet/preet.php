<?php

// define ROOTPATH
if ( !defined('ROOTPATH') )
	define('ROOTPATH', dirname(__FILE__) . '/');
	
		// define ABSPATH
	if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(dirname(__FILE__)) . '/');


//ph variable 
//	$ph = new stdClass();


require('system/loader.php');

require ABSPATH .'/ph-config.php';

// db connection
$db = new db($db_host,$db_user,$db_pass,$db_name);

require('system/settings.php');

require('system/url.php');

require('system/assign.php');

require('system/pagination.php');


require('system/getfile.php');
