<?php

/*---------------
 * General functions
 * Preethub
 * Released under GPL (http://www.gnu.org/licenses/gpl.txt)
 * github.com/preethub/preethub
 *---------------*/

// Define global variables upfront
$getparams  = ['p', 'page']; // Allowed GET parameters (adjust as per your app)
$ph_hooks   = [];
$page_title = '';

/**
 * Main controller function to handle incoming requests.
 */
function preet()
{
    global $getparams;

    if (!empty($_GET)) {
        $uri = explode('?', $_SERVER['REQUEST_URI']);
        if (isset($uri[1])) {
            // Sanitize the first GET parameter key
            $firstGetParam = explode('=', $uri[1]);
            $firstParamKey = filter_var($firstGetParam[0], FILTER_SANITIZE_STRING);

            if (!in_array($firstParamKey, $getparams)) {
                header('Location: ' . get_config('site_url'));
                exit;
            }
        }

        if (isset($_GET['p'])) {
            page_title(get_page()->page_name . ' - ' . get_config('site_name'));
            default_page_view();
        }

        // Run any attached hooks for 'isset_getparam'
        run_hook('isset_getparam');

    } else {
        page_title(get_page()->page_name . ' - ' . get_config('site_name'));
        default_page_view();
    }
}

/**
 * Check if user is logged in.
 * 
 * @return bool
 */
function is_logged(): bool
{
    return !empty($_SESSION['username']);
}

/**
 * Get or set the page title.
 * 
 * @param string $title
 * @return string|void
 */
function page_title(string $title = '')
{
    global $page_title;

    if ($title !== '') {
        $page_title = $title;
    } else {
        return $page_title;
    }
}

/**
 * Retrieve flash messages and clear them.
 * 
 * @return string|null
 */
function get_messages(): ?string
{
    if (!empty($_SESSION['messageinfo'])) {
        $message = $_SESSION['messageinfo'];
        unset($_SESSION['messageinfo']);
        return $message;
    }

    return null;
}

/**
 * Add a safe flash message.
 * 
 * @param string $msg
 */
function add_message(string $msg): void
{
    $_SESSION['messageinfo'] = htmlspecialchars($msg, ENT_QUOTES, 'UTF-8');
}

/**
 * Execute all callback functions attached to a hook.
 * 
 * @param string $hook
 * @param mixed  $value
 * @return mixed
 */
function run_hook(string $hook, $value = '')
{
    global $ph_hooks;

    if (isset($ph_hooks[$hook]) && is_array($ph_hooks[$hook])) {
        foreach ($ph_hooks[$hook] as $function) {
            if (is_callable($function)) {
                $value = call_user_func($function, $value);
            }
        }
    }

    return $value;
}

/**
 * Attach a callback function to a hook.
 * 
 * @param string   $hook
 * @param callable $function
 * @return bool
 */
function add_hook(string $hook, callable $function): bool
{
    global $ph_hooks;

    if (!isset($ph_hooks[$hook])) {
        $ph_hooks[$hook] = [];
    }

    $ph_hooks[$hook][] = $function;

    return true;
}

/**
 * Generate HTML pagination links.
 * 
 * @param int $total   Total number of items.
 * @param int $page    Current page number.
 * @param int $perpage Items per page. Default 10.
 * 
 * @return string HTML pagination markup.
 */
function pagination(int $total, int $page, int $perpage = 10): string
{
    $totalPages = (int)ceil($total / $perpage);
    $query      = '';

    // Retain all GET parameters except 'page', URL-encoded for safety
    foreach ($_GET as $key => $value) {
        if ($key !== 'page') {
            $query .= urlencode($key) . '=' . urlencode($value) . '&';
        }
    }

    $pages  = '<ul class="pagination">';

    if ($page > 4) {
        $pages .= '<li><a href="?' . $query . '">First</a></li>';
    }

    if ($page > 1) {
        $pages .= '<li><a href="?' . $query . 'page=' . ($page - 1) . '">Prev</a></li>';
    }

    $start = max(1, $page - 3);
    $end   = min($page + 3, $totalPages);

    for ($i = $start; $i <= $end; $i++) {
        if ($i === $page) {
            $pages .= '<li class="current">' . $i . '</li>';
        } else {
            $pages .= '<li><a href="?' . $query . 'page=' . $i . '">' . $i . '</a></li>';
        }
    }

    if ($page < $totalPages) {
        $pages .= '<li><a href="?' . $query . 'page=' . ($page + 1) . '">Next</a></li>';
    }

    if ($page < $totalPages - 3) {
        $pages .= '<li><a href="?' . $query . 'page=' . $totalPages . '">Last</a></li>';
    }

    $pages .= '</ul>';

    return $pages;
}

