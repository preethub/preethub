<?php 

require('admin-header.php');
require('includes/plugins.php');



//Activate Plugin
if ('activate' == $_GET['action']) {
	$active_plugins = get_config('active_plugins');
	if(!is_array($active_plugins))
		$active_plugins = array();

	$active_plugins[] = trim( $_GET['plugin'] );
	
		if(!$phdb->query("UPDATE $phdb->config SET config_value='".serialize(array_unique($active_plugins))."' Where config_name='active_plugins'")){
	die('error'); }
	
		header('Location: plugins.php?activate=true');
	}
	
// Deactivate Plugin
	if ('deactivate' == $_GET['action']) {
		$active_plugins = get_config('active_plugins');

	if(!is_array($active_plugins))
		$active_plugins = array();
	
	array_splice($active_plugins, array_search( $_GET['plugin'], $active_plugins), 1 );
	
	if(!$phdb->query("UPDATE $phdb->config SET config_value='".serialize(array_unique($active_plugins))."' Where config_name='active_plugins'")){
	die('error'); }

		header('Location: plugins.php?deactivate=true'); 
	}
?>
 <div class="title">	<i class="fa fa-tachometer"></i> All Plugins</div> 
    
  <?php

//Check Plugins
if (empty(get_plugins())) {
echo	"<p>Couldn't open plugins directory or there are no plugins available.</p>"; // TODO: make more helpful
} else { 

	if (isset($_GET['activate'])) : ?>
<p>Plugin <strong>activated</strong>.</p>
<?php endif; ?>
<?php if (isset($_GET['deactivate'])) : ?>
<p>Plugin <strong>deactivated</strong></p>

<?php endif;  

//Plugins
	foreach(get_plugins() as $plugin_file => $plugin_data) {
	?>	
		 <div class="widget card">

<?php
echo "<div class='content'>
			<b>{$plugin_data['Title']}</b>	- ";
$active_plugins = get_config('active_plugins');
//Check plugin activate or not
if (!empty($active_plugins) && in_array($plugin_file, $active_plugins)) {
	
	//Deactivate Link
			echo "<a href='plugins.php?action=deactivate&amp;plugin=$plugin_file' title='Deactivate this plugin'>Deactivate</a>";

		} else {
			//Activate Link
			echo "<a href='plugins.php?action=activate&amp;plugin=$plugin_file' title='Activate this plugin'>Activate</a>";
		}

		echo "<br>
	Version	{$plugin_data['Version']}
	- Author {$plugin_data['Author']} <br>
		{$plugin_data['Description']}<br/></div>";
		?>
		</div>
<?php } 

 }
require('admin-footer.php');
 
