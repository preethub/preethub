<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
require_once dirname(__DIR__) . '/preet.php';

$user = loggeduser();
if (!$user || $user->role !== 'Admin') {
    header('Location: ' . site_url());
    exit;
}

require_once __DIR__ . '/includes/functions.php';

$admin_menu = [
    'Dashboard' => ['url'=>'index.php','icon'=>'fa-pie-chart'],
    'Users' => ['url'=>'manage.php?type=user','icon'=>'fa-user'],
    'Pages' => ['url'=>'manage.php?type=page','icon'=>'fa-file-text'],
    'Plugin Manager' => ['url'=>'plugins.php','icon'=>'fa-pie-chart'],
    'Settings' => ['url'=>'settings.php','icon'=>'fa-pie-chart']
];
$admin_submenu = [];
$admin_submenu['Pages'][] = ['name'=>'Add new','url'=>'add-new.php?type=page'];
$admin_submenu['Users'][] = ['name'=>'Add new','url'=>'add-new.php?type=user'];
