<?php require('admin-header.php'); ?>

<section class="dashboard">
  <header class="dashboard-header">
    <h1><i class="fa fa-tachometer"></i> Admin Dashboard</h1>
  </header>

  <section class="widget">
    <h2 class="widget-title">Site Information</h2>
    
    <div class="card site-stats">
      <ul>
        <li>
          <span class="label">Total Users:</span>
          <span class="value"><?php echo total_users(); ?></span>
        </li>
        <li>
          <span class="label">Total Pages:</span>
          <span class="value"><?php echo total_pages(); ?></span>
        </li>
      </ul>

      <?php run_hook('admin_siteinfo'); ?>
    </div>
  </section>
</section>

<?php require('admin-footer.php'); ?>
