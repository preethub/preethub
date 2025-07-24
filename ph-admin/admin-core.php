<?php
session_start();

require dirname(dirname(__FILE__)) . '/preet.php';
require 'includes/functions.php';

// Redirect non-logged-in or non-admin users to site homepage
if (!is_logged() || loggeduser()->role !== 'Admin') {
    header('Location: ' . get_config('site_url'));
    exit;
}

// Define main admin menu with URLs and icons
$admin_menu = [
    'Dashboard'      => ['url' => 'index.php', 'icon' => 'fa-pie-chart'],
    'Users'          => ['url' => 'manage.php?type=user', 'icon' => 'fa-user'],
    'Pages'          => ['url' => 'manage.php?type=page', 'icon' => 'fa-file-text'],
    'Plugin Manager' => ['url' => 'plugins.php', 'icon' => 'fa-pie-chart'],
    'Settings'       => ['url' => 'settings.php', 'icon' => 'fa-pie-chart'],
];

// Define admin submenus with checks for initialization
$admin_submenu = [];

$admin_submenu['Pages'][] = [
    'name' => 'Add new',
    'url'  => 'add-new.php?type=page',
];

$admin_submenu['Users'][] = [
    'name' => 'Add new',
    'url'  => 'add-new.php?type=user',
];
