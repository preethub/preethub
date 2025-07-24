<?php
/**
 * Preethub Setup Script
 * Version 0.3
 * 
 * Creates 'ph-config.php' from template and outputs SQL to create tables.
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
 * Creates the config file 'ph-config.php' replacing placeholders with provided values
 * 
 * @param string $host DB hostname
 * @param string $user DB username
 * @param string $name DB name
 * @param string $pass DB password
 * @param string $prefix Table prefix
 * 
 * @return void
 */
function create_config_file($host, $user, $name, $pass, $prefix = 'ph_') {
    global $config_template;
    
    $replace_keys = ['{{DB_HOST}}', '{{DB_USER}}', '{{DB_NAME}}', '{{DB_PASS}}', '{{TABLE_PREFIX}}'];
    $replace_vals = [$host, $user, $name, $pass, $prefix];
    
    $config_content = str_replace($replace_keys, $replace_vals, $config_template);
    
    file_put_contents('ph-config.php', $config_content);
    echo "✅ Configuration file 'ph-config.php' created successfully.\n\n";
}

// Your database credentials - replace these with actual values
$db_host = 'localhost';
$db_user = 'your_username';
$db_name = 'your_database';
$db_pass = 'your_password';
$table_prefix = 'ph_';

// Call function to create config file
create_config_file($db_host, $db_user, $db_name, $db_pass, $table_prefix);

// Define table names
$pages_table = $table_prefix . 'pages';
$users_table = $table_prefix . 'users';
$config_table = $table_prefix . 'config';

// SQL to create tables
$tables_sql = <<<SQL
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

// Output the SQL for user to run manually or run via DB script
echo "--- Preethub Database Table Creation SQL ---\n\n";
echo $tables_sql;
echo "\n\n";

// End of script
