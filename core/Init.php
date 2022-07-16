<?php
ob_start();
session_start();

// Define Constants
$get_post_id = $_GET['post_id'] ?? '';
define('URL', 'http://testcoffeecode.epizy.com/post?post_id=' . $get_post_id . '');


$GLOBALS['config'] = array(
    'mysql' => array(

        // Testing
        'host' => 'sql106.epizy.com',
        'username' => 'epiz_31912741',
        'password' => 'Poginyomaster09',
        'db' => 'epiz_31912741_cms'

        // True Site
        // 'host' => 'sql104.epizy.com',
        // 'username' => 'epiz_31693787',
        // 'password' => 'Poginyomaster08',
        // 'db' => 'epiz_31693787_cms'

        // Localhost
        // 'host' => 'localhost',
        // 'username' => 'root',
        // 'password' => '',
        // 'db' => 'cms'
    ),
    'remember' => array(
        'cookie_name' => 'Hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token',
    )
);
