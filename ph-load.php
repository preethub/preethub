<?php
// preethub
// load file 
if(file_exists(dirname(__FILE__) . '/ph-config.php')){
require('ph-config.php');
}else{
header("location: ph-install.php"); }
require('ph-preet/preet.php');
?>
