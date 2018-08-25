<?php
/* -----------------@-----------------------------
*Preethub
------------------------------------------------*/
session_start();

require(dirname(__FILE__) . '/ph-load.php');

$login = new login;

$user = $login->userdata();
	
if($user->role != 'Admin'){
	header("location: $site_url");
}

