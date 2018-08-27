<?php


function addcss($css){
	
 global $site_url;	
 
 echo '<link rel="stylesheet" type="text/css" href="';
	
echo $site_url . '/ph-preet/view/style/css/' .$css .'">';		

}


function is_logged(){

if(!empty($_SESSION['username'])){

 return TRUE;
 }else{
 return FALSE;
 }
 }




$_url = get('url');

$url2 = get('url');
$_url = array_filter(explode('/', $_url));
if(!isset($_url[0])){
  $_url[0] = 'index';
  
}
if(!file_exists(view($_url[0]))){
  header("Location: ", 'index.php');
  $_url[0] = 'index';
}
