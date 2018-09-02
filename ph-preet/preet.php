
<?php

/*  PreetHub Version. */
$ph_version = "0.2";

require('classes.php');

// db connection
$db = new db(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
require('general-functions.php');

$_url = get('url');
$_url = array_filter(explode('/', $_url));

require('vars.php');

$ph_class = new ph_class($db);

if(is_logged()){

$loggeduser = $ph_class->loggeduser();

}
