<?php
session_start();
require __DIR__ . '/preet.php';

$action = $_GET['action'] ?? '';
switch ($action) {
    case 'login':
        login();
        default_login_view();
        break;
    case 'signup':
        signup();
        default_signup_view();
        break;
    case 'logout':
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        header('Location: ' . site_url());
        exit;
    default:
        header('Location: ' . site_url());
        exit;
}
