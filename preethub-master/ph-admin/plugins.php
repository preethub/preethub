<?php
require 'admin-header.php';
require_once 'includes/plugins.php';

$plugins=get_plugins();
$action=$_GET['action']??'';
$plugin=(string)($_GET['plugin']??'');
$valid_plugin=array_key_exists($plugin,$plugins);
if(($action==='activate'||$action==='deactivate') && $valid_plugin){
    $active=get_config('active_plugins'); if(!is_array($active)) $active=[];
    if($action==='activate' && !in_array($plugin,$active,true)) $active[]=$plugin;
    if($action==='deactivate') $active=array_values(array_diff($active,[$plugin]));
    $serialized=$phdb->escape(serialize($active));
    if($phdb->query("UPDATE {$phdb->config} SET config_value='{$serialized}' WHERE config_name='active_plugins'")){
        header('Location: plugins.php'); exit;
    }
    echo '<p>Unable to update plugins: '.h($phdb->last_error).'</p>';
}
?>
<div class="title"><i class="fa fa-puzzle-piece"></i> All Plugins</div>
<?php if(!$plugins): ?><p>No plugins are available.</p><?php else:
$active=get_config('active_plugins'); if(!is_array($active)) $active=[];
foreach($plugins as $plugin_file=>$data): ?>
<div class="widget card"><div class="content">
<b><?php echo h($data['Title']); ?></b> -
<?php if(in_array($plugin_file,$active,true)): ?>
<a href="plugins.php?action=deactivate&amp;plugin=<?php echo rawurlencode($plugin_file); ?>">Deactivate</a>
<?php else: ?>
<a href="plugins.php?action=activate&amp;plugin=<?php echo rawurlencode($plugin_file); ?>">Activate</a>
<?php endif; ?>
<br>Version <?php echo h($data['Version']); ?> - Author <?php echo h($data['Author']); ?><br>
<?php echo h($data['Description']); ?>
</div></div>
<?php endforeach; endif; require 'admin-footer.php';
