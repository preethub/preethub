<?php


if($_url[0] == "signup"){
	
	
	$signup = new Signup();

$signup->signup();

}elseif($_url[0] == "login"){
	
	$login = new login;

$login->login();

if(!empty($_SESSION['username'])){
	header("location: index.php");
}
	
}elseif($_url[0] == "index"){
	
$index = new index;	

$posts = $index->getposts($_url[1], $posts_per_page);

$totalpost = $db->count("SELECT `id` FROM `". PH_PRIFIX ."posts`");
	
$currentpage = !empty($_url['1']) && ctype_digit($_url['1']) ? $_url[1] : 1;  


	$login = new login;

$login->login();
	
}elseif($_url[0] == "post"){
	
	$post = new post;
	
	$posts = $post->getpost($_url[1]);
	
		$login = new login;

$login->login();
	
}
