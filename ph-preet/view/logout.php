<?php  
if(session_destroy()) { 
header("Location: $site_url"); 
}
