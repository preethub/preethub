<?php require('temp/header.php');
 ?>
<div class="row">
  <div class="leftcolumn">       
         <div class="card">
<h2><?php echo $post->name ?></h2>
      <h5>Published - <?php echo $post->created_at ?></h5> 
<?php if(!empty($post->image)){ ?>
  <img src="<?php echo $site_url . '/ph-uploads/' . $post->image; ?>" style="width:1000px;height:100px;">
    <?php } echo $post->content; ?>  </div>
  <div class="heading">Comments</div>
 <?php  if($ph_class->have_comments()){ 
   foreach ($comments as $comment): ?>  
     <div class="card">
 <?php  $cuser = $db->get_row("SELECT * FROM `". PH_PREFIX ."users` WHERE id='$comment->comment_user_id'"); ?>   
  <div class="imge"><img src="<?php echo $site_url ?>/ph-preet/view/style/images/default-avatar.png"style="width:35px;height:30px;"></div>
<b><?php  echo  $cuser->username; ?></b> <br><?php echo $comment->created_at; ?>  <br><br>
       <?php echo $comment->comment_content; ?>  
      </div>
   <?php endforeach;   }else{  ?>     
    <div class="card">
    No Comments.
    </div>
    <?php } ?>     
     <div class="card"> 
  <?php  if(is_logged()){     ?>            
  <form action="" method="post">
<b>Comment</b><br/><br>   
            <textarea name="comment" rows="4" placeholder="comment"></textarea>
    <input type="submit" value="Comment" name="addcomment">
  </form> 
   <?php }else{ ?>
    You must <a href="<?php echo $site_url; ?>/login"><b>login</b></a> or <a href="<?php echo $site_url; ?>/signup"><b>signup</b></a> for post a comment.
  <?php } ?>
  </div>  
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
</div>
<?php require('temp/footer.php'); ?>