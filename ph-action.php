<?php

 /*--------------
 * Ph-action file
 * Preethub
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * github.com/preethub/preethub
 *--------------*/


require('preet.php');

if(isset($_GET['action'])){	

$ph_action = $_GET['action'];

if($ph_action === 'login'){
	
	login(); default_login_view();
	
}elseif($ph_action === 'signup'){
	
	signup(); default_signup_view();
	
}elseif($ph_action === 'logout'){
	
	if(session_destroy()) { 
header("location:" . get_config('site_url'));
exit(0); }	 

}
}
?>