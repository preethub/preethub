<?php

/*-------------
 * Preet File
 * Preethub
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * github.com/preethub/preethub
 *------------*/

/* PreetHub Version */
$ph_version = "0.4";

/* Define base paths */
define('PH_PATH', __DIR__ . '/');
define('PLUGINS_PATH', 'ph-extend/plugins');
define('UPLOAD_PATH', 'ph-extend/uploads');

/* Configuration loading and installation redirect */
if (file_exists(PH_PATH . 'ph-config.php')) {
    require_once PH_PATH . 'ph-config.php';
} else {
    if (file_exists(PH_PATH . 'ph-install.php')) {
        header('Location: ph-install.php');
        exit;
    } elseif (file_exists(dirname(PH_PATH) . '/ph-install.php')) {
        header('Location: ../ph-install.php');
        exit;
    } else {
        // Fallback error if config and installer not found
        die('Configuration file not found and installer missing. Please upload "ph-config.php" or run the installer.');
    }
}

/* Include core modules */
require_once PH_PATH . 'ph-preet/query-functions.php';
require_once PH_PATH . 'ph-preet/phdb.php';
require_once PH_PATH . 'ph-preet/general-functions.php';
require_once PH_PATH . 'ph-preet/default-view.php';

/* Initialize GET parameters */
$getparams = ['p'];

/* Load active plugins */
$activePlugins = get_config('active_plugins');
if (is_array($activePlugins)) {
    foreach ($activePlugins as $plugin) {
        $pluginPath = PH_PATH . PLUGINS_PATH . '/' . $plugin;
        if (!empty($plugin) && file_exists($pluginPath)) {
            include_once $pluginPath;
        }
    }
}
