<?php

$config = require "config.php";

require 'database/Connection.php';

require 'database/QueryBuilder.php';

require 'functions.php';

$query = new QueryBuilder(
	Connection::make($config['database'])
);

if( !session_id() )
{
    session_start();
}
if (isset($_SESSION['login_time']) && time() - $_SESSION['login_time'] > 120) {
	$_SESSION['prev_url'] = $_SERVER['REQUEST_URI'];
	$_SESSION['old'] = ['username' => $_SESSION['auth']->username];
	unset($_SESSION['login_time']);
	unset($_SESSION['auth']);
	$_SESSION['errors'] = [
		['title' => 'Session Timeout',
		'message' => 'Session was inactive for over 1800s']
		];
}

	
if($query->isAdmin()){
    $auth = $_SESSION['auth'];
}
if(isset($_SESSION['errors'])){
	$errors = $_SESSION['errors'];
}