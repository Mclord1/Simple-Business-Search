<?php

$router->get('' , 'index.php');

$router->get('login' , 'login.php');

$router->get('logout' , 'logout.php');

$router->post('login' , 'process_login.php');

$router->post('logout' , 'logout.php');

$router->get('businesses/search_results' , 'businesses_list.php');

$router->post('admin/images/delete', 'admin/delete_images.php');

$router->post('admin/images/update', 'admin/update_images.php');

$router->get('admin' , 'admin/dashboard.php');

$router->get('upload', 'image_upload.php');

$router->post('upload', 'tester.php');

$router->get('admin/business' , 'admin/business.php');

$router->get('admin/business/new' , 'admin/add_business.php');

$router->post('admin/business/save' , 'admin/save_business.php');

$router->get('admin/business/edit','admin/edit_business.php');

$router->post('admin/business/update','admin/update_business.php');

$router->post('admin/business/delete' , 'admin/delete_business.php');

$router->get('admin/categories','admin/categories.php');

$router->get('admin/views','admin/view_logs.php');

$router->get('business' , 'business_details.php');

$router->get('api/business', 'api/business.php');

$router->get('api/businesses', 'api/businesses.php');

$router->get('error/404','error-pages/HTTP404.html');

$router->get('error/403','error-pages/HTTP403.html');

$router->post('tester','tester.php');

$router->get('tester','tester.php');
