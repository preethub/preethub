<?php 
require('inc.php');
require('functions/index.php');
require('includes/header.php');
?>
  <main class="app-content">
      <div class="app-title">
      <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Users</h4>
              <p><b><?php echo $total_users; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
            <div class="info">
              <h4>Posts</h4>
              <p><b><?php echo $total_posts; ?></b></p>
            </div>
          </div>
        </div>
         <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>comments</h4>
              <p><b><?php echo $total_comments; ?></b></p>
            </div>
          </div>
        </div>
     </div>
    </main>


<?php require_once('includes/footer.php');

?>
