<?php run_hook('admin_foot'); ?>

<!-- JavaScript Files -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/admin.js"></script>

<!-- Footer -->
<footer class="footer">
    <?php echo htmlspecialchars(get_config('site_name')); ?> - 
    <?php echo htmlspecialchars($ph_version); ?>
</footer>
