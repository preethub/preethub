<?php
require 'admin-header.php';
run_hook('admin_edit_head');
if (($_GET['type'] ?? '') === 'page') {
    $id=(int)($_GET['id']??0);
    $page=get_page($id);
    if(!$page){echo '<div class="card">Page not found.</div>'; require 'admin-footer.php'; exit;}
    edit_page($id);
?>
<div class="title">Edit Page</div><div class="widget"><div class="title">Edit Page</div><div class="card">
<?php echo get_messages(); ?>
<form action="edit.php?type=page&amp;id=<?php echo $id; ?>" method="post">
<label>Page Name</label><input type="text" name="pname" value="<?php echo h($page->page_name); ?>" required>
<label>Content</label><textarea id="editor" name="pcontent" rows="8" required><?php echo h($page->content); ?></textarea>
<input type="submit" name="editpage" value="Save">
</form></div></div>
<?php } else { header('Location: index.php'); exit; }
run_hook('admin_edit_foot'); require 'admin-footer.php';
