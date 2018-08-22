<?php

if(!empty($_SESSION['username'])){
	header("location: index.php");
}

require 'temp/header.php';
?>

<h3>Using CSS to style an HTML Form</h3>
<?php echo $login->displayerrors(); 
?>
<div>
  <form action="" method="post">
    <label for="fname">User Name</label>
    <input type="text" id="fname" name="username" placeholder="Your name..">

    <label for="lname">Password</label>
    <input type="text" id="lname" name="password" placeholder="Your last name..">
  
    <input type="submit" value="Login" name="login">
  </form>
</div>

</body>
</html>
