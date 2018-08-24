<?php

/*===============================

Login Class

Version 0.1

================================*/

class Login {	
			
	public $user = '';
	
	public $password = '';
	
 public $error = array();
	 
 
/*--------------------------------

>>>> * Login Function * <<<<

--------------------------------*/
 
 function login(){
	
	global $db;
	
	global $site_url;
	
	if($_SERVER["REQUEST_METHOD"] == "POST") { 

// Isset()
if(isset($_POST['login'])){
	

$this->user = $db->escape($_POST['username']);

$myusername = $db->escape($_POST['username']);
 
$mypassword = $db->escape($_POST['password']); 
$sql = "SELECT * FROM ". PH_PREFIX ."users WHERE username = '$myusername' and password = '$mypassword'"; 
$result = $db->query($sql); 
$row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
$count = mysqli_num_rows($result); 

// Check result matched 
		 
if($count == 1) { 
 session_start();
 $_SESSION['username'] = $myusername; 
header("location: /ph-admin"); 
	} // Else
	else {
$this->error = "Your Login Name or Password is invalid"; 
} 
}
}	
}

/*--------------------------------

>> * Display Errors Function * <<

--------------------------------*/
function displayerrors() { 
if(empty($this->error)) { 
return ''; 
} 
$errormsg = nl2br(htmlentities($this->error)); 
return $errormsg; 


}

function userdata(){
	
	global $db;
	
	$user = $_SESSION['username'];
	
	$sql1 = "SELECT * FROM ". PH_PREFIX ."users WHERE username='$user'"; 
	
	$userdata = $db->get_row($sql1);
	
	
	return $userdata;
	
}
}
