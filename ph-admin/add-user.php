<?php 
require('admin-core.php');
require('admin-header.php');
?>    
      <div class="heading">
         Add Users
        </div>
<div class="card">    
  <?php echo get_messages(); ?>
            <form action="add-user.php" method="post">                   
                  <label for="username">User Name<b> -> (Required)</b> </label>
                  <input name="username" type="text" placeholder="Enter your name" required>
   <label for="email">Email<b>->  (Required)</b></label>
                  <input name="email" type="text" placeholder="Enter your email" required>
            <label for="password">Password</label>
                  <input name="password" type="text" placeholder="Enter Your Password" required>                                 <input type="submit" name="add_user">              
              </form>
            </div>   
<?php require('admin-footer.php'); ?>
