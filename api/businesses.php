<?php
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
if($method !== 'GET'){
	$refurl = $_SERVER['HTTP_REFERER'];
  header("HTTP/1.0 405 Method Not Allowed");
  require 'error-pages/HTTP'.http_response_code().'.html';
  exit();
}
require '../factory.php';
if(!empty($_GET["business_name"]))
{
	$input = $_GET["business_name"];
	if(!isInjected($input)){
		$result = $query->searchWhere('companies',$input);
		header("HTTP/1.0 200 OK");
		header('Content-Type: application/json');
		$response = array(
				'status' => 1,
				'records_count' => count($result),
				'results' => (array) $result
			);
		echo json_encode($response);
	}
		
}
else
{
	$result = $query->selectAll('companies');
	header("HTTP/1.0 200 OK");
	header('Content-Type: application/json');
	$response = array(
			'status' => 1,
			'records_count' => count($result),
			'results' => (array) $result
		);
	echo json_encode($response);
}