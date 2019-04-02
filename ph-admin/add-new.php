<?php 
require('admin-header.php');
run_hook('admin_add_new_head');
if(isset($_GET['type'])){

if($_GET['type'] === 'page'){
add_page($user->user_id);
	 	echo '<div class="title">Add New Page</div>
     <div class="widget">  
     <div class="title">Add Page</div>
        <div class="card">  
          ' .get_messages() .'
                 <form action="add-new.php?type=page" method="post">                
       <label for="content">Page Name</label>
       <input type="text" name="pname" placeholder="Enter Post name" required>                                            
       <label for="content">Content</label>
       <textarea id="editor" name="pcontent" rows="4" placeholder="content" required></textarea>    
 <input type="submit" name="addpage">
       </form>
     </div>  
     </div>';	
	 
}elseif($_GET['type'] === 'user'){ 
 add_user(); 
 echo ' <div class="title">
         Add Users
        </div>
     <div class="widget">  
     <div class="title">
         Add Users
        </div>
<div class="card">    
  '. get_messages() .'
            <form action="add-new.php?type=user" method="post">                   
                  <label for="username">User Name<b> -> (Required)</b> </label>
                  <input name="username" type="text" placeholder="Enter your name" required>
   <label for="email">Email<b>->  (Required)</b></label>
                  <input name="email" type="text" placeholder="Enter your email" required>
            <label for="password">Password</label>
                  <input name="password" type="text" placeholder="Enter Your Password" required>                                 <input type="submit" name="add_user">              
              </form>
              </div>
            </div>';
	 }
}
		
	run_hook('admin_add_new_foot');
	 require('admin-footer.php');
?>