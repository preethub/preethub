<?php 
require('admin-header.php');
settings();
?>    
     <div class="title">
         Settings
        </div> 
         <div class="widget"> 
<div class="title">Settings</div>
            <div class="card">      <?php echo get_messages(); ?>     
            <form action="settings.php" method="post">                   
                  <label for="site-url"><b>Site Url </b></label>
       <input name="siteurl" type="text" value="<?php echo get_config('site_url'); ?>" required>
         <a href="<?php echo get_config('site_url'); ?>"><b><?php echo get_config('site_url'); ?></b></a>  <br>  <br>                                                
                  <label for="site-name"><b>Site Name</b></label>
                  <input name="sitename" type="text" value="<?php echo get_config('site_name'); ?>" required>
                  <label for="site-description"><b>Site Description </b></label>
              <textarea name="sitedesc" rows="4"><?php echo get_config('site_description'); ?></textarea>
                  <input type="submit" name="settings">                
              </form>
            </div>
            </div>
<?php require('admin-footer.php'); ?>
