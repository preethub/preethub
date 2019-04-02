<?php 
// Plugin System



function get_plugin_data($plugin_file) {
	$plugin_data = implode('', file($plugin_file));
	preg_match("|Plugin Name:(.*)|i", $plugin_data, $plugin_name);
	preg_match("|Plugin URI:(.*)|i", $plugin_data, $plugin_uri);
	preg_match("|Description:(.*)|i", $plugin_data, $description);
	preg_match("|Author:(.*)|i", $plugin_data, $author_name);
	preg_match("|Author URI:(.*)|i", $plugin_data, $author_uri);
	if ( preg_match("|Version:(.*)|i", $plugin_data, $version) )
		$version = $version[1];
	else
		$version ='';

	$description = $description[1];

	$name = $plugin_name[1];
	$name = trim($name);
	$plugin = $name;
	if ('' != $plugin_uri[1] && '' != $name) {
		$plugin = '<a href="' . $plugin_uri[1] . '" title="Visit plugin homepage">' . $plugin . '</a>';
	}

	if ('' == $author_uri[1]) {
		$author = $author_name[1];
	} else {
		$author = '<a href="' . $author_uri[1] . '" title="Visit author homepage">' . $author_name[1] . '</a>';
	}

	return array('Name' => $name, 'Title' => $plugin, 'Description' => $description, 'Author' => $author, 'Version' => $version);
}



function get_plugins() {
	
	$plugins = array();

	$plugins_dir = @ dir(PH_PATH . PLUGINS_PATH);
	if ($plugins_dir) {
		while(($file = $plugins_dir->read()) !== false) {
			if ( preg_match('|^\.+$|', $file) )
				continue;
			if (is_dir(PH_PATH . PLUGINS_PATH . '/' . $file)) {
				$plugins_subdir = @ dir(PH_PATH . PLUGINS_PATH . '/' . $file);
				if ($plugins_subdir) {
					while(($subfile = $plugins_subdir->read()) !== false) {
						if ( preg_match('|^\.+$|', $subfile) )
							continue;
						if ( preg_match('|\.php$|', $subfile) )
							$plugin_files[] = "$file/$subfile";
					}
				}
			} else {
				if ( preg_match('|\.php$|', $file) ) 
					$plugin_files[] = $file;
			}
		}
	}

	if (!$plugins_dir || !$plugin_files) {
		return;
	}

 sort($plugin_files);

	foreach($plugin_files as $plugin_file) {
	
 	$plugin_data = get_plugin_data(PH_PATH . PLUGINS_PATH . '/' . $plugin_file);
	
		if (empty($plugin_data['Name'])) {
		continue;
	}

$plugins[$plugin_file] = $plugin_data;
 
}
return $plugins;

}
