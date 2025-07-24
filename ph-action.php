<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*--------------
 * Ph-action file
 * Preethub
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 * github.com/preethub/preethub
 *--------------*/

require 'preet.php';

session_start();

$action = $_GET['action'] ?? null;

switch ($action) {
    case 'login':
        login();
        default_login_view();
        break;

    case 'signup':
        signup();
        default_signup_view();
        break;

    case 'logout':
        // Destroy session and redirect to site URL
        if (session_destroy()) {
            header('Location: ' . get_config('site_url'));
            exit;
        } else {
            // Optional: Handle failure to destroy session
            echo "Error logging out.";
        }
        break;

    default:
        // Optional: handle unknown or missing action
        // For example, show homepage or error message
        // echo "Unknown action.";
        break;
}
