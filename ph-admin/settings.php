<?php 
require('admin-header.php');
settings();
?>

<div class="title">Settings</div>

<div class="widget"> 
    <div class="title">Settings</div>
    <div class="card">      
        <?php echo get_messages(); ?>     

        <form action="settings.php" method="post">

            <label for="site-url"><b>Site URL</b></label>
            <input 
                id="site-url" 
                name="siteurl" 
                type="text" 
                value="<?php echo htmlspecialchars(get_config('site_url'), ENT_QUOTES, 'UTF-8'); ?>" 
                required
            >
            <a href="<?php echo htmlspecialchars(get_config('site_url'), ENT_QUOTES, 'UTF-8'); ?>">
                <b><?php echo htmlspecialchars(get_config('site_url'), ENT_QUOTES, 'UTF-8'); ?></b>
            </a>

            <br><br>

            <label for="site-name"><b>Site Name</b></label>
            <input 
                id="site-name" 
                name="sitename" 
                type="text" 
                value="<?php echo htmlspecialchars(get_config('site_name'), ENT_QUOTES, 'UTF-8'); ?>" 
                required
            >

            <label for="site-description"><b>Site Description</b></label>
            <textarea 
                id="site-description" 
                name="sitedesc" 
                rows="4"
            ><?php echo htmlspecialchars(get_config('site_description'), ENT_QUOTES, 'UTF-8'); ?></textarea>

            <input 
                type="submit" 
                name="settings" 
                value="Save Settings"
            >

        </form>
    </div>
</div>

<?php require('admin-footer.php'); ?>
