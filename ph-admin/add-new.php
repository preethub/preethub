<?php 
require('admin-header.php');
run_hook('admin_add_new_head');

// Sanitize and get the 'type' parameter
$type = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : '';

switch ($type) {
    case 'page':
        // Handle form submission for adding a page
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addpage'])) {
            add_page($user->user_id);
        }
        ?>

        <div class="title">Add New Page</div>
        <div class="widget">
            <div class="title">Add Page</div>
            <div class="card">
                <?= get_messages(); ?>
                <form action="add-new.php?type=page" method="post">
                    <label for="pname">Page Name</label>
                    <input 
                        type="text" 
                        name="pname" 
                        id="pname" 
                        placeholder="Enter Page Name" 
                        required
                    >

                    <label for="pcontent">Content</label>
                    <textarea 
                        id="editor" 
                        name="pcontent" 
                        rows="6" 
                        placeholder="Enter content" 
                        required
                    ></textarea>

                    <input type="submit" name="addpage" value="Add Page">
                </form>
            </div>
        </div>

        <?php
        break;

    case 'user':
        // Handle form submission for adding a user
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
            add_user();
        }
        ?>

        <div class="title">Add Users</div>
        <div class="widget">
            <div class="title">Add Users</div>
            <div class="card">
                <?= get_messages(); ?>
                <form action="add-new.php?type=user" method="post">
                    <label for="username">User Name <b>(Required)</b></label>
                    <input 
                        type="text" 
                        name="username" 
                        id="username" 
                        placeholder="Enter your name" 
                        required
                    >

                    <label for="email">Email <b>(Required)</b></label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Enter your email" 
                        required
                    >

                    <label for="password">Password <b>(Required)</b></label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Enter your password" 
                        required
                    >

                    <input type="submit" name="add_user" value="Add User">
                </form>
            </div>
        </div>

        <?php
        break;

    default:
        echo '<p>Invalid type specified.</p>';
        break;
}

run_hook('admin_add_new_foot');
require('admin-footer.php');
?>
