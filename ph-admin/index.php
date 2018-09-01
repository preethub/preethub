<?php 
require('admin-core.php');
require('admin-header.php');
?>    
      <div class="heading">Dashboard</div>
      <div class="card">
         <p>  Total Users        -      <b><?php echo $total_users; ?></b></p>
         <p>   Total Posts   -              <b><?php echo $total_posts; ?></b></p>
     <p>Total Comments   -              <b><?php echo $total_comments; ?></b></p>           
   </div>             
<?php require('admin-footer.php');

?>
