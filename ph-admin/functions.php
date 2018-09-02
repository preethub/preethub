<?php


$total_users = $db->count("SELECT `id` FROM `". PH_PREFIX ."users`");

$total_posts = $db->count("SELECT `id` FROM `". PH_PREFIX ."posts`");

$total_comments = $db->count("SELECT `comment_id` FROM `". PH_PREFIX ."comments`");


function get_messages()
{
       
        if( !empty( $_SESSION['messageinfo']) )
        {
   $message = $_SESSION['messageinfo'];   
            unset($_SESSION['messageinfo']); 
            
          return $message;             
        }
       
    
    }

function add_message($msg){

$_SESSION['messageinfo'] = $msg;

}

$posts = $db->select("SELECT * FROM ". PH_PREFIX ."posts");

if(isset($_GET['deletepost'])){
	
	$id = $_GET['deletepost'];
	
	$delete = "DELETE FROM ". PH_PREFIX ."posts WHERE id='$id'";
	
	$delete2 = "DELETE FROM ". PH_PREFIX ."comments WHERE comment_post_id='$id'";
	
	if($db->query($delete) && $db->query($delete2) === TRUE){	
		add_message('Post successfully Deleted');
		
	header('location: posts.php');
	exit();
	}	
}

if(isset($_GET['deleteuser'])){
	
	$id = $_GET['deleteuser'];
	
	$delete = "DELETE FROM ". PH_PREFIX ."users WHERE id='$id'";
	
	$delete2 = "DELETE FROM ". PH_PREFIX ."posts WHERE user_id='$id'";	
	
	if($db->query($delete) && $db->query($delete2)== TRUE){
		
	add_message('User successfully Deleted');	
		
	header('location: users.php');
	exit();
	}
	
}


if(isset($_POST['addpost'])){
	
	$pname = $db->escape($_POST['pname']);
	
	$pcontent = $db->escape($_POST['pcontent']);
	
	
	$pimage = basename($_FILES['pimage']['name']);
	
	$target_dir = "../ph-uploads/";

 $target = $target_dir . basename($_FILES["pimage"]["name"]);
	
	
	$query = "INSERT INTO ". PH_PREFIX ."posts(name, user_id, content, image) VALUES ('$pname', '$user->id', '$pcontent', '$pimage')";
	
	if($db->query($query) === TRUE){
		
		add_message('Post successfully added');
		
		move_uploaded_file($_FILES['pimage']['tmp_name'], $target);
		
	header('location: add_post.php');
	exit();	
		
	}else{
		
		add_message('ERROR: Could not able to execute.');
		
}
					
}
$udatas = $db->select("SELECT * FROM ". PH_PREFIX ."users");

if(isset($_POST['add_user'])){

$username = $db->escape($_POST['username']);

$password = $db->escape($_POST['password']);

$email = $db->escape($_POST['email']);


$options = array(
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    'cost' => 12,
  );
  $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);	
  
// attempt insert query execution

$sql = "INSERT INTO ". PH_PREFIX ."users (role, email, username, password) VALUES ('Author', '$email', '$username', '$password_hash')";

if($db->query($sql) === TRUE){

add_message('User added successfully.');

header('location: add_user.php');
	exit();

} else{

add_message('ERROR: Could not able to execute.');
}
}


if(isset($_POST['settings'])){
	
	$siteurl = $db->escape($_POST['siteurl']);
	
	$sitename = $db->escape($_POST['sitename']);
	
	$sitedesc = $db->escape($_POST['sitedesc']);
	
	$postsperpage = $db->escape($_POST['postsperpage']);
	
	$sql1 = "UPDATE ". PH_PREFIX ."config SET value='$siteurl' Where name='site_url'";
	
		$sql2 = "UPDATE ". PH_PREFIX ."config SET value='$sitename' Where name='site_name'";
		
		$sql3 = "UPDATE ". PH_PREFIX ."config SET value='$sitedesc' Where name='site_description'";	
	
			$sql4 = "UPDATE ". PH_PREFIX ."config SET value='$postsperpage' Where name='posts_per_page'";	
	
	
	if($db->query($sql1) && $db->query($sql2) && $db->query($sql3) && $db->query($sql4) === TRUE){
		
		add_message('Successfully settings updated');
		
		header('location: settings.php');
	exit();
	}else{
		
		add_message('Unable to Update data');
	}
	
}
