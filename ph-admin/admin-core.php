<?php
session_start();
require(dirname(dirname(__FILE__)) . '/preet.php');
if(is_logged()){	
 if(loggeduser()->role != 'Admin'){
 header('location:' . get_config('site_url'));
 } 
}else{
header('location:' . get_config('site_url'));
}
require('functions/functions.php');

$admin_menu['Dashboard'] = array(
 'url' => 'index.php',
 'icon' => 'fa-pie-chart');

$admin_menu['Users'] = array(
'url' => 'manage.php?type=user',
'icon' => 'fa-user');

$admin_menu['Pages'] = array(
'url' => 'manage.php?type=page',
'icon' => 'fa-bar-chart');

$admin_menu['Plugin Manager'] = array(
 'url' => 'plugins.php',
'icon' => 'fa-pie-chart');

$admin_menu['Settings'] = array(
'url' => 'settings.php',
'icon' => 'fa-pie-chart');

$admin_submenu['Pages'][] = array(
'name' => 'Add new',
'url' => 'add-new.php?type=page');
      
$admin_submenu['Users'][] = array(
'name' => 'Add new',
'url' => 'add-new.php?type=user');  
