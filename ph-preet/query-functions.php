<?php

 /*--------------
 * Query functions
 * Preethub
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * github.com/preethub/preethub
 *--------------*/


/*--- FUNCTION GET_PAGE ---*/
function get_page($id = ''){		
global $phdb	;
if(!empty($_GET['p'])){
	$page_id = (int) $_GET['p'];
}elseif(!empty($id)){
$page_id = $id;
}else{
$page_id = get_config('site_index');
}
$query = "SELECT * FROM $phdb->pages Where page_id='$page_id'";
if($page = $phdb->get_row($query)){
		return $page; 		
		}
}
	
/*--- FUNCTION LOGIN ---*/
function login(){
	global $phdb;	
if(isset($_POST['login'])){
$username = $phdb->escape($_POST['username']); 
$password = $phdb->escape($_POST['password']); 
$sql1 = "SELECT * FROM $phdb->users WHERE username = '$username'"; 
$result1 = $phdb->query($sql1);  
 $data = mysqli_fetch_object($result1);
$count1 = mysqli_num_rows($result1); 
// Check result matched 		 
if(empty($username) && empty($password)){
add_message("Username and password Empty");
}elseif(empty($username)){
add_message("Empty Username");
}elseif(empty($password)){
add_message("Empty Password");
}elseif($count1 != 1) { 
 add_message("Username does not match");
} elseif(password_verify($password,$data->password)){
 session_start();
 $_SESSION['username'] = $username; 
header('location:' . get_config('site_url')); 
	}	else {
add_message("Password not match"); 
  } 
 }
}	

/*--- FUNCTION SIGNUP ---*/
function signup(){
	global $phdb;		
	if(isset($_POST['signup'])){			
	$username = $phdb->escape($_POST['username']);			
	$email = $phdb->escape($_POST['email']);			
 $password = $phdb->escape($_POST['password']);			
 $options = array(
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    'cost' => 12,
  );
  $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);				
			$sql1 = "SELECT * FROM $phdb->users Where username='$username'";			
			$sql2 = "SELECT * FROM $phdb->users Where email='$email'";			
			$result1 = $phdb->query($sql1);
 $count1 = mysqli_num_rows($result1);
			$result2 = $phdb->query($sql2);
$count2 = mysqli_num_rows($result2);
if($count1 == 1){	
	add_message("Username already exists");	
}elseif($count2 == 1){	
	add_message("Email already exists");	
}elseif(empty($username)){	
	add_message("Empty Username");
}elseif(empty($email)){		
	add_message("Empty email");
}elseif(empty($password)){		
	add_message("Empty password");
}elseif(!empty($username) || !empty($password) || !empty($email)){	
	$sql3 = "INSERT INTO $phdb->users (username, email, password, role) VALUES ('$username', '$email', '$password_hash', 'Admin')";	
if($phdb->query($sql3) === TRUE){
	add_message('You successfully signed up');	
	header('location: ph-action.php?action=signup'); 	
	 exit(0);
} else{
	add_message("ERROR: Could not able to execute ". mysqli_error($this->db->link));
	}
}else{	
	add_message("empty fields");
   }								
	}
}	
	
/*--- FUNCTION LOGGEDUSER ---*/
function loggeduser(){
global	$phdb;	
$user = $_SESSION['username'];
$query = "SELECT * FROM $phdb->users WHERE username='$user'"; 
$userdata = $phdb->get_row($query);
return $userdata;	
} 

	
/*--- FUNCTION GET_CONFIG ---*/
function get_config($name){
global $phdb;
$result = $phdb->get_row("SELECT * FROM $phdb->config Where config_name='$name'");
if($name === "active_plugins"){
	return unserialize($result->config_value);
 }
return $result->config_value;
}			
	
