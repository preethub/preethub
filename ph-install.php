 <?php

 /*--------------
 * Ph-install file
 * Preethub
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * github.com/preethub/preethub
 *-------------*/


if(file_exists('ph-config.php')){
	require 'ph-config.php';
	require 'ph-preet/phdb.php';
	
	if($phdb->query("SELECT * FROM $phdb->config")){
		die('You have already installed successfully Preethub. If you want to make any change in configuration, login into admin panel');
	}
	
	
}


?>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Preethub Installer</title>
		
		<link rel="stylesheet" href="ph-admin/style/admin.css">	
	</head>
	<body>
		<div class="installerlogo">
		<span>Preethub Installer</span> </div>
	<div class="installer">	
	<div class="widget">
	<div class="card">
<?php

if(isset($_GET['step'])){

$step = (int) $_GET['step'];
	
	if($step == 1){
		
    // Test the db connection.

define('DB_HOST', $_POST['host']);
define('DB_USER', $_POST['user']);
define('DB_NAME', $_POST['name']);
define('DB_PASS', $_POST['pass']);
define('TABLE_PREFIX', $_POST['prefix']);

    // We'll fail here if the values are no good.

require('ph-preet/phdb.php');

require_once('ph-preet/install-setup.php');

create_config_file();	


	?>	
<p>	
Connection to the database server and database you specified was successful. 
	</p>
	Tables have been created.


<p>
Before we begin we need a little bit of information. Do not worry, you can always change these later.
</p>

<form action='?step=2' method='post'>
<h3>blog details</h3>
blog name<br/>
<input type='text' name='site_name' value='Preethub'>
<br/>
blog description<br/>
<input type='text' name='site_desc' value='My new preethub blog'>
<br/>

<h3>Administrator Account Detail</h3>
Admin username<br/>
<input type='text' name='adminusername'>
<br/>
Admin email<br/>
<input type='text' name='adminemail'>
<br/>
Admin password<br/>
<input type='text' name='adminpass'>
<br/>

<br/><input type='submit' value='Submit'>
</form>

<?php		
	}elseif($step == 2){
require_once('ph-preet/install-setup.php');

$tables_array = explode(";",$tables_structure);
	
	foreach($tables_array as $table_array){
		$phdb->query($table_array);
	}

$url = preg_replace('|/ph-install.php?.*|i', '', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
echo $url;

	
	$phdb->query("INSERT INTO $phdb->pages (`page_id`, `user_id`, `page_name`,`content`) VALUES ('1', '1', 'Sat Shri Akal', '<b>Sat Sri Akal </b> is a Jaikara (lit. Call of Victory) now used, often, as a greeting by the followers of the Sikh religion. It is the second half of the Sikh Clarion call, given by the Tenth guru, Guru Gobind Singh, \"Bole So Nihal, Sat Sri Akal\", one will be blessed eternally who says that God is the ultimate truth.');");
	
	$phdb->query("INSERT INTO $phdb->config (`config_id`, `config_name`, `config_value`) VALUES
('1', 'site_url', '".$url."'), ('2', 'site_name', '".$_POST['site_name']."'), ('3', 'site_description', '".$_POST['site_desc']."'), ('4', 'site_admin', '".$_POST['adminusername']."'), ('5', 'site_index', '1'), ('6', 'active_plugins', 'a:0:{}');");

$options = array(
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    'cost' => 12,
  );
  $password_hash = password_hash($_POST['adminpass'], PASSWORD_BCRYPT, $options);


$phdb->query("INSERT INTO $phdb->users (`user_id`, `username`, `email`, `role`, `password`) VALUES ('1', '".$_POST['adminusername']."', '".$_POST['adminemail']."', 'Admin', '".$password_hash."');")


?>		
<p>	
Preethub has successfully been installed and configured correctly.
</p>
<p>
The Preethub Group thanks you for your support in installing our software and we hope to see you around the <a href="http://forum.preethub.com">Community Forums</a> if you need help or wish to become a part of the Preethub community.
</p>

<p>
You may now proceed to your <a href="ph-admin">Admin Panel</a>.
</p>

<?php		
	}	else{
		header('location: ph-install.php');
	}
	
}else{
	
	
	?>	
<p>		Welcome to preethub. Before getting started, we need some information on the database. You will need to know the following items before proceeding.
		<p><br>
	<form action='ph-install.php?step=1' method='post'>

Database Host<br/><input type='text' name='host' value='localhost'><br/>
Database User<br/><input type='text' name='user'><br/>
Database Password<br/><input type='text' name='pass'><br/>
Database Name<br/><input type='text' name='name'><br/>	
Table Prefix<br/><input type='text' name='prefix' value="ph_"><br/>	
		<br/><input type='submit' value='Submit'>
</form>
	<?php
}
?>
</div>
</div>
</div>
	</body>
</html>
