<?php
require 'admin-header.php';
run_hook('admin_manage_head');
$type=$_GET['type']??'';
if($type==='page'){
    delete_page();
?>
<div class="title"><i class="fa fa-file-text"></i> All Pages</div><div class="widget"><div class="card">
<?php echo get_messages(); ?>
<table><thead><tr><th>Id</th><th>Name</th><th>Action</th></tr></thead><tbody>
<?php foreach((get_pages() ?: []) as $page): ?>
<tr>
<td><?php echo (int)$page->page_id; ?></td>
<td><?php echo h($page->page_name); ?></td>
<td><a href="<?php echo h(site_url('?p='.$page->page_id)); ?>">View</a> -
<a href="edit.php?type=page&amp;id=<?php echo (int)$page->page_id; ?>">Edit</a> -
<?php if((int)get_config('site_index')===(int)$page->page_id): ?><b>Index page</b>
<?php else: ?><a href="?type=page&amp;delete=<?php echo (int)$page->page_id; ?>" onclick="return confirm('Are you sure?')"><b>Delete</b></a><?php endif; ?>
</td></tr>
<?php endforeach; ?>
</tbody></table></div></div>
<?php
}elseif($type==='user'){
    delete_user();
?>
<div class="title"><i class="fa fa-user"></i> All Users</div><div class="widget"><div class="card">
<?php echo get_messages(); ?>
<table><thead><tr><th>Id</th><th>Name</th><th>Role</th><th>Action</th></tr></thead><tbody>
<?php foreach((get_users() ?: []) as $udata): ?>
<tr><td><?php echo (int)$udata->user_id; ?></td><td><?php echo h($udata->username); ?></td><td><?php echo h($udata->role); ?></td>
<td><?php if((string)get_config('site_admin')===(string)$udata->username): ?><b>Super Administrator</b>
<?php else: ?><a href="?type=user&amp;delete=<?php echo (int)$udata->user_id; ?>" onclick="return confirm('Are you sure?')"><b>Delete</b></a><?php endif; ?></td></tr>
<?php endforeach; ?>
</tbody></table></div></div>
<?php } else { header('Location: index.php'); exit; }
run_hook('admin_manage_foot'); require 'admin-footer.php';
