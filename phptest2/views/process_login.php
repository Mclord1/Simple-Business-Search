<?php
require '../factory.php';


if(isset($_POST['username'])){
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$auth =  $query->auth($user,$pass);

	if($auth){
		$_SESSION['auth'] = $auth;
		$_SESSION['auth_lastactive'] = time();
		header("Location: /views/admin/dashboard.php");
	}
	if(!$auth){
		$_SESSION['errors'] = [
			'username' => [ 'message' => 'invalid username or password']
			];
		$_SESSION['old'] = ['username' => $_POST['username']];
		header("Location: login.php");
	}
}
else{
	header("Location: login.php");
}
?>