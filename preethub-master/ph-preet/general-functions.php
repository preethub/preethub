<?php
function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function site_url($path = '') {
    $base = rtrim((string)(get_config('site_url') ?? ''), '/');
    return $base . ($path !== '' ? '/' . ltrim($path, '/') : '');
}
function preet() {
    global $getparams;
    if (!empty($_GET)) {
        foreach (array_keys($_GET) as $key) {
            if (!in_array($key, $getparams, true)) {
                header('Location: ' . site_url());
                exit;
            }
        }
        if (isset($_GET['p'])) {
            $page = get_page();
            if (!$page) {
                http_response_code(404);
                echo 'Page not found';
                return;
            }
            page_title($page->page_name . ' - ' . get_config('site_name'));
            default_page_view();
        }
        run_hook('isset_getparam');
    } else {
        $page = get_page();
        if (!$page) {
            http_response_code(404);
            echo 'No published page found.';
            return;
        }
        page_title($page->page_name . ' - ' . get_config('site_name'));
        default_page_view();
    }
}
function is_logged() { return !empty($_SESSION['username']); }
function page_title($title = '') {
    global $page_title;
    if ($title !== '') $page_title = $title;
    return $page_title ?? '';
}
function get_messages() {
    if (!empty($_SESSION['messageinfo'])) {
        $message = $_SESSION['messageinfo'];
        unset($_SESSION['messageinfo']);
        return h($message);
    }
    return '';
}
function add_message($msg) { $_SESSION['messageinfo'] = (string)$msg; }
function run_hook($hook, $value = '') {
    global $ph_hooks;
    foreach (($ph_hooks[$hook] ?? []) as $function) {
        if (is_callable($function)) $value = call_user_func($function, $value);
    }
    return $value;
}
function add_hook($hook, $function) {
    global $ph_hooks;
    if (!isset($ph_hooks[$hook])) $ph_hooks[$hook] = [];
    $ph_hooks[$hook][] = $function;
    return true;
}
function pagination($total, $page, $perpage = 10) {
    $total = max(0, (int)$total);
    $perpage = max(1, (int)$perpage);
    $total_pages = (int)ceil($total / $perpage);
    if ($total_pages <= 1) return '';
    $page = max(1, min((int)$page, $total_pages));
    $params = $_GET;
    unset($params['page']);
    $query = http_build_query($params);
    $prefix = $query !== '' ? $query . '&' : '';
    $pages = '<ul class="pagination">';
    if ($page > 1) $pages .= '<li><a href="?' . h($prefix . 'page=' . ($page - 1)) . '">Prev</a></li>';
    for ($i=max(1,$page-3); $i<=min($page+3,$total_pages); $i++) {
        $pages .= $i === $page ? '<li class="current">' . $i . '</li>' :
            '<li><a href="?' . h($prefix . 'page=' . $i) . '">' . $i . '</a></li>';
    }
    if ($page < $total_pages) $pages .= '<li><a href="?' . h($prefix . 'page=' . ($page + 1)) . '">Next</a></li>';
    return $pages . '</ul>';
}
