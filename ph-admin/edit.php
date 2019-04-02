<?php 
require('admin-header.php');
run_hook('admin_edit_head');
if(isset($_GET['type'])){

if($_GET['type'] === 'page'){ 
$id = $_GET['id'];
	$page = get_page($id);
edit_page($id);?>
	 <div class="title">Edit Page</div>
     <div class="widget">  
     <div class="title">Edit Page</div>
        <div class="card"> 
    <?php echo get_messages(); ?>
       <form action="edit.php?type=page&id=<?php echo $id ?>" method="post">                
       <label for="content">Page Name</label>
       <input type="text" name="pname" value="<?php echo $page->page_name ?>" required>                                            
       <label for="content">Content</label>
       <textarea id="editor" name="pcontent" rows="4" placeholder="" required><?php echo $page->content ?></textarea>    
 <input type="submit" name="editpage">
       </form>
     </div>  
     </div>
<?php
	} }else{
		header("location: index.php");
	}	
	run_hook('admin edit_foot');
	 require('admin-footer.php');
?>