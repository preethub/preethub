<?php 
require('admin-core.php');
require('admin-header.php');
?>    
  <div class="heading">Add new post</div>    
     <div class="card"> 
    <?php echo get_messages(); ?>
       <form action="add-post.php" method="post" enctype="multipart/form-data">                
       <label for="content">Post Name</label>
       <input type="text" name="pname" placeholder="Enter Post name" required>                                            
       <label for="content">Content</label>
       <textarea class="form-control" name="pcontent" rows="4" placeholder="content" required></textarea>                            				<input type="file" name="pimage" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />					<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a pic&hellip;</span></label>           
       <input type="submit" name="addpost">
       </form>
     </div>               
<?php require('admin-footer.php');
?>
