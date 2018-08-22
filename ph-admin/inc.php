<?php

session_start();

$ph = new stdClass();

require_once(dirname(dirname(__FILE__)) . '/ph-config.php');


require_once(dirname(dirname(__FILE__)) . '/ph-preet/includes/db.class.php');

// db connection
$db = new db($db_host,$db_user,$db_pass,$db_name);

require_once(dirname(dirname(__FILE__)) . '/ph-preet/system/settings.php');

	$usersession = $_SESSION['username'];
	
	$userquery = "SELECT * FROM ". PH_PRIFIX ."users WHERE username='$usersession'"; 
	
	$user = $db->get_row($userquery);
	
if($user->role != Admin){
	header("location: $site_url");
}
