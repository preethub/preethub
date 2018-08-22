<?php

// preethub

// load file - Version 0.1


require('ph-preet/preet.php');

// check config file
if(file_exists('ph-config.php')){
require ('ph-config.php');
}else{
	header('Location: /ph-install.php');
}


	



?>
