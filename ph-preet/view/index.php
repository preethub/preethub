<?php require('temp/header.php'); ?>
<div class="row">
  <div class="leftcolumn"> 
       <?php     if($ph_class->have_post()){   
         foreach ($posts as $post): ?>
         <div class="card">
      <h2><a href="<?php echo $site_url; ?>/post/<?php echo $post->id; ?>"><?php echo $post->name; ?></a></h2>
      <h5>Published - <?php echo $post->created_at; ?></h5> 
    <?php if(!empty($post->image)){ ?>
    <img src="<?php echo $site_url . '/ph-uploads/' . $post->image; ?>" style="width:350px;height:300px;">
    <?php } echo $post->content; ?>
    </div>
    <?php endforeach; }else{ ?>   
   <div class="card">No post</div>
 <?php } echo pagination($site_url, $totalpost, $posts_per_page, $currentpage); 
?>
   </div>
  <div class="rightcolumn">   
  <?php  if(is_logged()){ ?>
     <div class="heading">Links</div>
  <div class="card">
<h4> - <a href="<?php echo $site_url; ?>/logout">Logout</a> </h4>
  <?php   if($loggeduser->role === "Admin"){ ?>  	
 <a href="<?php echo $site_url; ?>/ph-admin"><h4> - Admin Panel</h4></a>
 </div>
  <?php } ?>  
<?php  }else{ ?> 
  <div class="heading">Login</div>
    <div class="card">    
 <h5> <?php echo $ph_class->displayerrors(); ?></h5>    
  <form action="" method="post">
    <label for="fname">User Name</label>
    <input type="text" id="fname" name="username" placeholder="Your name..">
    <label for="lname">Password</label>
    <input type="text" id="lname" name="password" placeholder="Your last name..">
    <input type="submit" value="Login" name="login">
  </form> 
  </div>
  <?php } ?>
  </div>
</div>
<?php require('temp/footer.php'); ?>
