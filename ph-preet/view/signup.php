<?php

$signup = new Signup();

$signup->signup();


require('temp/header.php');
?>




<h3> register form</h3>
<?php $signup->displayerrors(); 
?>
<div>
  <form action="" method="post">
    <label for="phuname">User Name</label>
    <input type="text" id="phuname" name="username" placeholder="Your username..">

<label for="phemail">Email</label>
    <input type="text" id="phemail" name="email" placeholder="Your email..">

    <label for="phpass">Password</label>
    <input type="text" id="phpass" name="password" placeholder="Your password..">
  
    <input type="submit" value="signup" name="signup">
  </form>
</div>

</body>
</html>
