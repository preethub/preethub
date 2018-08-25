<?php

// preethub

// load file - Version 0.1

// check config file
if(file_exists(dirname(__FILE__) . '/ph-config.php')){
require('ph-config.php');
}else{
header("location: ph-install.php"); 
}
require('ph-preet/preet.php');


?>
