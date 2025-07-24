<?php 
require 'admin-header.php';
run_hook('admin_edit_head');

// Validate 'type' and 'id' in GET parameters
if (isset($_GET['type'], $_GET['id']) && $_GET['type'] === 'page') {
    $id = (int) $_GET['id'];
    $page = get_page($id);

    // Handle form submission for editing page
    if (isset($_POST['editpage'])) {
        edit_page($id);
        $page = get_page($id); // Refresh data after update
    }
    ?>

    <div class="title">Edit Page</div>

    <div class="widget">
        <div class="title">Edit Page</div>

        <div class="card">
            <?php echo get_messages(); ?>

            <form action="edit.php?type=page&id=<?php echo $id; ?>" method="post">
                <label for="pname">Page Name</label>
                <input 
                    type="text" 
                    id="pname" 
                    name="pname" 
                    value="<?php echo htmlspecialchars($page->page_name); ?>" 
                    required
                >

                <label for="editor">Content</label>
                <textarea 
                    id="editor" 
                    name="pcontent" 
                    rows="6" 
                    required
                ><?php echo htmlspecialchars($page->content); ?></textarea>

                <input 
                    type="submit" 
                    name="editpage" 
                    value="Update Page"
                >
            </form>
        </div>
    </div>

    <?php
} else {
    // Redirect to dashboard if parameters are missing or invalid
    header("Location: index.php");
    exit;
}

run_hook('admin_edit_foot');
require 'admin-footer.php';
?>
