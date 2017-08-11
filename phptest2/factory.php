<?php
if( !session_id() )
{
    session_start();
}
if (isset($_SESSION['login_time'])) {
    if(time() - $_SESSION['CREATED'] > 1800) {
    	session_unset($_SESSION['login_time']);
    }
}

$config = require "config.php";

require 'database/Connection.php';

require 'database/QueryBuilder.php';

$query = new QueryBuilder(
	Connection::make($config['database'])
);