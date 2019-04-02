<?php

/*--- FUNCTION TOTAL USERS ---*/
function total_users(){
	global $phdb;
$totalusers = $phdb->count("SELECT `user_id` FROM `". TABLE_PREFIX ."users`");
return $totalusers;
}

/*--- FUNCTION TOTAL PAGES ---*/
function total_pages(){
	global $phdb;
	$totalpages = $phdb->count("SELECT `page_id` FROM $phdb->pages");
	return $totalpages;
}

/*--- FUNCTION GET USERS ---*/
function get_users(){
	global $phdb;
$users = $phdb->select("SELECT * FROM $phdb->users");
return $users;
}

/*--- FUNCTION GET PAGES ---*/
function get_pages(){
	global $phdb;
$pages = $phdb->select("SELECT * FROM $phdb->pages");
return $pages;
}

/*---FUNCTION DELETE PAGE ---*/
function delete_page(){	
global $phdb;
if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$delete = "DELETE FROM $phdb->pages WHERE page_id='$id'";		
	if($phdb->query($delete) === TRUE){	
		add_message('Page successfully Deleted');		
	header('location: manage.php?type=page');
	exit(0); } }	 }

/*---  FUNCTION DELETE USER ---*/
function delete_user(){
	global $phdb;
	if(isset($_GET['delete'])){
	$id = $_GET['delete'];	
	$delete = "DELETE FROM $phdb->users WHERE user_id='$id'";	
	$delete2 = "DELETE FROM ". TABLE_PREFIX ."pages WHERE user_id='$id'";			
	if($phdb->query($delete) && $phdb->query($delete2) == TRUE){		
	add_message('User successfully Deleted');			
	header('location: manage.php?type=user');
	exit(0); } }	 }

/*---  FUNCTION ADD PAGE---*/
function add_page($user){
	global $phdb;
if(isset($_POST['addpage'])){
		$pname = $phdb->escape($_POST['pname']);
		$pcontent = $phdb->escape($_POST['pcontent']);
		$query = "INSERT INTO $phdb->pages(page_name, user_id, content, publish) VALUES ('$pname', '$user', '$pcontent', 'yes')";	
	if($phdb->query($query) === TRUE){
add_message('Post successfully added');		
	header('location: add-new.php?type=page'); 	exit(0);			
	}else{		
	add_message("ERROR: Could not able to execute." . mysqli_error($phdb->link));		} } }
	
	/*---  FUNCTION EDIT PAGE---*/
function edit_page($id){
	global $phdb;
if(isset($_POST['editpage'])){
		$pname = $phdb->escape($_POST['pname']);
		$pcontent = $phdb->escape($_POST['pcontent']);
		
		$query = "UPDATE $phdb->pages SET page_name='$pname' Where page_id='$id'";
		
		$query2 = "UPDATE $phdb->pages SET content='$pcontent' Where page_id='$id'";
		
	if($phdb->query($query) && $phdb->query($query2) === TRUE){
add_message('Page successfully updated');		
	header("location: edit.php?type=page&id=$id"); 	exit(0);			
	}else{		
	add_message("ERROR: Could not able to execute." . mysqli_error($phdb->link));		} } }

/*---  FUNCTION ADD USER ---*/
function add_user(){
	global $phdb;
if(isset($_POST['add_user'])){
$username = $phdb->escape($_POST['username']);
$password = $phdb->escape($_POST['password']);
$email = $phdb->escape($_POST['email']);
$options = array(
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    'cost' => 12,  );
  $password_hash = password_hash($password, PASSWORD_BCRYPT, $options);	  
$sql = "INSERT INTO $phdb->users (role, email, username, password) VALUES ('Author', '$email', '$username', '$password_hash')";
if($phdb->query($sql) === TRUE){
add_message('User added successfully.');
header('location: add-new.php?type=user'); 	exit(0);
} else{
add_message('ERROR: Could not able to execute.'); } } }

/*--- FUNCTION SETTINGS ---*/
function settings(){
global $phdb; 
if(isset($_POST['settings'])){	
	$siteurl = $phdb->escape($_POST['siteurl']);	
	$sitename = $phdb->escape($_POST['sitename']);	
	$sitedesc = $phdb->escape($_POST['sitedesc']);	
	$sql1 = "UPDATE $phdb->config SET config_value='$siteurl' Where config_name='site_url'";	
		$sql2 = "UPDATE $phdb->config SET config_value='$sitename' Where config_name='site_name'";
		$sql3 = "UPDATE $phdb->config SET config_value='$sitedesc' Where config_name='site_description'";		
	if($phdb->query($sql1) && $phdb->query($sql2) && $phdb->query($sql3) === TRUE){
	add_message('Successfully settings updated');
	header('location: settings.php');
	exit();
	}else{
	add_message('Unable to Update data'); 	} } }
	
	
	
