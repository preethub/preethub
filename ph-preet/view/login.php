
 <?php require 'temp/header.php'; ?>
 <div class="card">
<h3>Login</h3>
<?php echo $ph_class->displayerrors(); 
?>
  <form action="" method="post">
    <label for="fname">User Name</label>
    <input type="text" id="fname" name="username" placeholder="Your name..">
    <label for="lname">Password</label>
    <input type="text" id="lname" name="password" placeholder="Your last name..">
    <input type="submit" value="Login" name="login">
  </form>
</div>
<?php require 'temp/footer.php';  ?>
</body>
</html>
