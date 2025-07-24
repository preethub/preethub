<?php
require 'admin-header.php';
require 'includes/plugins.php';

// --- Helper Functions ---
function get_safe($key) {
    return isset($_GET[$key]) ? htmlspecialchars(trim($_GET[$key])) : '';
}

// --- Main Processing ---
$action = get_safe('action');
$plugin = get_safe('plugin');
$active_plugins = get_config('active_plugins');
if (!is_array($active_plugins)) $active_plugins = [];

$all_plugins = get_plugins();

if ($action === 'activate' && array_key_exists($plugin, $all_plugins)) {
    if (!in_array($plugin, $active_plugins)) {
        $active_plugins[] = $plugin;
        $success = $phdb->query(
            "UPDATE {$phdb->config} SET config_value='" .
            serialize(array_unique($active_plugins)) .
            "' WHERE config_name='active_plugins'"
        );
        if (!$success) die('Error activating plugin.');
        header('Location: plugins.php?activate=true');
        exit;
    }
}

if ($action === 'deactivate' && array_key_exists($plugin, $all_plugins)) {
    $idx = array_search($plugin, $active_plugins);
    if ($idx !== false) {
        array_splice($active_plugins, $idx, 1);
        $success = $phdb->query(
            "UPDATE {$phdb->config} SET config_value='" .
            serialize(array_unique($active_plugins)) .
            "' WHERE config_name='active_plugins'"
        );
        if (!$success) die('Error deactivating plugin.');
        header('Location: plugins.php?deactivate=true');
        exit;
    }
}
?>

<div class="title"><i class="fa fa-tachometer"></i> All Plugins</div>

<?php if (isset($_GET['activate'])): ?>
    <div class="alert alert-success">Plugin <strong>activated</strong>.</div>
<?php endif; ?>
<?php if (isset($_GET['deactivate'])): ?>
    <div class="alert alert-warning">Plugin <strong>deactivated</strong>.</div>
<?php endif; ?>

<?php if (empty($all_plugins)): ?>
    <p class="alert alert-info">
        Couldn’t open plugins directory or there are no plugins available.
    </p>
<?php else: ?>
    <div class="plugins-list">
        <?php foreach ($all_plugins as $file => $data): 
            $is_active = in_array($file, $active_plugins);
            $title = htmlspecialchars($data['Title']);
            $author = htmlspecialchars($data['Author']);
            $version = htmlspecialchars($data['Version']);
            $desc = nl2br(htmlspecialchars($data['Description']));
            $toggle_action = $is_active ? 'deactivate' : 'activate';
            $toggle_text   = $is_active ? 'Deactivate' : 'Activate';
            $toggle_class  = $is_active ? 'btn-danger' : 'btn-success';
        ?>
        <div class="widget card plugin-card">
            <div class="content">
                <div class="plugin-header">
                    <span class="plugin-title"><?php echo $title; ?></span>
                    <a class="btn <?php echo $toggle_class; ?> btn-sm right"
                       href="plugins.php?action=<?php echo $toggle_action; ?>&amp;plugin=<?php echo urlencode($file); ?>"
                       title="<?php echo $toggle_text; ?> this plugin">
                       <?php echo $toggle_text; ?>
                    </a>
                </div>
                <div class="plugin-meta">
                    Version: <span><?php echo $version; ?></span> &middot; 
                    Author: <span><?php echo $author; ?></span>
                </div>
                <div class="plugin-description"><?php echo $desc; ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require 'admin-footer.php'; ?>
