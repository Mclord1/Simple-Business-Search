<?php

function oldInput($name){
	if(isset($_SESSION['old'])){
		echo $_SESSION['old'][$name];
		unset($_SESSION['old']);
	}
}
function sessionCheck($name){
	if(isset($_SESSION[$name]))
		return true;
	else
		return false;
}
function sess($name){
	echo $_SESSION[$name];
}

function flashSession($name){
	echo $_SESSION[$name];
	unset($_SESSION[$name]);
}

function allErrors(){
	if(errorsCheck()){
		echo $_SESSION['errors'];
	}
}
function isInjected($str)
{
	$injections = array(
		'(\n+)','(\r+)','(\t+)','(%0A+)',
		'(%0D+)','(%08+)','(%09+)'
		);
	$inject = join('|',$injections);
	$inject = "/inject/i";
	if(preg_match($inject, $str))
		return true;
	else
		return false;
}