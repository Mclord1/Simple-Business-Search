<?php

$config = require "config.php";

require 'core/Request.php';

require 'core/Router.php';

require 'Models/Business.php';

require 'Models/Category.php';

require 'core/database/Connection.php';

require 'core/database/QueryBuilder.php';



require 'core/functions.php';


$query = new QueryBuilder(
	Connection::make($config['database'])
);

if( !session_id() )
{
    session_start();
}
lockout();

	
if($query->isAdmin()){
    $auth = $_SESSION['auth'];
}
if(isset($_SESSION['errors'])){
	$errors = $_SESSION['errors'];
}