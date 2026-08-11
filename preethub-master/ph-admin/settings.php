<?php
require 'admin-header.php';
settings();
?>
<div class="title">Settings</div><div class="widget"><div class="title">Settings</div><div class="card">
<?php echo get_messages(); ?>
<form action="settings.php" method="post">
<label>Site URL</label><input name="siteurl" type="url" value="<?php echo h(get_config('site_url')); ?>" required>
<label>Site Name</label><input name="sitename" type="text" value="<?php echo h(get_config('site_name')); ?>" required>
<label>Site Description</label><textarea name="sitedesc" rows="4"><?php echo h(get_config('site_description')); ?></textarea>
<input type="submit" name="settings" value="Save Settings">
</form></div></div>
<?php require 'admin-footer.php'; ?>
