<?php 
require 'factory.php';
$auth = $query->auth('admin','password');
if($auth)
	var_dump($auth);
else
	echo "false";