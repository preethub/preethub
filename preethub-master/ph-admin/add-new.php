<?php
require 'admin-header.php';
run_hook('admin_add_new_head');
$type=$_GET['type']??'';
if($type==='page'){
    add_page($user->user_id);
?>
<div class="title">Add New Page</div><div class="widget"><div class="title">Add Page</div><div class="card">
<?php echo get_messages(); ?><form action="add-new.php?type=page" method="post">
<label>Page Name</label><input type="text" name="pname" required>
<label>Content</label><textarea id="editor" name="pcontent" rows="8" required></textarea>
<input type="submit" name="addpage" value="Add Page"></form></div></div>
<?php
}elseif($type==='user'){
    add_user();
?>
<div class="title">Add User</div><div class="widget"><div class="title">Add User</div><div class="card">
<?php echo get_messages(); ?><form action="add-new.php?type=user" method="post">
<label>Username</label><input name="username" type="text" required>
<label>Email</label><input name="email" type="email" required>
<label>Password</label><input name="password" type="password" minlength="8" required>
<input type="submit" name="add_user" value="Add User"></form></div></div>
<?php } else { header('Location: index.php'); exit; }
run_hook('admin_add_new_foot'); require 'admin-footer.php';
