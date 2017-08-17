<?php

function oldInput($name)
{
	if(isset($_SESSION['old'][$name])){
		echo $_SESSION['old'][$name];
		unset($_SESSION['old'][$name]);
	}
}

function redirect($uri)
{
	header("Location: $uri");
}

function addSession($name, $value)
{
	return $_SESSION[$name] = $value;
}
function unsetSession($name){
	unset($_SESSION[$name]);
}
function sessionCheck($name)
{
	if(isset($_SESSION[$name]))
		return true;
	else
		return false;
}
function sess($name)
{
	if(isset($_SESSION[$name])){
		echo $_SESSION[$name];
	}
}

function flash($name,$class)
{
	if(isset($_SESSION[$name])){
		echo '<div class="alert alert-'.$class.'">
			<p>'.$_SESSION[$name].'</p>
		</div>';
		unset($_SESSION[$name]);
	}
}

function allErrors()
{
	if(errorsCheck()){
		echo $_SESSION['errors'];
	}
}

function lockout()
{
	if(isset($_SESSION['login_time']) && time() - $_SESSION['login_time'] > 3600) {
		$_SESSION['old'] = ['username' => $_SESSION['auth']->username];
		unset($_SESSION['login_time']);
		unset($_SESSION['auth']);
		$_SESSION['errors'] = [
			['title' => 'Session timed out',
			'message' => 'No activity for over 60mins']
		];
	}
}

function isInjected($str)
{
	$injections = array(
		'(\n+)','(\r+)','(\t+)','(%0A+)',
		'(%0D+)','(%08+)','(%09+)','(/<(.|\n)*?>/g)',
		);
	$inject = join('|',$injections);
	$inject = "/inject/i";
	if(preg_match($inject, $str))
		return true;
	else
		return false;
}
function random_code($limit)
{
    return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
}
function admin()
{
	if(isset($_SESSION['auth']))
	{
		return $_SESSION['auth'];
	}
}
function validator()
{
	$validator = [
		"int" => "FILTER_VALIDATE_INT",
		"boolean" => "FILTER_VALIDATE_BOOLEAN",
		"float" => "FILTER_VALIDATE_FLOAT",
		"validate_regexp" => "FILTER_VALIDATE_REGEXP",
		"url" => "FILTER_VALIDATE_URL",
		"email" => "FILTER_VALIDATE_EMAIL",
		"validate_ip" => "FILTER_VALIDATE_IP",
		"string" => "FILTER_SANITIZE_STRING",
		"stripped" => "FILTER_SANITIZE_STRIPPED",
		"encoded" => "FILTER_SANITIZE_ENCODED",
		"special_chars" => "FILTER_SANITIZE_SPECIAL_CHARS",
		"full_special_chars" => "FILTER_SANITIZE_FULL_SPECIAL_CHARS",
		"sanitize_email" => "FILTER_SANITIZE_EMAIL",
		"sanitize_url" => "FILTER_SANITIZE_URL",
		"number_int" => "FILTER_SANITIZE_NUMBER_INT",
		"number_float" => "FILTER_SANITIZE_NUMBER_FLOAT",
		"magic_quotes" => "FILTER_SANITIZE_MAGIC_QUOTES",
		"callback" => 	"FILTER_CALLBACK",
	];
	return $validator;
}
function validate($method,$rules)
{
	$validator = validator();
	foreach ($rules as $key => $value) {
		if(array_key_exists($value, $validator)){
			$rules[$key] = $validator[$value];
		}
	}
	$outputs = filter_input_array($method, $rules);
	return $outputs;
}

function uploadImages($upload_name,$folder,$mimetype){
 	$currentDir = getcwd();
    
	$uploadDirectory = "/public/".$folder."/";

	$errors = []; // Store all foreseen and unforseen errors here

	$fileExtensions = $mimetype; // Get all the file extensions

	$file_paths= [];

	foreach ($_FILES[$upload_name]['name'] as $key => $value) {
	    
	    $uniqid = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 8);

	    $fileName = $_FILES[$upload_name]['name'][$key];
	    
	    $fileSize = $_FILES[$upload_name]['size'][$key];
	    
	    $fileTmpName  = $_FILES[$upload_name]['tmp_name'][$key];
	    
	    $fileType = $_FILES[$upload_name]['type'][$key];
	    
	    $fileExtension = strtolower(end(explode('.',$fileName)));

	    $filePath = $uploadDirectory . time() . $uniqid . str_replace(' ', '_', basename($fileName));

	    $uploadPath = $currentDir . $filePath; 


	    if (! in_array($fileExtension,$fileExtensions)) {
	        
	        array_push($errors,"This file extension is not allowed. Please upload a JPEG or PNG file");

	    }
	    if ($fileSize > 2000000) {
	        
	        array_push($errors,"This file is more than 2MB. Sorry, it has to be less than or equal to 2MB");

	    }

	    if (empty($errors)) {
	        
	        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

	        if ($didUpload) {
	            array_push($file_paths, $filePath);
	            
	        } else {
	            $_SESSION['error']['image_upload_error'] = "An error occurred somewhere. Try again or contact the admin";
	            return false;
	        }
	    } else {
	    	$_SESSION['errors'] = $errors;
	        return false;
	    }
	}
	if(count($file_paths) > 0){
		return $file_paths;
	}else{
		return false;
	}
}

function deleteImages($file_paths)
{
	$current_dir = getcwd();
	foreach($file_paths as $file_path){

		$upload_path = $current_dir . $file_path;
		
		if(file_exists($upload_path)){
			
			unlink($upload_path);
			
		}
	}
}
/**
 * Check if request is an AJAX call
 *
 * @param string $script script path
 */
function check_is_ajax($script) {
  
  $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
  
  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
  
  if(!$isAjax) {
    
    trigger_error('Access denied - not an AJAX request...' . ' (' . $script . ')', E_USER_ERROR);
 
  }

}

function str_limit($value, $limit = 100, $end = '...')
{
    if (mb_strwidth($value, 'UTF-8') <= $limit) {
        return $value;
    }

    return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
}
