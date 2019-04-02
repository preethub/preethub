<?php

 /*-------------
 * Preet File
 * Preethub
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * github.com/preethub/preethub
 *------------*/

/*  PreetHub Version. */
$ph_version = "0.3";

/*--- PH_PATH ---*/
define('PH_PATH',dirname(__FILE__). '/');

// PLUGINS PATH
define('PLUGINS_PATH','ph-extend/plugins');

/*--- UPLOAD_PATH ---*/
define('UPLOAD_PATH', "ph-extend/uploads");

if(file_exists(dirname(__FILE__) . '/ph-config.php')){
require('ph-config.php');
}else{		if(file_exists('ph-install.php')){
header("location: ph-install.php");
 }elseif(file_exists(dirname(dirname(__FILE__) . '/ph-install.php'))){
header("location: ../ph-install.php"); 
 } 
}

require('ph-preet/query-functions.php');

require('ph-preet/phdb.php');

require('ph-preet/general-functions.php');

require('ph-preet/default-view.php');

/*--- Page get param ---*/
$getparams[] = 'p';

/*--- Require active plugins ---*/
if ( is_array(get_config('active_plugins')) ) {		
	foreach (get_config('active_plugins') as $plugin) {
			if ('' != $plugin && file_exists(PH_PATH . PLUGINS_PATH . '/' . $plugin))
				include_once(PH_PATH . PLUGINS_PATH . '/' . $plugin);
	  	} 
 }
