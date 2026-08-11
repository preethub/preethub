<?php
$ph_version = '0.3.1';
define('PH_PATH', __DIR__ . '/');
define('PLUGINS_PATH', 'ph-extend/plugins');
define('UPLOAD_PATH', 'ph-extend/uploads');

if (!file_exists(PH_PATH . 'ph-config.php')) {
    if (PHP_SAPI !== 'cli') {
        header('Location: ph-install.php');
        exit;
    }
    die('Preethub is not installed. Run ph-install.php.');
}
require_once PH_PATH . 'ph-config.php';
require_once PH_PATH . 'ph-preet/phdb.php';
require_once PH_PATH . 'ph-preet/query-functions.php';
require_once PH_PATH . 'ph-preet/general-functions.php';
require_once PH_PATH . 'ph-preet/default-view.php';

$getparams = ['p'];
$active_plugins = get_config('active_plugins');
if (is_array($active_plugins)) {
    foreach ($active_plugins as $plugin) {
        $plugin = str_replace(['..','\\'], '', (string)$plugin);
        if ($plugin !== '' && preg_match('#^[A-Za-z0-9._/-]+\.php$#', $plugin) &&
            file_exists(PH_PATH . PLUGINS_PATH . '/' . $plugin)) {
            include_once PH_PATH . PLUGINS_PATH . '/' . $plugin;
        }
    }
}
