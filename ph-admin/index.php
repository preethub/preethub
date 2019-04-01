<?php require('admin-header.php');  ?>

      <div class="title">	<i class="fa fa-tachometer"></i> Dashboard</div>
      <div class="widget">
      <div class="title">Site Info</div>
     <div class="card">
         <p>  Total Users        -      <b><?php echo total_users() ?></b></p>

  <p> Total Pages   -              <b><?php echo total_pages() ?></b></p>     
<?php run_hook('admin_siteinfo') ?>      
   </div> 
   </div>         

<?php  require('admin-footer.php'); ?>
