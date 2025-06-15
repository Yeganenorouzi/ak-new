<?php

// Base paths
$config['paths'] = [
    'app_root' => dirname(__DIR__),
    'upload_dir' => dirname(dirname(__DIR__))
];

// Environment settings
$config['environment'] = 'development'; // or 'production'

// URL settings
$config['url'] = [
    'development' => 'http://localhost/ak-new',
    'production' => 'https://pfsh.ir'
];

// Database settings
$config['database'] = [
    'development' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'ak'
    ],
    'production' => [
        'host' => 'localhost',
        'username' => 'pfsh_ak1',
        'password' => 'Sg.yhoG4[4X}',
        'database' => 'pfsh_ak'
    ]
];

// Get current environment settings
$currentEnv = $config['environment'];

// Define constants for backward compatibility
define('APPROOT', $config['paths']['app_root']);
define('UploadImage', $config['paths']['upload_dir']);
define('URLROOT', $config['url'][$currentEnv]);
define('DB__Host', $config['database'][$currentEnv]['host']);
define('DB__USER', $config['database'][$currentEnv]['username']);
define('DB__PASS', $config['database'][$currentEnv]['password']);
define('DB__NAME', $config['database'][$currentEnv]['database']);