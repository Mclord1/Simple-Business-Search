<?php

if( !session_id() )
{
    session_start();
}

if(isset($_POST['username'])){
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$auth =  $query->auth($user,$pass);

	if($auth){
		$_SESSION['auth'] = $auth;
		header("Location: dashboard.php");
	}
	if(!$auth){
		$_SESSION['error'] = [
			'message' => 'invalid username or password'
			];
		$_SESSION['old'] = ['username' => $_POST['username']];
		header("Location: login.php");
	}
}
else{
	header("Location: login.php");
}
?>