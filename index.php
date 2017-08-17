<?php
require 'core/factory.php'; //require app dependencies

$router = Router::load('routes.php'); //get the routes.php file

require $router->direct(Request::uri(),Request::method()); //direct to destination based on method and url