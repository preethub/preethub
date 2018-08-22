<?php

/*------------->>>>>>>>>>>>

--> LOADER FILE

//------------->>>>>>>>>>>>*/

spl_autoload_register('myAutoloader'); 

function myAutoloader($className){ 

$path = ROOTPATH. 'includes/'; 

include $path .$className.'.class.php'; 

} 

//------------->>>>>>>>>>>>
