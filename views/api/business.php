<?php
// get the HTTP method, path and body of the request
$method = $_SERVER['REQUEST_METHOD'];
if($method !== 'GET'){
	$refurl = $_SERVER['HTTP_REFERER'];
  header("HTTP/1.0 405 Method Not Allowed");
  exit();
}
if(!empty($_GET["business_id"]))
{
	$input = intval($_GET["business_id"]);
	if(!isInjected($input)){
		$result = $query->find('businesses','id',$input);
		header("HTTP/1.0 200 OK");
		header('Content-Type: application/json');
		$response = array(
				'status' => 1,
				'records_count' => count($result),
				'results' => $result
			);
		echo json_encode($response);
	}
		
}
else
{
	header("HTTP/1.0 403 Forbidden");
	exit();
}