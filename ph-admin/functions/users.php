<?php 

$users_data = $db->query("SELECT * FROM `". PH_PREFIX ."users`");   

if(isset($_POST['add_user'])){

$username = $db->escape($_POST['username']);

$password = $db->escape($_POST['password']);

$email = $db->escape($_POST['email']);

// attempt insert query execution

$sql = "INSERT INTO ". PH_PREFIX ."users (role, email, username, password) VALUES ('Author', '$email', '$username', '$password')";

if($db->query($sql) === TRUE){

$echo = "Records added successfully.";

} else{

$echo = "ERROR: Could not able to execute $sql. ". mysqli_error($db->link);
}
}
