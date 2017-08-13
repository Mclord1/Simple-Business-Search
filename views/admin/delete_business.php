<?php
require '../../factory.php';
if($query->isAdmin() && isset($_GET['id'])){
	if($query->delete($table,$id)){
		$_SESSION['success'] = "One Business Deleted Successfully";
		header("Location: /views/admin/dashboard.php");
	}else{
		$_SESSION['failure'] = "OOPs!! Unable to delete Business";
	}

}
else{
	echo "Check the name of your input";
}
?>