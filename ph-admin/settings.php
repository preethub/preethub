<?php 
require('admin-core.php');
require('admin-header.php');
?>    
     <div class="heading">
         Settings
        </div> 
            <div class="card">      <?php echo get_messages(); ?>     
            <form action="settings.php" method="post">                   
                  <label for="site-url"><b>Site Url </b></label>
       <input name="siteurl" type="text" value="<?php echo $site_url; ?>" required>
         <a href="<?php echo $site_url; ?>"><b><?php echo $site_url; ?></b></a>    <br>                                                
                  <label for="site-name"><b>Site Name</b></label>
                  <input name="sitename" type="text" value="<?php echo $site_name; ?>" required>
                  <label for="site-description"><b>Site Description </b></label>
              <textarea class="form-control" name="sitedesc" rows="4"><?php echo $site_desc; ?></textarea>
    <label for="post-per-page"><b>Posts per Page</b></label>
                  <input name="postsperpage" type="text" value="<?php echo $posts_per_page; ?>" required>
                  <input type="submit" name="settings">                
              </form>
            </div>
<?php require('admin-footer.php');

?>
