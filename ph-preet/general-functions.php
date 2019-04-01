<?php

 /*---------------
 * General functions
 * Preethub
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * github.com/preethub/preethub
 *---------------*/


/*--- FUNCTION PREET ---*/
function preet(){
	global $getparams; 
if(!empty($_GET)){	
	$uri = explode("?",$_SERVER['REQUEST_URI']);
$firstgetname = explode("=",$uri[1]);	
		if(!in_array($firstgetname[0],$getparams)){			
header("location:" . get_config('site_url'));
		} 
		
if(isset($_GET['p'])){			 	
	page_title(get_page()->page_name ." - ". get_config('site_name'));	
	default_page_view();	
	}
		
/*--- RUN HOOK ISSET_GETPARAM---*/
run_hook('isset_getparam');
	
}else{	
	page_title(get_index()->page_name ." - ". get_config('site_name'));	
 	default_index_view();
	}
}

/*--- FUNCTION IS_LOGGED ---*/
function is_logged(){
if(!empty($_SESSION['username'])){
 return TRUE;
 }else{return FALSE;
    }
 }
 
 /*--- FUNCTION PAGE_TITLE ---*/
function page_title($title = ''){
global $page_title;
if($title){
 	$page_title = $title;
}else{
 return $page_title; 
 }
}

/*---  FUNCTION GET_MESSAGES ---*/
function get_messages(){
if(!empty($_SESSION['messageinfo'])){ $message = $_SESSION['messageinfo'];   
unset($_SESSION['messageinfo']); 
  return $message;  }           
 }

/*---  FUNCTION ADD_MESSAGES ---*/
function add_message($msg){
$_SESSION['messageinfo'] = $msg;
}

/*--- FUNCTION RUN_HOOK ---*/
	function run_hook($hook,$value = ''){
		 global $ph_hooks;
if(isset($ph_hooks[$hook]))		
{
 foreach($ph_hooks[$hook] as $function)
   { 
    if(is_callable($function)){
      $value = call_user_func($function, $value);
   }
 }
   return $value;
}else{
  return $value;
 }
}

/*--- FUNCTION ADD_HOOK ---*/
function add_hook($hook,$function){
 global $ph_hooks;
 $ph_hooks[$hook][] = $function;
 return true;
}

/*--- FUNCTION PAGINATION ---*/
function pagination($total, $page, $perpage = 10){
		
		$total_pages = ceil($total/$perpage);
		foreach($_GET as $k=>$v)
			if($k != 'page')
				$query .= "$k=$v&";
		$pages = '<ul class="pagination">';
		if($page > 4)
			$pages .= "<a href='?$query'>First</a> ";
		
		if($page > 1)
			$pages .= '<li><a href="?'. $query .'page='. ($page-1) .'">Prev</a></li> ';
			
		for($i = max(1, $page - 3); $i <= min($page + 3, $total_pages); $i++)
			$pages .= ($i == $page ? '<li class="current">'. $i .'</li>' : ' <li><a href="?'. $query .'page='. $i .'">'. $i .'</a></li> ');

		if($page < $total_pages)
			$pages .= '<li><a href="?'. $query .'page='.($page+1).'">Next</a></li>';
		
		if($page < $total_pages-3)
			$pages .= '<li><a href="?'. $query .'page='. $total_pages .'"> Last </a></li>';
		$pages .= '</ul>';
		return $pages;
	
}	
