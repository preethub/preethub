<?php

if(file_exists('ph-config.php')){
	
	header("location: index.php");
}

?>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Preethub Installer</title>
		<style>
			h6 {
				color:white;
				background-color: #2E2E2E;
				padding: 3px;
				text-align:center;
			}
		</style>
	</head>
	<body>
		<h6>Preethub Installer </h6>
<?php
if($_POST){

$fp = fopen('ph-config.php','w');

$content = '
<?php
// PreetHub
// Version 0.2

/* MySQL database hostname */ 
define("DB_HOST","'.$_POST['host'].'");

/* MySQL database username */
define("DB_USER","'.$_POST['user'].'");

/* MySQL database name */
define("DB_NAME","'.$_POST['name'].'");

/* MySQL database password */
define("DB_PASS","'.$_POST['pass'].'");

/* PreetHub database name Prefix */
define("PH_PREFIX","'.$_POST['prefix'].'");
';

if(!fwrite($fp,trim($content)))
	$error = 1;

fclose($fp);

include "ph-config.php";

include "ph-preet/classes.php";

$db = new db(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
$options = array(
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    'cost' => 12,
  );
  $password_hash = password_hash($_POST['site_pass'], PASSWORD_BCRYPT, $options);

 if(!$db->query("CREATE TABLE IF NOT EXISTS `".$_POST['prefix']."posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT, 
  `user_id` int(11) DEFAULT NULL, 
  `name` varchar(255) NOT NULL, 
  `content` longtext NOT NULL, 
  `views` int(11) NOT NULL DEFAULT 0, 
  `image` varchar(255) DEFAULT NULL, 
  `published` tinyint(1) DEFAULT NULL, 
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(), 
  `updated_at` timestamp NULL DEFAULT NULL, 
  PRIMARY KEY (`id`), 
  KEY `user_id` (`user_id`) 
  )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"))	$error = 1;
 if(!$db->query("INSERT INTO `".$_POST['prefix']."posts` (`id`, `user_id`, `name`, `content`) VALUES ('1', '1', 'Sat Shri Akal', '<b>Sat Sri Akal </b> is a Jaikara (lit. Call of Victory) now used, often, as a greeting by the followers of the Sikh religion. It is the second half of the Sikh Clarion call, given by the Tenth guru, Guru Gobind Singh, \"Bole So Nihal, Sat Sri Akal\", one will be blessed eternally who says that God is the ultimate truth.');"))	$error = 1; 
if(!$db->query("CREATE TABLE IF NOT EXISTS `".$_POST['prefix']."users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `role` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` timestamp NOt NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;"))	$error = 1;
 if(!$db->query("INSERT INTO `".$_POST['prefix']."users` (`id`, `username`, `email`, `role`, `password`) VALUES ('1', '".$_POST['site_admin']."', '".$_POST['site_email']."', 'Admin', '".$password_hash."');"))	$error = 1; 
if(!$db->query("CREATE TABLE IF NOT EXISTS `".$_POST['prefix']."config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"))	$error = 1;
 if(!$db->query("INSERT INTO `".$_POST['prefix']."config` (`id`, `name`, `value`) VALUES
('1', 'site_url', '".$_POST['site_url']."'), ('2', 'site_name', '".$_POST['site_name']."'), ('3', 'site_description', '".$_POST['site_desc']."'), ('4', 'site_admin', '".$_POST['site_admin']."'), ('5', 'posts_per_page', '".$_POST['posts_per_page']."');"))	$error = 1; 
 if(!$db->query("CREATE TABLE IF NOT EXISTS `".$_POST['prefix']."comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT, 
  `comment_user_id` int(11) NOT NULL, 
  `comment_post_id` int(11) NOT NULL, 
  `comment_content` longtext NOT NULL,  
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(), 
  PRIMARY KEY (`comment_id`), 
  )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"))	$error = 1;
	
if($error){
echo "ERROR: Could not able to execute $sql. ". mysqli_error($db->link);
}else {
echo "<h1>Installation Complete</h1>
<meta http-equiv='refresh' content='5; url=index.php'>";

}

}else{

@chmod("ph-uploads",0777);
@chmod("ph-config.php",0666);

echo "<form action='?' method='post'>

Database Host<br/><input type='text' name='host' value='localhost'><br/>
Database User<br/><input type='text' name='user'><br/>
Database Password<br/><input type='text' name='pass'><br/>
Database Name<br/><input type='text' name='name'><br/>
Site Name<br/><input type='text' name='site_name' value='PreetHub'><br/>
Site Description<br/><input type='text' name='site_desc' value='This is a blog'><br/>
Site Url<br/><input type='text' name='site_url' value='http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."'><br/>
Posts per page: <br/><input type='text' name='posts_per_page' value='10'><br/>
Table Prefix: <br/><input type='text' name='prefix' value='ph_'><br/>
Site Admin - Username<br/><input type='text' name='site_admin'><br/>
Site Admin - email<br/><input type='text' name='site_email'><br/>
Site Admin - Password<br/><input type='text' name='site_pass'><br/>
<br/><input type='submit' value='Install'>
</form>";

}
?>
		<h6>Preethub Installer</h6>
	</body>
</html>
