<?php
$config_sample = <<<'CONFIG'
<?php
// Preethub
// Version 0.3

define("DB_HOST", "__DB_HOST__");
define("DB_USER", "__DB_USER__");
define("DB_NAME", "__DB_NAME__");
define("DB_PASS", "__DB_PASS__");
define("TABLE_PREFIX", "__TABLE_PREFIX__");
CONFIG;

function create_config_file() {
    global $config_sample;
    $content = strtr($config_sample, [
        '__DB_HOST__' => DB_HOST,
        '__DB_USER__' => DB_USER,
        '__DB_NAME__' => DB_NAME,
        '__DB_PASS__' => DB_PASS,
        '__TABLE_PREFIX__' => TABLE_PREFIX
    ]);
    if (file_put_contents(dirname(__DIR__) . '/ph-config.php', trim($content) . PHP_EOL, LOCK_EX) === false) {
        throw new RuntimeException('Unable to create ph-config.php. Check directory permissions.');
    }
}

$tables_structure = [
    "CREATE TABLE IF NOT EXISTS {$phdb->pages} (
        page_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id INT UNSIGNED NOT NULL,
        page_name VARCHAR(256) NOT NULL,
        content LONGTEXT NOT NULL,
        publish VARCHAR(20) NOT NULL DEFAULT 'yes',
        page_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (page_id),
        KEY user_id (user_id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
    "CREATE TABLE IF NOT EXISTS {$phdb->users} (
        user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        username VARCHAR(256) NOT NULL,
        email VARCHAR(256) NOT NULL,
        role VARCHAR(64) NOT NULL DEFAULT 'Author',
        password VARCHAR(255) NOT NULL,
        register_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_date TIMESTAMP NULL DEFAULT NULL,
        PRIMARY KEY (user_id),
        UNIQUE KEY username (username),
        UNIQUE KEY email (email)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci",
    "CREATE TABLE IF NOT EXISTS {$phdb->config} (
        config_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
        config_name VARCHAR(256) NOT NULL,
        config_value LONGTEXT NOT NULL,
        PRIMARY KEY (config_id),
        UNIQUE KEY config_name (config_name)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci"
];
