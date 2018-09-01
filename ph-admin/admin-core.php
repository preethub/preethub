<?php
session_start();
require(dirname(dirname(__FILE__)) . '/ph-load.php');
if(is_logged()){	
 if($loggeduser->role != 'Admin'){
 header("location: $site_url");
 } 
}else{
header("location: $site_url");
}
require('functions.php');
