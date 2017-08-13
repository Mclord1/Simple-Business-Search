<?php
require '../../factory.php';
if($query->isAdmin() && isset($_POST['name'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$website = $_POST['website'];
	$address = $_POST['location'];
	$description = $_POST['description'];
	$categories = $_POST['category'];
	
	$table = 'companies';
	$columns = ['name','email','phone','website','address','description'];
	$values = [$name,$email,$phone,$website,$address,$description];
	if($query->updateAll($table, $columns,$values,$id)){
		$company = $query->get('companies','email',$email);
		foreach ($categories as $c => $cat) {
			$query->insertAll('companies_categories', ['company_id','category_id'],[$company->id, $cat]);
		}
		$_SESSION['success'] = "One Business Added Successfully";
		header("Location: add_business.php");
	}else{
		echo mysql_errno();
	}

}
else{
	echo "Check the name of your input";
}
?>