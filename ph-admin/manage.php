<?php
require('admin-header.php');

run_hook('admin_manage_head');

// Get the request type and ID for deletion, if available
$type = $_GET['type'] ?? null;
$deleteId = $_GET['delete'] ?? null;

if ($type) {
    echo '<div class="title"><i class="fa fa-tachometer"></i> All ' . ucfirst($type) . 's</div>';
    echo '<div class="widget"><div class="card">';
    echo get_messages();

    if ($type === 'page') {
        if ($deleteId) {
            delete_page((int)$deleteId);
        }

        echo '<table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';

        if (total_pages() > 0) {
            foreach (get_pages() as $page) {
                echo '<tr>
                        <td>' . htmlspecialchars($page->page_id) . '</td>
                        <td>' . htmlspecialchars($page->page_name) . '</td>
                        <td>
                            <a href="' . get_config('site_url') . '/?p=' . $page->page_id . '">View</a> -
                            <a href="edit.php?type=page&id=' . $page->page_id . '">Edit</a> - ';

                if (get_config('site_index') === $page->page_id) {
                    echo '<span class="redtext"><b>Cannot Delete Index</b></span>';
                } else {
                    echo '<a href="?type=page&delete=' . $page->page_id . '" onclick="return confirm(\'Are you sure?\')"><b>Delete</b></a>';
                }

                echo '</td>
                    </tr>';
            }
        }

        echo '</tbody></table>';

    } elseif ($type === 'user') {
        if ($deleteId) {
            delete_user((int)$deleteId);
        }

        echo '<table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>';

        if (total_users() > 0) {
            foreach (get_users() as $user) {
                echo '<tr>
                        <td>' . htmlspecialchars($user->user_id) . '</td>
                        <td>' . htmlspecialchars($user->username) . '</td>
                        <td>' . htmlspecialchars($user->role) . '</td>
                        <td>';

                if (get_config('site_admin') === $user->username) {
                    echo '<div class="redtext">Super Administrator</div>';
                } else {
                    echo '<a href="?type=user&delete=' . $user->user_id . '" onclick="return confirm(\'Are you sure?\')"><b>Delete</b></a>';
                }

                echo '</td></tr>';
            }
        }

        echo '</tbody></table>';
    }

    echo '</div></div>';
}

run_hook('admin_manage_foot');
require('admin-footer.php');
