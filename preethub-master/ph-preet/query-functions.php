<?php
function get_page($id = '') {
    global $phdb;
    if (isset($_GET['p']) && $_GET['p'] !== '') $page_id = (int)$_GET['p'];
    elseif ($id !== '') $page_id = (int)$id;
    else $page_id = (int)(get_config('site_index') ?? 1);
    if ($page_id < 1) return false;
    return $phdb->get_row("SELECT * FROM {$phdb->pages} WHERE page_id={$page_id}");
}

function login() {
    global $phdb;
    if (!isset($_POST['login'])) return;
    $username = trim((string)($_POST['username'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    if ($username === '' && $password === '') { add_message('Username and password Empty'); return; }
    if ($username === '') { add_message('Empty Username'); return; }
    if ($password === '') { add_message('Empty Password'); return; }

    $u = $phdb->escape($username);
    $data = $phdb->get_row("SELECT * FROM {$phdb->users} WHERE username='{$u}'");
    if (!$data || !password_verify($password, $data->password)) {
        add_message('Invalid username or password');
        return;
    }
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    session_regenerate_id(true);
    $_SESSION['username'] = $data->username;
    header('Location: ' . get_config('site_url'));
    exit;
}

function signup() {
    global $phdb;
    if (!isset($_POST['signup'])) return;

    $username = trim((string)($_POST['username'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['password'] ?? '');

    if ($username === '') { add_message('Empty Username'); return; }
    if ($email === '') { add_message('Empty email'); return; }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { add_message('Invalid email'); return; }
    if ($password === '') { add_message('Empty password'); return; }
    if (strlen($password) < 8) { add_message('Password must be at least 8 characters'); return; }

    $u = $phdb->escape($username);
    $e = $phdb->escape($email);
    if ($phdb->get_row("SELECT user_id FROM {$phdb->users} WHERE username='{$u}'")) {
        add_message('Username already exists'); return;
    }
    if ($phdb->get_row("SELECT user_id FROM {$phdb->users} WHERE email='{$e}'")) {
        add_message('Email already exists'); return;
    }

    $hash = $phdb->escape(password_hash($password, PASSWORD_DEFAULT));
    $sql = "INSERT INTO {$phdb->users} (username,email,password,role) VALUES ('{$u}','{$e}','{$hash}','Author')";
    if ($phdb->query($sql)) {
        add_message('You successfully signed up');
        header('Location: ph-action.php?action=signup');
        exit;
    }
    add_message('Unable to create account: ' . $phdb->last_error);
}

function loggeduser() {
    global $phdb;
    if (empty($_SESSION['username'])) return false;
    $user = $phdb->escape($_SESSION['username']);
    return $phdb->get_row("SELECT * FROM {$phdb->users} WHERE username='{$user}'");
}

function get_config($name) {
    global $phdb;
    $name = (string)$name;
    $escaped = $phdb->escape($name);
    $result = $phdb->get_row("SELECT config_value FROM {$phdb->config} WHERE config_name='{$escaped}'");
    if (!$result) return $name === 'active_plugins' ? [] : null;
    if ($name === 'active_plugins') {
        $value = @unserialize($result->config_value, ['allowed_classes' => false]);
        return is_array($value) ? $value : [];
    }
    return $result->config_value;
}
