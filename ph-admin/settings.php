<?php 
require('inc.php');
require('functions/settings.php');
require('includes/header.php');

?>


    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Settings</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="user.php"> Settings</a></li>
        </ul>
      </div>
        </div>
        <div class="row">
        <div class="clearix"></div>
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Settings</h3>
            <div class="tile-body">
    <?php echo $echo;?>       
            <form action="settings.php" method="post"> 
                <div class="form-group col-md-3">                   
                  <label class="control-label"><b>Site Url </b></label>
                  <input class="form-control" name="siteurl" type="text" value="<?php echo $site_url; ?>" required>
         <a href="<?php echo $site_url; ?>"><b><?php echo $site_url; ?></b></a>         
                </div>
               
                <div class="form-group col-md-3">
                  <label class="control-label"><b>Site Name</b></label>
                  <input class="form-control" name="sitename" type="text" value="<?php echo $site_name; ?>" required>
                </div>
                <div class="form-group col-md-3">
                  <label class="control-label"><b>Site Description </b></label>
              <textarea class="form-control" name="sitedesc" rows="4"><?php echo $site_desc; ?></textarea>
              
                </div>
                            <div class="form-group col-md-3">
                  <label class="control-label"><b>Posts per Page</b></label>
                  <input class="form-control" name="postsperpage" type="text" value="<?php echo $posts_per_page; ?>" required>
                </div>        
                <div class="form-group col-md-4 align-self-end">
                  <button class="btn btn-primary" type="submit" name="settings"><i class="fa fa-fw fa-lg fa-check-circle"></i>Submit</button>
                </div>
              </form>
            </div>
            </div>
            </div>
            </div>
    </main>


<?php require_once('includes/footer.php');

?>
