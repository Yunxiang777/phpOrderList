<?php
const BASE_PATH = '/VENDOR_DASHBOARD';
return [
    'app' => [
        'base_url' => BASE_PATH,
    ],
    'routes' => [
        'login' => BASE_PATH . '/pages/login/login.php',
        'home'  => BASE_PATH . '/index.php',
    ],
    'db' => [
        'host'   => 'localhost',
        'port'   => 3306,
        'dbname' => 'project',
        'user'   => 'root',
        'pass'   => '',
    ],
];
