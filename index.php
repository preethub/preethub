<?php
/**
 * Index File for Preethub
 * 
 * Licensed under the GNU General Public License (GPL)
 * GitHub: https://github.com/preethub/preethub
 */

declare(strict_types=1);

// Start the session to maintain user state across requests
session_start();

// Include the main application logic
require_once 'preet.php';

// Execute the core function to handle the request
preet();
