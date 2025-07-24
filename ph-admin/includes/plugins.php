<?php
// -- Plugin System --

/**
 * Extract plugin metadata from a file header.
 *
 * @param string $filepath Path to the plugin PHP file.
 * @return array Associative array of plugin data.
 */
function getPluginData(string $filepath): array
{
    $content = @file_get_contents($filepath);
    if ($content === false) {
        return [];
    }

    $fields = [
        'Plugin Name' => '',
        'Plugin URI' => '',
        'Description' => '',
        'Author' => '',
        'Author URI' => '',
        'Version' => ''
    ];

    foreach ($fields as $field => $_) {
        if (preg_match("/^$field:\s*(.+)$/mi", $content, $matches)) {
            $fields[$field] = trim($matches[1]);
        }
    }

    return [
        'Name'        => $fields['Plugin Name'],
        'Title'       => !empty($fields['Plugin URI']) && !empty($fields['Plugin Name'])
                            ? sprintf(
                                '<a href="%s" title="Visit plugin homepage">%s</a>',
                                htmlspecialchars($fields['Plugin URI']),
                                htmlspecialchars($fields['Plugin Name'])
                              )
                            : htmlspecialchars($fields['Plugin Name']),
        'Description' => $fields['Description'],
        'Author'      => !empty($fields['Author URI'])
                            ? sprintf(
                                '<a href="%s" title="Visit author homepage">%s</a>',
                                htmlspecialchars($fields['Author URI']),
                                htmlspecialchars($fields['Author'])
                              )
                            : htmlspecialchars($fields['Author']),
        'Version'     => $fields['Version'],
    ];
}

/**
 * Discover and load all plugins from the plugins directory.
 *
 * @return array Associative array of plugin metadata.
 */
function getPlugins(): array
{
    $pluginsDir = rtrim(PH_PATH . PLUGINS_PATH, '/');
    if (!is_dir($pluginsDir)) {
        return [];
    }

    $pluginFiles = [];
    foreach (scandir($pluginsDir) as $item) {
        if ($item === '.' || $item === '..') continue;
        $path = "$pluginsDir/$item";

        if (is_dir($path)) {
            foreach (scandir($path) as $subitem) {
                if ($subitem[0] === '.') continue;
                if (strtolower(substr($subitem, -4)) === '.php') {
                    $pluginFiles[] = "$item/$subitem";
                }
            }
        } elseif (strtolower(substr($item, -4)) === '.php') {
            $pluginFiles[] = $item;
        }
    }

    sort($pluginFiles);

    $plugins = [];
    foreach ($pluginFiles as $file) {
        $data = getPluginData("$pluginsDir/$file");
        if (!empty($data['Name'])) {
            $plugins[$file] = $data;
        }
    }

    return $plugins;
}
?>
