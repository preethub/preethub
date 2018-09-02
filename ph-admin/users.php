<?php 
require('admin-core.php');
require('admin-header.php');
?>    
    <div class="heading">All Users</div>   
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
   <?php foreach ($udatas as $udata): ?><tr>
<td><?php echo $udata->id ?></td>  
<td> <?php echo $udata->username ?></td>        
                   <td> <?php	echo $udata->role;   ?>
               </td> <td> <?php if(site_info('site_admin') ===  $udata->username){ ?> <div class="redtext">Super Administrator</div> <?php }else{ ?> <a href="?deleteuser=<?php echo $udata->id; ?>" onclick= "if(! confirm('Are you sure?')){return false;}"><b>Delete</a></b> <?php } ?></td>
               </tr>    
            <?php endforeach ?>                                                              
                 </tbody>
                  </table>
                </div>                       
<?php require('admin-footer.php'); ?>
