<?php
class phdb {
    public $link = null;
    public $config = null;
    public $pages = null;
    public $users = null;
    public $last_error = '';

    public function __construct($db_host, $db_user, $db_pass, $db_name) {
        $this->link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if (!$this->link) {
            die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
        if (!mysqli_set_charset($this->link, 'utf8mb4')) {
            die('Unable to set database charset: ' . mysqli_error($this->link));
        }
    }
    public function query($query) {
        $result = mysqli_query($this->link, $query);
        if ($result === false) $this->last_error = mysqli_error($this->link);
        return $result;
    }
    public function count($query) {
        $result = $this->query($query);
        return $result === false ? 0 : mysqli_num_rows($result);
    }
    public function select($query) {
        $result = $this->query($query);
        if ($result === false || mysqli_num_rows($result) === 0) return false;
        $arr = [];
        while ($res = mysqli_fetch_object($result)) $arr[] = $res;
        return $arr ?: false;
    }
    public function get_row($query) {
        $result = $this->query($query);
        if ($result === false || mysqli_num_rows($result) !== 1) return false;
        return mysqli_fetch_object($result) ?: false;
    }
    public function escape($str) {
        return mysqli_real_escape_string($this->link, (string)$str);
    }
}

$phdb = new phdb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$phdb->config = TABLE_PREFIX . 'config';
$phdb->pages  = TABLE_PREFIX . 'pages';
$phdb->users  = TABLE_PREFIX . 'users';
