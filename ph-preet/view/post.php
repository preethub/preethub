<?php require('temp/header.php');

 ?>

<div class="row">
  <div class="leftcolumn">
  
         <div class="card">
      <h2><?php echo $post->name ?></h2>
      <h5>Published - <?php echo $post->created_at ?></h5> 
    <?php if(!empty($post->image)){ ?>
    <img src="<?php echo $site_url . '/ph-uploads/' . $post->image; ?>" style="width:350px;height:300px;">
    <?php } echo $post->content; ?>  </div>    
  </div>
  <div class="rightcolumn">
    <div class="card">
  <?php  if(empty($_SESSION['username'])){ ?>    
      <h3>Login</h3>
     <h5> <?php echo $login->dispalyerrors(); ?></h5>
  <form action="" method="post">
    <label for="fname">User Name</label>
    <input type="text" id="fname" name="username" placeholder="Your name..">

    <label for="lname">Password</label>
    <input type="text" id="lname" name="password" placeholder="Your last name..">
  
    <input type="submit" value="Login" name="login">
  </form> 
  <?php }else{?>
<h5> - <a href="/logout">Logout</a> <h5>
  <?php $user = $login->userdata();
  if($user->role === 'Admin'){ ?>  	
 - <a href="/ph-admin">Admin Panel</a>
  <?php } 
   } ?>
</div>
  </div>
</div>

<?php require('temp/footer.php'); ?>
