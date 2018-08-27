<?php require('temp/header.php'); ?>

 <div class="card">

<h3> register </h3>
<?php  echo $signup->displayerrors(); 
?>
  <form action="signup" method="post">
    <label for="phuname">User Name</label>
    <input type="text" id="phuname" name="username" placeholder="Your username..">

<label for="phemail">Email</label>
    <input type="text" id="phemail" name="email" placeholder="Your email..">

    <label for="phpass">Password</label>
    <input type="text" id="phpass" name="password" placeholder="Your password..">
  
    <input type="submit" value="signup" name="signup">
  </form> </div>
<?php require('temp/footer.php');
?>

</body>
</html>
