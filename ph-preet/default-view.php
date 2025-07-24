<?php
/**
 * Preethub Default View Template
 * Licensed under the GNU GPL (http://www.gnu.org/licenses/gpl.txt)
 * github.com/preethub/preethub
 */

/*==========================
    Default CSS Styles
==========================*/
function default_css() { ?>
    <style>
        :root {
            --primary-bg: #3d4f5d;
            --accent: #ed786a;
            --accent-hover: #fd887a;
            --sidebar-bg: #f0f0f0;
            --footer-bg: #e5e8e8;
            --border: #e5e5e5;
            --brand: #89b3cc;
            --link: #333;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: var(--link);
            background: #fafbfc;
        }

        a {
            color: var(--link);
            text-decoration: none;
            transition: color 0.2s;
        }
        a:hover, a:focus { color: var(--brand); text-decoration: underline; }

        header.header {
            background: var(--primary-bg);
            color: #fff;
            padding: 3em 2em;
            text-align: center;
            box-shadow: 0 1px 6px rgba(0,0,0,0.06);
        }
        .brand-title {
            font-size: 2.2em;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0 0 0.3em 0;
        }
        .brand-tagline {
            font-size: 1.1em;
            font-weight: 300;
            color: #b0cadb;
            margin: 0;
        }

        #sidebar {
            background: var(--sidebar-bg);
            padding: 1.5em 1em;
            border-right: 1px solid var(--border);
        }
            ul.widget {
                list-style: none;
                margin: 0;
                padding: 0;
            }
            ul.widget > h3 {
                font-size: 1.1em;
                font-weight: bold;
                margin-bottom: 0.7em;
            }
            ul.widget > li {
                padding: 0.6em 0;
                border-top: 2px solid var(--border);
            }
            ul.widget > li:last-child {
                border-bottom: 2px solid var(--border);
            }

        #content {
            padding: 2em 3em 1em 3em;
            background: #fff;
            min-height: 80vh;
        }

        .post-title {
            font-size: 2.1em;
            color: #2c3e50;
            margin-bottom: 0.4em;
        }
        .post-description {
            font-family: Georgia, Cambria, serif;
            font-size: 1.12em;
            color: #444;
            line-height: 1.8;
        }

        /* Forms */
        form label {
            font-weight: 600;
            color: #888;
            margin-bottom: 0.3em;
            display: block;
        }
        form input[type="text"],
        form input[type="password"],
        form input[type="email"],
        form textarea {
            width: 100%;
            padding: 0.75em 1em;
            border: none;
            border-radius: 5px;
            background: #e8e8e8;
            font-size: 1em;
            margin-bottom: 1.1em;
            transition: background 0.2s;
        }
        form input:focus, form textarea:focus {
            background: #f0f0f0;
            outline: 2px solid var(--brand);
        }
        form input[type="submit"], .button {
            background: var(--accent);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 1em 0;
            width: 100%;
            margin-top: 0.5em;
            cursor: pointer;
            transition: background 0.2s;
        }
        form input[type="submit"]:hover, .button:hover {
            background: var(--accent-hover);
        }

        /* Footer */
        #footer {
            text-align: center;
            background: var(--footer-bg);
            color: #888;
            padding: 1em 0;
            border-top: 2px solid var(--border);
            font-size: 0.98em;
        }

        /* Responsive */
        @media (min-width: 900px) {
            #content { width: 75%; float: left;}
            #sidebar { width: 25%; float: left;}
            header.header { text-align: left; }
        }
    </style>
<?php }

/*==========================
    HTML Structure Functions
==========================*/

function default_header_view() {
    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . htmlspecialchars(page_title()) . '</title>';
    default_css();
    echo '</head>
<body>
<header class="header">
    <h1 class="brand-title">' . htmlspecialchars(get_config('site_name')) . '</h1>
    <div class="brand-tagline">' . htmlspecialchars(get_config('site_description')) . '</div>
</header>';
}

function default_sidebar_view() {
    echo '<section id="sidebar">
    <ul class="widget">
        <h3>Links</h3>';
    if (is_logged()) {
        echo '<li><a href="' . htmlspecialchars(get_config('site_url')) . '/ph-action.php?action=logout">Logout</a></li>';
        if (loggeduser()->role === "Admin") {
            echo '<li><a href="' . htmlspecialchars(get_config('site_url')) . '/ph-admin">Admin Panel</a></li>';
        }
    } else {
        echo '<li><a href="' . htmlspecialchars(get_config('site_url')) . '/ph-action.php?action=login">Login</a></li>
              <li><a href="' . htmlspecialchars(get_config('site_url')) . '/ph-action.php?action=signup">Signup</a></li>';
    }
    run_hook('sidebar');
    echo '</ul>
</section>';
}

function default_footer_view() {
    echo '<footer id="footer">
        &copy; ' . date('Y') . ' ' . htmlspecialchars(get_config('site_name')) . '
    </footer>
</body>
</html>';
}

function default_login_view() {
    default_header_view();
    echo '<section id="content">
    <div class="card">
        <h3>Login</h3>' . get_messages() . '
        <form action="ph-action.php?action=login" method="post" autocomplete="off">
            <label for="login-username">User Name</label>
            <input type="text" id="login-username" name="username" placeholder="Your username" required>
            <label for="login-password">Password</label>
            <input type="password" id="login-password" name="password" placeholder="Your password" required>
            <input type="submit" value="Login" name="login">
        </form>
    </div>
</section>';
    default_footer_view();
}

function default_signup_view() {
    default_header_view();
    echo '<section id="content">
    <h2>Signup</h2>' . get_messages() . '
        <form action="ph-action.php?action=signup" method="post" autocomplete="off">
            <label for="signup-username">User Name</label>
            <input type="text" id="signup-username" name="username" placeholder="Your username" required>
            <label for="signup-email">Email</label>
            <input type="email" id="signup-email" name="email" placeholder="Your email" required>
            <label for="signup-password">Password</label>
            <input type="password" id="signup-password" name="password" placeholder="Your password" required>
            <input type="submit" value="Signup" name="signup">
        </form>
</section>';
    default_footer_view();
}

function default_page_view() {
    default_header_view();
    echo '<section id="content">
    <div class="post">
        <div class="post-title">' . htmlspecialchars(get_page()->page_name) . '</div>
        <div class="post-description">' . get_page()->content . '</div>
    </div>
</section>';
    default_sidebar_view();
    default_footer_view();
}
?>
