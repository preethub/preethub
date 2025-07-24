<?php
/*--------------
 * Query functions
 * Preethub
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * github.com/preethub/preethub
 *--------------*/

/**
 * Retrieve page by ID or from request or default config.
 */
function get_page($id = null) {
    global $phdb;

    $pageId = $_GET['p'] ?? $id ?? get_config('site_index');
    $pageId = (int) $pageId;

    $stmt = $phdb->prepare("SELECT * FROM {$phdb->pages} WHERE page_id = ?");
    $stmt->bind_param('i', $pageId);
    $stmt->execute();

    return $stmt->get_result()->fetch_object() ?: null;
}

/**
 * User login handler.
 */
function login() {
    global $phdb;

    if (empty($_POST['login'])) return;

    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' && $password === '') {
        add_message('Username and password empty');
        return;
    }
    if ($username === '') {
        add_message('Empty Username');
        return;
    }
    if ($password === '') {
        add_message('Empty Password');
        return;
    }

    $stmt = $phdb->prepare("SELECT * FROM {$phdb->users} WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows !== 1) {
        add_message('Username does not match');
        return;
    }

    $user = $result->fetch_object();
    if (password_verify($password, $user->password)) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['username'] = $username;
        header('Location: ' . get_config('site_url'));
        exit;
    }

    add_message('Password not match');
}

/**
 * User signup handler.
 */
function signup() {
    global $phdb;

    if (empty($_POST['signup'])) return;

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '') {
        add_message('Empty Username');
        return;
    }
    if ($email === '') {
        add_message('Empty Email');
        return;
    }
    if ($password === '') {
        add_message('Empty Password');
        return;
    }

    // Check username exists
    $stmt = $phdb->prepare("SELECT 1 FROM {$phdb->users} WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        add_message('Username already exists');
        return;
    }
    $stmt->close();

    // Check email exists
    $stmt = $phdb->prepare("SELECT 1 FROM {$phdb->users} WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        add_message('Email already exists');
        return;
    }
    $stmt->close();

    // Hash password securely
    $passwordHash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    // Insert user
    $stmt = $phdb->prepare("INSERT INTO {$phdb->users} (username, email, password, role) VALUES (?, ?, ?, 'Admin')");
    $stmt->bind_param('sss', $username, $email, $passwordHash);

    if ($stmt->execute()) {
        add_message('You successfully signed up');
        header('Location: ph-action.php?action=signup');
        exit;
    } else {
        add_message('ERROR: Could not execute query: ' . $phdb->error);
    }
}

/**
 * Returns current logged-in user data or null if not logged in.
 */
function loggeduser() {
    global $phdb;

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $username = $_SESSION['username'] ?? null;
    if (!$username) {
        return null;
    }

    $stmt = $phdb->prepare("SELECT * FROM {$phdb->users} WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();

    return $stmt->get_result()->fetch_object();
}

/**
 * Retrieves configuration value by name.
 */
function get_config(string $name) {
    global $phdb;

    $stmt = $phdb->prepare("SELECT config_value FROM {$phdb->config} WHERE config_name = ?");
    $stmt->bind_param('s', $name);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_object();
    if (!$result) {
        return null;
    }

    if ($name === 'active_plugins') {
        return unserialize($result->config_value);
    }

    return $result->config_value;
}
