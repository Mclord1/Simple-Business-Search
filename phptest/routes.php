<?php

$routes->define([
	'' => 'Views/index.php',
	'business_list' => 'Views/business_list.php',
	'admin/login' => 'Views/admin/login.php',
	'admin' => 'Views/admin/dashboard.php',
	'admin/businesses' => 'Views/admin/all_businesses.php',
	'admin/business' => 'Views/admin/show_business.php',
	'admin/business/add' => 'Views/admin/add_business.php',
	'admin/business/edit' => 'Views/admin/edit_business.php',
	'admin/business/delete' => 'Views/admin/delete_business.php',

	'admin/categories' => 'Views/admin/all_catgories',
	'admin/category' => 'Views/admin/show_category.php',
	'admin/category/add' => 'Views/admin/add_category.php',
	'admin/category/edit' => 'Views/admin/edit_category.php',
	'admin/category/delete' => 'Views/admin/delete_category.php',
]);