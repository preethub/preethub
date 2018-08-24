<?php

Class Signup{
	
/*==============================

 ******    Class Signup  ******
 
 ===============================*/
 
public	$username = '';
	
public 	$password = '';
	
public 	$email = '';
	
public 	$errors = array();
	
	
	public function signup(){
		
		
		global $db;
		
		if(isset($_POST['signup'])){
			
			$this->username = $db->escape($_POST['username']);
			
			$this->email = $db->escape($_POST['email']);
			
			$this->password = $db->escape($_POST['password']);
			
			$sql1 = "SELECT * FROM ". PH_PREFIX ."users Where username='$this->username'";
			
			$sql2 = "SELECT * FROM ". PH_PREFIX ."users Where email='$this->email'";
			
			$result1 = $db->query($sql1);
 $count1 = mysqli_num_rows($result1);

			$result2 = $db->query($sql2);
$count2 = mysqli_num_rows($result2);

if($count1 == 1){
	
	$this->errors = "Username already exists";
	
} elseif($count2 == 1){
	
	$this->errors = "email already exists";
	
}elseif(empty($this->username)){
	
	$this->errors = " Username empty";
}elseif(empty($this->email)){
	
	
	$this->errors = "email empty";
}elseif(empty($this->password)){
	
	
	$this->errors = "empty password";
}elseif(!empty($this->username) || !empty($this->password) || !empty($this->email)){
	
	$sql2 = "INSERT INTO ". PH_PREFIX ."users (username, email, password) VALUES ('$this->username', '$this->email', '$this->password')";

	
if($db->query($sql2) === false){
	
	$this->errors = "ERROR: Could not able to execute $sql. ". mysqli_error($db->link);
} else{

header("location: index.php"); 
	}
}else{
	
	$this->errors = "empty fields";
}
	
		
		
			
		}
		
		
		
	}
	
	/*-----------------------------
	
*** 	Function display errors ***
	
	------------------------------*/
	
	
	function displayerrors(){
		
		if(empty($this->errors)){
			
 return '';
 	}
		
		return $this->errors;
		
	}
	
/*--------------------------------

  ******   Class End  *******
  
  ------------------------------*/
	
}


?>
