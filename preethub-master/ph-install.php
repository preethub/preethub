<?php
$root = __DIR__;
function installer_post($key, $default = '') { return trim((string)($_POST[$key] ?? $default)); }
function installer_h($v) { return htmlspecialchars((string)$v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); }

if (file_exists($root . '/ph-config.php')) {
    require_once $root . '/ph-config.php';
    require_once $root . '/ph-preet/phdb.php';
    $check = $phdb->query("SHOW TABLES LIKE '" . $phdb->escape($phdb->config) . "'");
    if ($check && mysqli_num_rows($check) > 0) {
        die('Preethub is already installed. Use the Admin Panel to change configuration.');
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Preethub Installer</title><link rel="stylesheet" href="ph-admin/style/admin.css"></head><body>
<div class="installerlogo"><span>Preethub Installer</span></div><div class="installer"><div class="widget"><div class="card">
<?php
$step = isset($_GET['step']) ? (int)$_GET['step'] : 0;

if ($step === 1) {
    $host=installer_post('host','localhost'); $user=installer_post('user'); $name=installer_post('name');
    $pass=(string)($_POST['pass'] ?? ''); $prefix=installer_post('prefix','ph_');

    if ($host==='' || $user==='' || $name==='' || !preg_match('/^[A-Za-z0-9_]+$/',$prefix)) {
        die('Invalid database details or table prefix.');
    }
    define('DB_HOST',$host); define('DB_USER',$user); define('DB_NAME',$name); define('DB_PASS',$pass); define('TABLE_PREFIX',$prefix);
    require $root . '/ph-preet/phdb.php';
    require $root . '/ph-preet/install-setup.php';
    try {
        foreach ($tables_structure as $sql) if (!$phdb->query($sql)) throw new RuntimeException($phdb->last_error);
        create_config_file();
        echo '<p>Database connection and tables were created successfully.</p>';
    } catch (Throwable $e) {
        @unlink($root . '/ph-config.php');
        die('Installation failed: ' . installer_h($e->getMessage()));
    }
?>
<form action="?step=2" method="post">
<h3>Site details</h3>
<label>Site name</label><input type="text" name="site_name" value="Preethub" required>
<label>Site description</label><input type="text" name="site_desc" value="My new preethub blog">
<h3>Administrator account</h3>
<label>Username</label><input type="text" name="adminusername" required>
<label>Email</label><input type="email" name="adminemail" required>
<label>Password</label><input type="password" name="adminpass" minlength="8" required>
<input type="submit" value="Install">
</form>
<?php
} elseif ($step === 2) {
    if (!file_exists($root.'/ph-config.php')) die('Installer session expired. Start again.');
    require_once $root.'/ph-config.php';
    require_once $root.'/ph-preet/phdb.php';
    require_once $root.'/ph-preet/install-setup.php';

    $site_name=installer_post('site_name'); $site_desc=installer_post('site_desc');
    $admin=installer_post('adminusername'); $email=installer_post('adminemail'); $password=(string)($_POST['adminpass'] ?? '');
    if ($site_name==='' || $admin==='' || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($password)<8) die('Invalid site or administrator details.');

    $base = 'http://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
    $request = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
    $url = rtrim(str_replace('/ph-install.php','',$base.$request),'/');

    $page_content='<b>Sat Sri Akal</b> is a Jaikara (lit. Call of Victory) used, often, as a greeting by followers of the Sikh religion.';
    $hash=password_hash($password,PASSWORD_DEFAULT);
    $queries=[
        "INSERT INTO {$phdb->pages} (page_id,user_id,page_name,content,publish) VALUES (1,1,'".$phdb->escape('Sat Shri Akal')."','".$phdb->escape($page_content)."','yes')",
        "INSERT INTO {$phdb->config} (config_id,config_name,config_value) VALUES
        (1,'site_url','".$phdb->escape($url)."'),(2,'site_name','".$phdb->escape($site_name)."'),
        (3,'site_description','".$phdb->escape($site_desc)."'),(4,'site_admin','".$phdb->escape($admin)."'),
        (5,'site_index','1'),(6,'active_plugins','".$phdb->escape(serialize([]))."')",
        "INSERT INTO {$phdb->users} (user_id,username,email,role,password) VALUES
        (1,'".$phdb->escape($admin)."','".$phdb->escape($email)."','Admin','".$phdb->escape($hash)."')"
    ];
    foreach($queries as $sql) if(!$phdb->query($sql)) die('Installation failed: '.installer_h($phdb->last_error));
    echo '<p>Preethub has successfully been installed and configured.</p><p><a href="ph-admin">Open Admin Panel</a></p>';
} else {
?>
<p>Welcome to Preethub. Enter your database details.</p>
<form action="?step=1" method="post">
<label>Database Host</label><input type="text" name="host" value="localhost" required>
<label>Database User</label><input type="text" name="user" required>
<label>Database Password</label><input type="password" name="pass">
<label>Database Name</label><input type="text" name="name" required>
<label>Table Prefix</label><input type="text" name="prefix" value="ph_" required>
<input type="submit" value="Continue">
</form>
<?php } ?>
</div></div></div></body></html>
