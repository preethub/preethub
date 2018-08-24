<?php
/* -----------------@-----------------------------
*Preethub
------------------------------------------------*/
session_start();


require_once(dirname(dirname(__FILE__)) . '/ph-preet/preet.php');

$login = new login;

$user = $login->userdata();
	
if($user->role != Admin){
	header("location: $site_url");
}

