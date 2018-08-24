<?php

// preethub

// load file - Version 0.1


// check config file
if(file_exists('ph-config.php')){
require ('ph-config.php');
}else{
	header('Location: ph-install.php');
}

require('ph-preet/preet.php');



?>
