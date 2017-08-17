<?php
if($query->isAdmin() && isset($_POST['category'])){
	$category = $_POST['category'];
	$result = $query->insertAll('categories',['name'],[$category]);
	if($result){
		echo "Category Added Successfully";
	}else{
		echo "Something went Wrong";
	}
}
else{
	echo "Check the name of your input";
}
?>