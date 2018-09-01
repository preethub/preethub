<?php

define("dir", realpath("."));

function filterUrl($str){
  return htmlspecialchars(trim($str));
}

function get($name){
  if(isset($_GET[$name])){

    if (is_array($_GET[$name])){
      return array_map(function($item){
        return filterUrl($item);
      }, $_GET[$name]);
    }
    return filterUrl($_GET[$name]);

  }
  return false;
}

function get_url($name){

return dir. '/ph-preet/view/' .$name. '.php';

}


function stylesheet($css){
	
 global $site_url;	
 
 echo '<link rel="stylesheet" type="text/css" href="' .$site_url. '/ph-preet/view/style/css/' .$css .'">';		
}


function is_logged(){
if(!empty($_SESSION['username'])){
 return TRUE;
 return FALSE;
 }
 }
 
 function page_title(){
 global $page_title;
 
 return $page_title;
}


function site_info($name){

global $db;

$result = $db->get_row("SELECT * FROM `". PH_PREFIX ."config` Where name='$name'");

return $result->value;

}		

function pagination($baseUrl, $totalResults, $resultsPerPage, $currentPage) {
    $totalPages = ceil($totalResults/$resultsPerPage); 
    if($totalPages <=1 )
    return '';
    $queryString = ''; 
  $rightLinks = $currentPage+3;
 $previousLinks = $currentPage-3;
    ob_start();    
    ?>
    <div class="card">
    <ul class="pagination">       
            <?php                  if($currentPage == 1) {     ?>            
  <?php 
    } if($currentPage > 1) {   ?>           <li><a href="<?php echo $baseUrl.'/page/'.($currentPage-1); ?>">Previous</a></li>
            <?php 
        }
        for($i = $previousLinks; $i <= $currentPage; $i++){
            if($i>0) {                if($i==$currentPage) { ?>
                    <li class="current"><a href=""><?php echo $i; ?></a></li>
            <?php } else { ?>
       <li>
      <a href="<?php echo $baseUrl.'/page/'.$i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php }    
            }            
        }
        if(false)
        for($i=1; $i<=$totalPages; $i++) {
            if($i==$currentPage) { ?>
      <li class="active"><a href=""><?php echo $i; ?></a></li>
            <?php }   else { ?>
                <li>
          <a href="<?php echo $baseUrl.'/page/'.$i; ?>"><?php echo $i; ?></a>
                </li>
        <?php }        }
        for($i = $currentPage+1; $i < $rightLinks ; $i++){
            if($i<=$totalPages){               if($i==$currentPage) { ?>
                    <li class="active"><a href=""><?php echo $i; ?></a></li>
       <?php }  else { ?>   <li><a href="<?php echo $baseUrl.'/page/'.$i; ?>"><?php echo $i; ?></a>
                    </li>
                    <?php
                }
            }
        }
        if($currentPage != $totalPages) { ?>
             <li><a href="<?php echo $baseUrl.'/page/'.($currentPage+1); ?>">Next</a></li>
       <?php   }  ?>
    </ul>
    </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
