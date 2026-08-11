<?php
function total_users(){ global $phdb; return $phdb->count("SELECT user_id FROM {$phdb->users}"); }
function total_pages(){ global $phdb; return $phdb->count("SELECT page_id FROM {$phdb->pages}"); }
function get_users(){ global $phdb; return $phdb->select("SELECT * FROM {$phdb->users} ORDER BY user_id ASC"); }
function get_pages(){ global $phdb; return $phdb->select("SELECT * FROM {$phdb->pages} ORDER BY page_id ASC"); }

function delete_page(){
    global $phdb;
    if (!isset($_GET['delete'])) return;
    $id=(int)$_GET['delete'];
    if($id<1) return;
    $index=(int)(get_config('site_index') ?? 0);
    if($id===$index){ add_message('Index page can not be deleted'); return; }
    if($phdb->query("DELETE FROM {$phdb->pages} WHERE page_id={$id}")){
        add_message('Page successfully deleted'); header('Location: manage.php?type=page'); exit;
    }
    add_message('Unable to delete page: '.$phdb->last_error);
}
function delete_user(){
    global $phdb;
    if (!isset($_GET['delete'])) return;
    $id=(int)$_GET['delete']; if($id<1) return;
    $admin=(string)get_config('site_admin');
    $target=$phdb->get_row("SELECT username FROM {$phdb->users} WHERE user_id={$id}");
    if(!$target || $target->username===$admin){ add_message('The site administrator cannot be deleted.'); return; }
    if($phdb->query("DELETE FROM {$phdb->users} WHERE user_id={$id}") &&
       $phdb->query("DELETE FROM {$phdb->pages} WHERE user_id={$id}")){
        add_message('User successfully deleted'); header('Location: manage.php?type=user'); exit;
    }
    add_message('Unable to delete user: '.$phdb->last_error);
}
function add_page($user){
    global $phdb;
    if(!isset($_POST['addpage'])) return;
    $pname=$phdb->escape(trim((string)($_POST['pname']??'')));
    $pcontent=$phdb->escape((string)($_POST['pcontent']??''));
    if($pname===''){add_message('Page name is required');return;}
    $uid=(int)$user;
    if($phdb->query("INSERT INTO {$phdb->pages}(page_name,user_id,content,publish) VALUES ('{$pname}',{$uid},'{$pcontent}','yes')")){
        add_message('Post successfully added'); header('Location: add-new.php?type=page'); exit;
    }
    add_message('Unable to add page: '.$phdb->last_error);
}
function edit_page($id){
    global $phdb;
    if(!isset($_POST['editpage'])) return;
    $id=(int)$id;
    $pname=$phdb->escape(trim((string)($_POST['pname']??'')));
    $pcontent=$phdb->escape((string)($_POST['pcontent']??''));
    if($id<1||$pname===''){add_message('Invalid page data');return;}
    if($phdb->query("UPDATE {$phdb->pages} SET page_name='{$pname}', content='{$pcontent}' WHERE page_id={$id}")){
        add_message('Page successfully updated'); header("Location: edit.php?type=page&id={$id}"); exit;
    }
    add_message('Unable to update page: '.$phdb->last_error);
}
function add_user(){
    global $phdb;
    if(!isset($_POST['add_user'])) return;
    $username=trim((string)($_POST['username']??'')); $email=trim((string)($_POST['email']??'')); $password=(string)($_POST['password']??'');
    if($username===''||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($password)<8){add_message('Valid username, email and password (8+ characters) are required');return;}
    $u=$phdb->escape($username);$e=$phdb->escape($email);
    if($phdb->get_row("SELECT user_id FROM {$phdb->users} WHERE username='{$u}' OR email='{$e}'")){add_message('Username or email already exists');return;}
    $hash=$phdb->escape(password_hash($password,PASSWORD_DEFAULT));
    if($phdb->query("INSERT INTO {$phdb->users}(role,email,username,password) VALUES ('Author','{$e}','{$u}','{$hash}')")){
        add_message('User added successfully.'); header('Location: add-new.php?type=user'); exit;
    }
    add_message('Unable to add user: '.$phdb->last_error);
}
function settings(){
    global $phdb;
    if(!isset($_POST['settings'])) return;
    $siteurl=$phdb->escape(trim((string)($_POST['siteurl']??'')));
    $sitename=$phdb->escape(trim((string)($_POST['sitename']??'')));
    $sitedesc=$phdb->escape(trim((string)($_POST['sitedesc']??'')));
    if($siteurl!=='' && !filter_var($siteurl,FILTER_VALIDATE_URL)){add_message('Invalid site URL');return;}
    $ok=$phdb->query("UPDATE {$phdb->config} SET config_value='{$siteurl}' WHERE config_name='site_url'")
       &&$phdb->query("UPDATE {$phdb->config} SET config_value='{$sitename}' WHERE config_name='site_name'")
       &&$phdb->query("UPDATE {$phdb->config} SET config_value='{$sitedesc}' WHERE config_name='site_description'");
    if($ok){add_message('Successfully settings updated');header('Location: settings.php');exit;}
    add_message('Unable to update data: '.$phdb->last_error);
}
