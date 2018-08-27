
<?php
 $login = new login;

if(is_logged()){

$user = $login->userdata();

}

if($_url[0] == "signup"){	
	
$signup = new signup;

$signup->signup();

$title = "Signup - $site_name";

}elseif($_url[0] == "login"){

if(!empty($_SESSION['username'])){
header("location: $site_url");
}

$title = "Login - $site_name";
	
}elseif($_url[0] == "index"){
	
$index = new index;	

if(empty($_url[1])){

$currentpage = '1';
	
}else{

$currentpage = $_url[1];

}

$posts = $index->getposts($currentpage, $posts_per_page);

$totalpost = $db->count("SELECT `id` FROM `". PH_PREFIX ."posts`");
	

$title = "$site_name";
	
}elseif($_url[0] == "post"){
	
$posts = new post;
	
$post = $posts->getpost($_url[1]);

$comment = new comment($_url[1],$db);

$comments = $comment->getcomments();

if(!empty($_SESSION['username'])){

$comment->add_comment($user->id);

}
$title = "$post->name - $site_name";
	
}
