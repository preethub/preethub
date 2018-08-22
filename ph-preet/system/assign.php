<?php

$_url = get('url');

$url2 = get('url');
$_url = array_filter(explode('/', $_url));
if(!isset($_url[0])){
  $_url[0] = 'index';
  
}
if(!file_exists(view($_url[0]))){
  header("Location: ", 'index.php');
  $_url[0] = 'index';
}
