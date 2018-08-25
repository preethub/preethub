<?php

// define ROOTPATH
if ( !defined('ROOTPATH') )
define('ROOTPATH', dirname(__FILE__) . '/');
	
// define ABSPATH
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(dirname(__FILE__)) . '/');


require('system/loader.php');

// db connection
$db = new db(DB_HOST,DB_USER,DB_PASS,DB_NAME);

require('system/settings.php');

require('system/url.php');

require('system/assign.php');

require('system/pagination.php');

require('system/getfile.php');
