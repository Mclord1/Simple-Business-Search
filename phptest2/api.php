<?php
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
if($method !== 'GET'){
  http_response_code(404);
  die("Error: ".mysqli_error());
}

$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));

$input = array_shift($request);

if(strlen($input) == 0){
  	
	die();
}
 
// connect to the mysql database
$link = require 'factory.php';

$result = $query->searchWhere('companies',$input);
 
// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die("Error: No business listed matching your search");
}
 
for ($i = 0;$i < count($result);$i++) {
  echo ($i>0?',':'').json_encode($result);
}