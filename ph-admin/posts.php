<?php 
require('admin-core.php');
require('admin-header.php');
?>    
<div class="heading">
  All Posts
</div>  
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
 <?php foreach ($posts as $post): ?>
 <tr>
<td> <?php echo $post->id; ?></td>
<td> <?php echo $post->name; ?> </td>
<td> <a href="?deletepost=<?php echo $post->id; ?>" onclick= "if(! confirm('Are you sure?')){return false;}"><b>Delete</b></a></td>
 </tr>
 <?php endforeach ?>                                                                       
                 </tbody>
                  </table>
                </div>
<?php require('admin-footer.php'); ?>
