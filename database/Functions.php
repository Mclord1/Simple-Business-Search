<?php
require 'factory.php';
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
//Ensure that a session exists (just in case)
if( !session_id() )
{
    session_start();
}

function flash($name, $message, $class)
{
    if( !empty( $_SESSION[$name] ) ){
        $_SESSION[$name] = $message;
        $_SESSION[$name.'_class'] = $class;
    }
    echo '{name},{message},{class}';
}
//Set the first flash message with default class

