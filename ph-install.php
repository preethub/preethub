<?php
// ph-install.php - Preethub Installation Script

// Enable error reporting for debugging during installation
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Define config file path
define('CONFIG_FILE', __DIR__ . '/config.php');

// If config file exists, block reinstallation for security
if (file_exists(CONFIG_FILE)) {
    die("Installation has already been completed. Delete 'config.php' to reinstall.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db_host = trim($_POST['db_host'] ?? '');
    $db_user = trim($_POST['db_user'] ?? '');
    $db_pass = trim($_POST['db_pass'] ?? '');
    $db_name = trim($_POST['db_name'] ?? '');

    // Basic validation
    if (!$db_host || !$db_user || !$db_name) {
        $error = "Please fill in all required fields.";
    } else {
        // Try connecting to the database
        $mysqli = @new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($mysqli->connect_error) {
            $error = "Database connection failed: " . htmlspecialchars($mysqli->connect_error);
        } else {
            // Create config.php with database credentials and basic config
            $config_content = "<?php\n";
            $config_content .= "// Preethub config file - generated on " . date('Y-m-d H:i:s') . "\n\n";
            $config_content .= "return [\n";
            $config_content .= "    'db_host' => '" . addslashes($db_host) . "',\n";
            $config_content .= "    'db_user' => '" . addslashes($db_user) . "',\n";
            $config_content .= "    'db_pass' => '" . addslashes($db_pass) . "',\n";
            $config_content .= "    'db_name' => '" . addslashes($db_name) . "',\n";
            $config_content .= "];\n";

            // Write the config file
            if (file_put_contents(CONFIG_FILE, $config_content) === false) {
                $error = "Failed to write config file. Please check directory permissions.";
            } else {
                echo "<h2>Installation Successful</h2>";
                echo "<p>Please delete or rename this installer script (<code>ph-install.php</code>) now for security reasons.</p>";
                echo "<p><a href='index.php'>Go to your blog</a></p>";
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Preethub Installation</title>
<style>
    body { font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; padding: 20px; }
    label { display: block; margin: 15px 0 5px; }
    input[type=text], input[type=password] { width: 100%; padding: 8px; }
    .error { color: red; }
    button { padding: 10px 20px; font-size: 16px; }
</style>
</head>
<body>
<h1>Preethub Installation</h1>
<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form method="post" action="">
    <label for="db_host">Database Host</label>
    <input type="text" id="db_host" name="db_host" value="<?= htmlspecialchars($_POST['db_host'] ?? 'localhost') ?>" required />

    <label for="db_user">Database Username</label>
    <input type="text" id="db_user" name="db_user" value="<?= htmlspecialchars($_POST['db_user'] ?? '') ?>" required />

    <label for="db_pass">Database Password</label>
    <input type="password" id="db_pass" name="db_pass" value="<?= htmlspecialchars($_POST['db_pass'] ?? '') ?>" />

    <label for="db_name">Database Name</label>
    <input type="text" id="db_name" name="db_name" value="<?= htmlspecialchars($_POST['db_name'] ?? '') ?>" required />

    <button type="submit">Install</button>
</form>
</body>
</html>
