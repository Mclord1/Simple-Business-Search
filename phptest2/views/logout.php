<?php

require '../factory.php';

if(isset($_SESSION['auth'])){
	session_unset($_SESSION['auth']);
	header("Location: index.php");
}
?>
