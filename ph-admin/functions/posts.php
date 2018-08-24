<?php


$posts = $db->select("SELECT * FROM ". PH_PREFIX ."posts");

if(isset($_GET['delete'])){
	
	$id = $_GET['delete'];
	
	$delete = "DELETE FROM ". PH_PREFIX ."posts WHERE id='$id'";
	
	if($db->query($delete) === TRUE){
		
add_message('Sucessfully Post deleted');
	header('location: posts.php');
	}
	
}
function add_message($msg){
	
	
	$_SESSION['flash_message'] = $msg;
	
}

function show_message() { 
if(isset($_SESSION['flash_message'])) {
$message = $_SESSION['flash_message'];  

return $message; 

unset($_SESSION['flash_message']);
} 
return NULL; 
}


if(isset($_POST['addpost'])){
	
	$pname = $db->escape($_POST['pname']);
	
	$pcontent = $db->escape($_POST['pcontent']);
	
	
	$pimage = basename($_FILES['pimage']['name']);
	
	$target_dir = "../ph-uploads/";

 $target = $target_dir . basename($_FILES["pimage"]["name"]);
	
	
	$query = "INSERT INTO ". PH_PREFIX ."posts(name, user_id, content, image) VALUES ('$pname', '$user->id', '$pcontent', '$pimage')";
	
	if($db->query($query) === TRUE){
		
		$errors = "Post successfully added";
		
		move_uploaded_file($_FILES['pimage']['tmp_name'], $target);
		
	}else{
		
		$errors = "ERROR: Could not able to execute $query. ". mysqli_error($db->link);
		
	}
	
	
	
	
	
}
