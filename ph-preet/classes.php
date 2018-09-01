<?php

class db {
        var $link = null;

        function __construct($db_host,$db_user,$db_pass,$db_name){
            
            $this->link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            
            if (!$this->link) die('Connect Error (' . mysqli_connect_errno() . ') '.mysqli_connect_error());
            
            mysqli_select_db($this->link, $db_name) or die(mysqli_error($this->link));
            
            return true;
        }
       function query($q){

            return mysqli_query($this->link,$q);

        }
        function count($q){
            $result = mysqli_query($this->link,$q);

            return mysqli_num_rows($result);

        }
       function select($q){
        
            $result = mysqli_query($this->link,$q);
                        if(mysqli_num_rows($result) > 0)

                while($res = mysqli_fetch_object($result))
                
                    $arr[] = $res;
                
            if($arr) return $arr;
            
            return false;
        }
       function get_row($q){
            $result = mysqli_query($this->link,$q);

            if(mysqli_num_rows($result) == 1)

            $arr = mysqli_fetch_object($result);
                            
            if($arr) return $arr;
            
            return false;
        }
        function escape($str){

            return mysqli_real_escape_string($this->link,$str);
        }
        function insert($q){

            if(mysqli_query($this->link,$q))
                return mysqli_insert_id($this->link); 
            return false;
        }
         }

class ph_class{

public $db = null;
public $postid = null;
public $errors = array();

function __construct($dbcon){
	$this->db = $dbcon;	
}

function total_post(){
	$total_post = $this->db->count("SELECT `id` FROM `". PH_PREFIX ."posts`");
	
	return $total_post;
	
}
function have_post(){

$total_post =  $this->total_post();

if($total_post > 0){
	return TRUE;
}
return FALSE;			
}

function get_posts(){
	global $currentpage;
	global $posts_per_page;
	$limit = site_info('posts_per_page');
	
$page = ($currentpage - 1) * $limit;
	
 if($this->have_post()){
$get_posts =	$this->db->select("SELECT * FROM ". PH_PREFIX ."posts LIMIT $page, $limit");
			
	return $get_posts; }
}

function check_postid($postid){
	
	$this->postid = $postid;
	
	$query = "SELECT * FROM ". PH_PREFIX ."posts Where id='$postid'";
	if($this->db->count($query) === 1){ return TRUE;
}
return FALSE;
}

function get_one_post(){		
	
$query = "SELECT * FROM ". PH_PREFIX ."posts Where id='$this->postid'";
	if($this->db->count($query) === 1){
		$posts = $this->db->get_row($query);
		return $posts;
			}else{
		return FALSE;

		 }		
	}
		
function have_comments(){
							
		if($this->db->count("SELECT `comment_id` FROM `". PH_PREFIX ."comments` Where comment_post_id='$this->postid'") > 0){
	return TRUE;
	return FALSE;
	}				
		}
		
	function getcomments(){
							
	$query = "SELECT * FROM ". PH_PREFIX ."comments Where comment_post_id='$this->postid'";
	
if($this->have_comments()){	
	
 $comments = $this->db->select($query);
		
	return $comments;					
		}
	}		
	
	function add_comment($userid){
				
global $site_url;
				if(isset($_POST['addcomment'])){
			
$comment = $this->db->escape($_POST['comment']);
			
if(empty($comment)){
								$this->errors = "Empty comment";										
			}elseif($this->db->query("INSERT INTO `". PH_PREFIX ."comments`(comment_user_id, comment_post_id, comment_content) VALUES ('$userid', '$this->postid', '$comment')") === TRUE){ 

 $link = "$site_url/post/$this->postid";	
 header("location: $link");	
			
}else{
				
$this->errors = "ERROR: Could not able to execute $query. ". mysqli_error($db->link);																														
}						
}
	}
	
function login(){
	
	global $site_url;

// Isset()
if(isset($_POST['login'])){


$username = $this->db->escape($_POST['username']);
 
$password = $this->db->escape($_POST['password']); 


$sql1 = "SELECT * FROM ". PH_PREFIX ."users WHERE username = '$username'"; 

$result1 = $this->db->query($sql1);  

 $data = mysqli_fetch_object($result1);

$count1 = mysqli_num_rows($result1); 

// Check result matched 		 
if(empty($username) && empty($password)){

$this->errors = "Username and password Empty";

}elseif(empty($username)){

$this->errors = "Empty Username";

}elseif(empty($password)){

$this->errors = "Empty Password";

}elseif($count1 != 1) { 

 $this->errors = "Username does not match";
} elseif(password_verify($password,$data->password)){

 session_start();
 $_SESSION['username'] = $username; 
header("location: $site_url"); 
	} // Else
	else {
$this->errors = "Password not match"; 
} 
}
}	

function loggeduser(){
	
	$user = $_SESSION['username'];
	
	$sql1 = "SELECT * FROM ". PH_PREFIX ."users WHERE username='$user'"; 
	
	$userdata = $this->db->get_row($sql1);
	
	
	return $userdata;
	
} 

public function signup(){
		
		if(isset($_POST['signup'])){
			
			$username = $this->db->escape($_POST['username']);
			
			$email = $this->db->escape($_POST['email']);
			
$password = $this->db->escape($_POST['password']);
			
 $options = array(
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    'cost' => 12,
  );
  $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);				
			$sql1 = "SELECT * FROM ". PH_PREFIX ."users Where username='$this->username'";
			
			$sql2 = "SELECT * FROM ". PH_PREFIX ."users Where email='$this->email'";
			
			$result1 = $this->db->query($sql1);
 $count1 = mysqli_num_rows($result1);

			$result2 = $this->db->query($sql2);
$count2 = mysqli_num_rows($result2);

if($count1 == 1){
	
	$this->errors = "Username already exists";
	
} elseif($count2 == 1){
	
	$this->errors = "email already exists";
	
}elseif(empty($username)){
	
	$this->errors = " Username empty";
}elseif(empty($email)){
	
	
	$this->errors = "email empty";
}elseif(empty($password)){	
	
	$this->errors = "empty password";
}elseif(!empty($username) || !empty($password) || !empty($email)){
	
	$sql3 = "INSERT INTO ". PH_PREFIX ."users (username, email, password, role) VALUES ('$this->username', '$this->email', '$password_hash', 'Author')";

	
if($this->db->query($sql3) === TRUE){
	
header("location: index.php"); 
} else{
	$this->errors = "ERROR: Could not able to execute $sql. ". mysqli_error($this->db->link);

	}
}else{
	
	$this->errors = "empty fields";
}								
	}
	}		
	
	function displayerrors() { 
if(empty($this->errors)) { 
return ''; 
} 
$errormsg = nl2br(htmlentities($this->errors)); 
return $errormsg; 
} 
	
}
