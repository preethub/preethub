<?php

// -----------------------
// Database Utility Functions
// -----------------------

/**
 * Get the total number of users.
 */
function total_users($phdb)
{
    $stmt = $phdb->prepare("SELECT COUNT(user_id) FROM users");
    $stmt->execute();
    return $stmt->fetchColumn();
}

/**
 * Get the total number of pages.
 */
function total_pages($phdb)
{
    $stmt = $phdb->prepare("SELECT COUNT(page_id) FROM pages");
    $stmt->execute();
    return $stmt->fetchColumn();
}

/**
 * Retrieve all users.
 */
function get_users($phdb)
{
    $stmt = $phdb->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Retrieve all pages.
 */
function get_pages($phdb)
{
    $stmt = $phdb->prepare("SELECT * FROM pages");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// -----------------------
// Page Management
// -----------------------

/**
 * Delete a page by its ID. Use POST for this operation.
 */
function delete_page($phdb, $page_id)
{
    $stmt = $phdb->prepare("DELETE FROM pages WHERE page_id = ?");
    if ($stmt->execute([$page_id])) {
        add_message('Page successfully deleted');
        header('Location: manage.php?type=page');
        exit();
    }
    add_message('Error deleting page.');
}

/**
 * Edit a page's name and content.
 */
function edit_page($phdb, $page_id, $pname, $pcontent)
{
    $stmt = $phdb->prepare(
        "UPDATE pages SET page_name = ?, content = ? WHERE page_id = ?"
    );
    if ($stmt->execute([$pname, $pcontent, $page_id])) {
        add_message('Page successfully updated');
        header("Location: edit.php?type=page&id=$page_id");
        exit();
    }
    add_message('ERROR: Could not execute statement');
}

/**
 * Add a new page.
 */
function add_page($phdb, $user_id, $pname, $pcontent)
{
    $stmt = $phdb->prepare(
        "INSERT INTO pages (page_name, user_id, content, publish) VALUES (?, ?, ?, 'yes')"
    );
    if ($stmt->execute([$pname, $user_id, $pcontent])) {
        add_message('Post successfully added');
        header('Location: add-new.php?type=page');
        exit();
    }
    add_message('ERROR: Could not execute statement');
}

// -----------------------
// User Management
// -----------------------

/**
 * Delete a user and their pages. Use POST for this operation.
 */
function delete_user($phdb, $user_id)
{
    $phdb->beginTransaction();
    try {
        $stmt1 = $phdb->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt2 = $phdb->prepare("DELETE FROM pages WHERE user_id = ?");
        $stmt1->execute([$user_id]);
        $stmt2->execute([$user_id]);
        $phdb->commit();
        add_message('User successfully deleted');
        header('Location: manage.php?type=user');
        exit();
    } catch (Exception $e) {
        $phdb->rollBack();
        add_message('Error deleting user.');
    }
}

/**
 * Add a new user.
 */
function add_user($phdb, $username, $password, $email)
{
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $phdb->prepare(
        "INSERT INTO users (role, email, username, password) VALUES ('Author', ?, ?, ?)"
    );
    if ($stmt->execute([$email, $username, $password_hash])) {
        add_message('User added successfully.');
        header('Location: add-new.php?type=user');
        exit();
    }
    add_message('ERROR: Could not execute statement');
}

// -----------------------
// Site Settings
// -----------------------

/**
 * Update basic site settings.
 */
function settings($phdb, $siteurl, $sitename, $sitedesc)
{
    try {
        $phdb->beginTransaction();

        $stmt1 = $phdb->prepare(
            "UPDATE config SET config_value = ? WHERE config_name = 'site_url'"
        );
        $stmt2 = $phdb->prepare(
            "UPDATE config SET config_value = ? WHERE config_name = 'site_name'"
        );
        $stmt3 = $phdb->prepare(
            "UPDATE config SET config_value = ? WHERE config_name = 'site_description'"
        );

        $stmt1->execute([$siteurl]);
        $stmt2->execute([$sitename]);
        $stmt3->execute([$sitedesc]);
        $phdb->commit();
        add_message('Settings updated successfully');
        header('Location: settings.php');
        exit();
    } catch (Exception $e) {
        $phdb->rollBack();
        add_message('Unable to update settings');
    }
}

?>
