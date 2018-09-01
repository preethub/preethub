<?php

if(!isset($_url[0])){
  $_url[0] = 'index';  
}

if(!file_exists(get_url($_url[0]))){
  $_url[0] = 'index';
}
$ph_class->login();

if($_url[0] == "signup"){	

if(is_logged()){
header("location: $site_url");
}

$ph_class->signup();

$page_title = "Signup - $site_name";

}elseif($_url[0] == "login"){

if(is_logged()){
header("location: $site_url");
}

$page_title = "Login - $site_name";
	
}elseif($_url[0] == "index"){
		
if(empty($_url[1])){

$currentpage = '1';
	
}else{

$currentpage = $_url[1];

}

$posts = $ph_class->get_posts();

$totalpost = $ph_class->total_post();

$page_title = "$site_name";
	
}elseif($_url[0] == "post"){

if($ph_class->check_postid($_url[1])){
	
$post = $ph_class->get_one_post();

$comments = $ph_class->getcomments();

if(is_logged()){

$ph_class->add_comment($loggeduser->id);

}
$page_title = "$post->name - $site_name";
}else{
header("location: $site_url");  }	
}
