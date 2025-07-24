<?php

/**
 * Phdb Database Helper Class
 * Elegant, robust MySQLi wrapper
 * Preethub - Released under GNU GPL
 */
class phdb
{
    private mysqli $link;

    /**
     * Constructor - Establishes database connection
     */
    public function __construct(
        string $dbHost,
        string $dbUser,
        string $dbPass,
        string $dbName
    ) {
        $this->link = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        if ($this->link->connect_error) {
            throw new Exception(
                'Database Connection Error (' .
                $this->link->connect_errno . '): ' .
                $this->link->connect_error
            );
        }
    }

    /**
     * Runs a general SQL query
     */
    public function query(string $sql): mysqli_result|bool
    {
        $result = $this->link->query($sql);
        if ($result === false) {
            throw new Exception('Query Error: ' . $this->link->error);
        }
        return $result;
    }

    /**
     * Returns the row count for a SELECT query
     */
    public function count(string $sql): int
    {
        $result = $this->query($sql);
        return $result->num_rows;
    }

    /**
     * Fetches multiple rows as objects
     */
    public function select(string $sql): array|false
    {
        $result = $this->query($sql);
        $rows = [];
        while ($row = $result->fetch_object()) {
            $rows[] = $row;
        }
        return !empty($rows) ? $rows : false;
    }

    /**
     * Fetches a single row as an object
     */
    public function getRow(string $sql): object|false
    {
        $result = $this->query($sql);
        if ($result->num_rows === 1) {
            return $result->fetch_object();
        }
        return false;
    }

    /**
     * Escapes a string for safe SQL usage
     */
    public function escape(string $str): string
    {
        return $this->link->real_escape_string($str);
    }

    /**
     * Closes the database connection
     */
    public function close(): void
    {
        if ($this->link) {
            $this->link->close();
        }
    }

    /**
     * Magic method for property assignment, e.g., dynamic table names
     */
    public function __set(string $name, $value): void
    {
        $this->$name = $value;
    }
}

// Usage Example
// $db = new phdb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// $db->config = TABLE_PREFIX . 'config';
// $db->pages = TABLE_PREFIX . 'pages';
// $db->users = TABLE_PREFIX . 'users';

?>
