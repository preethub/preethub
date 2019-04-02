<?php
require('admin-header.php');

run_hook('admin_manage_head');

if(isset($_GET['type'])){

if($_GET['type'] === 'page'){  

delete_page(); ?>
   
  	<div class="title">	<i class="fa fa-tachometer"></i> All Pages</div> 
     <div class="widget">
   <div class="card">   
    <?php echo get_messages(); ?>
                   <table>
                    <thead>
                      <tr>        
                  <th>Id</th>        
                  <th>Name</th>   
                  <th>Action</tr>
                      </tr>
                    </thead>
                    <tbody>
 <?php
 if(total_pages() > 0){
  foreach (get_pages() as $page): ?>
 <tr>
<td> <?php echo $page->page_id; ?></td>
<td> <?php echo $page->page_name; ?> </td>
<td> <?php echo $page->page_name; ?> </td>
<td> <a href="<?php echo get_config('site_url'); ?>/?p=<?php echo $page->page_id ?>">View</a> - <a href="edit.php?type=page&id=<?php echo $page->page_id ?>">Edit</a> - <?php if(get_config('site_index') ===  $page->page_id){ ?> <a onclick= "alert('Index page can not be deleted')"><b>Delete</b></a> <?php }else{ ?> <a href="?type=page&delete=<?php echo $page->page_id; ?>" onclick= "if(! confirm('Are you sure?')){return false;}"><b>Delete</b></a>  <?php } ?></td>
</tr>
 <?php endforeach; } ?>                                                                       
                 </tbody>
                  </table>   
                </div>               
                </div>
 
 <?php     
}elseif($_GET['type'] === 'user'){

delete_user();
?>
     <div class="title">	<i class="fa fa-tachometer"></i> All Users</div> 
      <div class="widget">
     <div class="card"> 
    <?php echo get_messages(); ?>
                   <table>
                    <thead>
                      <tr>        
                  <th>Id</th>        
                  <th>Name</th>   
                  <th>Role </th>       
                  <th>Action</tr>
                      </tr>
                    </thead>
                    <tbody>
   <?php 
   if(total_users() > 0){
   foreach (get_users() as $udata): ?><tr>
<td><?php echo $udata->user_id ?></td>  
<td> <?php echo $udata->username ?></td>        
                   <td> <?php	echo $udata->role;   ?>
               </td> <td> <?php if(get_config('site_admin') ===  $udata->username){ ?> <div class="redtext">Super Administrator</div> <?php }else{ ?> <a href="?type=user&delete=<?php echo $udata->user_id; ?>" onclick= "if(! confirm('Are you sure?')){return false;}"><b>Delete</a></b> <?php } ?></td>
               </tr>    
            <?php endforeach; }?>                                                              
                 </tbody>
                  </table> 
                    </div>                
                </div>
 	
 	    

<?php
 
  	} 
}		

run_hook('admin_manage_foot');

require('admin-footer.php');            
