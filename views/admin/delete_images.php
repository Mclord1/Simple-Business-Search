<?php
check_is_ajax(__FILE__);	
if(isset($_POST['file_id']) && isset($_POST['file_path']))
{
	$file_id = $_POST['file_id'];
	$file_path = $_POST['file_path'];
	$pos = strrpos($file_path, '/'); //check if path as a slash
	$file_name = $pos === false ? $file_path : substr($file_path, $pos + 1); //get string sfter the last slash

	$deleted = $query->delete('uploads',['id' => $file_id,'file_name' => $file_path]);

	if($deleted){
		addSession('success',$file_name." deleted from this business successfully");
		return true;
	}else{
		echo mysql_error();
	}
}

if(isset($_POST['imag_id']) && isset($_POST['delete_path']))
{
	$file_id = $_POST['imag_id'];
	$file_path = $_POST['delete_path'];
	$pos = strrpos($file_path, '/'); //check if path as a slash
	$file_name = $pos === false ? $file_path : substr($file_path, $pos + 1); //get string sfter the last slash

	$deleted = $query->delete('uploads',['id' => $file_id,'file_name' => $file_path]);

	if($deleted){
		$del_perm = deleteImages([$file_path]);

		echo $file_name." deleted permanently";

	}else{
		echo mysql_error();
	}
}