<?php

if(isset($_POST['username'])){
	$user = strtolower($_POST['username']);
	$pass = $_POST['password'];
	$auth =  $query->auth($user,$pass);

	if($auth){
		$_SESSION['auth'] = $auth;
		$_SESSION['login_time'] = time();
		if(sessionCheck('prev_url')){
			$url = $_SESSION['prev_url'];
			header("Location: $url");
			unset($_SESSION['prev_url']);
			exit();
		}else{
			redirect('/admin');
		}
	}
	if(!$auth){
		$_SESSION['errors'] = [
				[
					'title' => 'username',
					'message' => 'invalid username or password']
			];
		$_SESSION['old'] = ['username' => $_POST['username']];
		redirect('/login');
	}
}
else{
	redirect('/login');
}
?>