<?php require_once 'admin-core.php'; ?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title><?php echo h(get_config('site_name')); ?></title>
<link rel="stylesheet" href="style/font-awesome/css/font-awesome.css"><link rel="stylesheet" href="style/admin.css">
<?php run_hook('admin_head'); ?></head><body>
<div class="header"><a href="#" class="nav-trigger"><span></span></a><div class="logo"><a href="<?php echo h(site_url()); ?>"><span><?php echo h(get_config('site_name')); ?></span></a></div></div>
<div class="side-nav"><div class="logo"><i class="fa fa-tachometer"></i><span><?php echo h(get_config('site_name')); ?></span></div><nav><ul>
<?php run_hook('admin_menu'); foreach($admin_menu as $menuname=>$menud): ?>
<li><a href="<?php echo h($menud['url']); ?>"><span><i class="fa <?php echo h($menud['icon']); ?>"></i></span><span><?php echo h($menuname); ?></span></a>
<?php if(!empty($admin_submenu[$menuname])): ?><ul class="submenu">
<?php foreach($admin_submenu[$menuname] as $sub): ?><li><a href="<?php echo h($sub['url']); ?>"><?php echo h($sub['name']); ?></a></li><?php endforeach; ?>
</ul><?php endif; ?></li>
<?php endforeach; ?></ul></nav></div><div class="main-content">
