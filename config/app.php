<?php
const BASE_PATH = '/VENDOR_DASHBOARD';
return [
    'app' => [
        'base_url' => BASE_PATH,
    ],
    'routes' => [
        'login' => BASE_PATH . '/pages/login.php',
        'logout' => BASE_PATH . '/app/auth/logout.php',
        'img' => BASE_PATH . '/public/img',
        'home'  => BASE_PATH,
    ],
    'db' => [
        'host'   => 'localhost',
        'port'   => 3306,
        'dbname' => 'project',
        'user'   => 'root',
        'pass'   => '',
    ],
    'api' => [
        'getAllEmployee' => BASE_PATH . '/api/employee/getAllEmployee.php',
        'addEmployee'    => BASE_PATH . '/api/employee/addEmployee.php',
        'updateEmployee' => BASE_PATH . '/api/employee/updateEmployee.php',
        'getEmployee'    => BASE_PATH . '/api/employee/getEmployee.php',
        'getAllMember'   => BASE_PATH . '/api/member/getAllMember.php',
        'addMember'      => BASE_PATH . '/api/member/addMember.php',
        'getMember'      => BASE_PATH . '/api/member/getMember.php',
        'updateMember'   => BASE_PATH . '/api/member/updateMember.php',
        'getAllFood'     => BASE_PATH . '/api/food/getAllFood.php',
        'addFood'        => BASE_PATH . '/api/food/addFood.php',
        'updateFood'     => BASE_PATH . '/api/food/updateFood.php',
        'getFood'        => BASE_PATH . '/api/food/getFood.php',
        'deleteFood'     => BASE_PATH . '/api/food/deleteFood.php',
        'getAllProduct'  => BASE_PATH . '/api/product/getAllProduct.php',
        'addProduct'     => BASE_PATH . '/api/product/addProduct.php',
        'updateProduct'  => BASE_PATH . '/api/product/updateProduct.php',
        'getProduct'     => BASE_PATH . '/api/product/getProduct.php',
        'deleteProduct'  => BASE_PATH . '/api/product/deleteProduct.php',
        'getAllVideo'    => BASE_PATH . '/api/video/getAllVideo.php',
        'addVideo'       => BASE_PATH . '/api/video/addVideo.php',
        'updateVideo'    => BASE_PATH . '/api/video/updateVideo.php',
        'getVideo'       => BASE_PATH . '/api/video/getVideo.php',
        'deleteVideo'    => BASE_PATH . '/api/video/deleteVideo.php',
    ],
    'menuItems' => [
        ['icon' => 'user-tie', 'label' => '員工列表', 'link' => BASE_PATH . '/pages/employee.php', 'sub' => '員工管理'],
        ['icon' => 'users', 'label' => '會員列表', 'link' => BASE_PATH . '/pages/member.php', 'sub' => '會員管理'],
        ['icon' => 'utensils', 'label' => '食物管理', 'link' => BASE_PATH . '/pages/fooddata.php', 'sub' => '食物列表'],
        ['icon' => 'box', 'label' => '商品管理', 'link' => BASE_PATH . '/pages/product.php', 'sub' => '商品檢視'],
        ['icon' => 'video', 'label' => '影音管理', 'link' => BASE_PATH . '/pages/video.php', 'sub' => '影音列表'],
        ['icon' => 'shopping-cart', 'label' => '訂單管理', 'link' => BASE_PATH . '/pages/table_AYun/realItem_order.php', 'sub' => '商品訂單'],
    ]
];
