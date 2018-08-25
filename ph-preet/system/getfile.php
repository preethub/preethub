<?php


if($_url[0] == "signup"){
	
$signup = new Signup();

$signup->signup();

$title = "Signup - $site_name";
	
}elseif($_url[0] == "login"){
	
$login = new login;

$login->login();

if(!empty($_SESSION['username'])){
	header("location: index.php");
}

$title = "Login - $site_name";
	
}elseif($_url[0] == "index"){
	
if(empty($_url[1])){

$currentpage = '1';
	
}else{

$currentpage = $_url[1];

}
	
$index = new index;	

$posts = $index->getposts($currentpage, $posts_per_page);

$totalpost = $db->count("SELECT `id` FROM `". PH_PREFIX ."posts`");
	
$login = new login;

$login->login();
	
$title = $site_name;
	
}elseif($_url[0] == "post"){
	
$posts = new post;
	
$post = $posts->getpost($_url[1]);
	
$login = new login;

$login->login();
	
$title = "$post->name - $site_name";
}
