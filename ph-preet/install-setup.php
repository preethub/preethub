<?php
/**
 * Preethub Setup Script - Full Automation
 * Version 0.3
 * 
 * Creates 'ph-config.php' and creates required tables in the database.
 * Released under GNU GPL v3.
 */

// Configuration template with placeholders
$config_template = <<<'EOT'
<?php
// Preethub Configuration
// Version 0.3

define("DB_HOST", "{{DB_HOST}}");
define("DB_USER", "{{DB_USER}}");
define("DB_NAME", "{{DB_NAME}}");
define("DB_PASS", "{{DB_PASS}}");
define("TABLE_PREFIX", "{{TABLE_PREFIX}}");
EOT;

/**
 * Create 'ph-config.php' with database credentials.
 *
 * @param string $host
 * @param string $user
 * @param string $name
 * @param string $pass
 * @param string $prefix
 * @return void
 */
function create_config_file($host, $user, $name, $pass, $prefix = 'ph_') {
    global $config_template;
    $replace_keys = ['{{DB_HOST}}', '{{DB_USER}}', '{{DB_NAME}}', '{{DB_PASS}}', '{{TABLE_PREFIX}}'];
    $replace_vals = [$host, $user, $name, $pass, $prefix];

    $config_content = str_replace($replace_keys, $replace_vals, $config_template);

    file_put_contents('ph-config.php', $config_content);
    echo "✅ Configuration file 'ph-config.php' created successfully.\n";
}

/**
 * Execute multi-statement SQL to create tables.
 *
 * @param mysqli $conn MySQLi connection object
 * @param string $sql  The multi-statement SQL string
 * @return void
 */
function execute_sql($conn, string $sql) {
    if ($conn->multi_query($sql)) {
        do {
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->more_results() && $conn->next_result());
        echo "✅ Database tables created successfully.\n";
    } else {
        echo "❌ Error creating tables: (" . $conn->errno . ") " . $conn->error . "\n";
        exit(1);
    }
}

// Database credentials (replace these with your info)
$db_host = 'localhost';
$db_user = 'your_username';
$db_name = 'your_database';
$db_pass = 'your_password';
$table_prefix = 'ph_';

// Step 1: Create config file
create_config_file($db_host, $db_user, $db_name, $db_pass, $table_prefix);

// Step 2: Prepare table names
$pages_table  = $table_prefix . 'pages';
$users_table  = $table_prefix . 'users';
$config_table = $table_prefix . 'config';

// Step 3: Define SQL to create tables
$sql = <<<SQL
CREATE TABLE IF NOT EXISTS `$pages_table` (
    `page_id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `page_name` VARCHAR(256) NOT NULL,
    `content` LONGTEXT NOT NULL,
    `publish` VARCHAR(256) NOT NULL,
    `page_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`page_id`),
    KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `$users_table` (
    `user_id` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(256) NOT NULL,
    `email` VARCHAR(256) NOT NULL,
    `role` VARCHAR(256) NOT NULL,
    `password` VARCHAR(256) NOT NULL,
    `register_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_date` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `$config_table` (
    `config_id` INT(11) NOT NULL AUTO_INCREMENT,
    `config_name` VARCHAR(256) NOT NULL,
    `config_value` LONGTEXT NOT NULL,
    PRIMARY KEY (`config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SQL;

// Step 4: Connect to the MySQL database
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error . "\n");
}
echo "✅ Connected to MySQL database '{$db_name}' successfully.\n";

// Step 5: Create tables
execute_sql($conn, $sql);

// Step 6: Close connection
$conn->close();

echo "🎉 Setup completed successfully.\n";
