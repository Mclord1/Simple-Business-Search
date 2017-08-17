<?php
if(!empty($_POST)){
	
	$request = validate(INPUT_POST, [
		'name' => 'string',
		'email' => 'email',
		'phone' => 'int',
		'website' => 'url',
		'address' => 'string',
		'description' => 'string',
	]);
	$request['category'] = [];
	foreach ($_POST['category'] as $key => $cat) {
		$c = filter_var($cat,FILTER_VALIDATE_INT);
		array_push($request['category'], $c);
	};

	//insert and get an instance of the business
	$business = $query->insert('businesses',[
		'name' => $request['name'],
		'email' => $request['email'],
		'website' => $request['website'],
		'phone' => $request['phone'],
		'address' => $request['address'],
		'description' => $request['description']
	]);

	//if insert was successful, add the categories and upload the images
	if($business){
		foreach ($categories as $c => $cat) {
			$query->insert('businesses_categories', [
				'business_id' => $company->id,
				'category_id' => $cat
				]);
		}

		//Upload the images accept 3 arguments(input_name,folder_name',[mimetypes])
		$upload_paths= uploadImages('images','images',['jpg','jpeg','png']);

		if($upload_paths){
			foreach ($upload_paths as $path) {

				$query->insert('uploads',[
					'business_id' => $business->id,
					'file_name' => $path
				]);
			}
		}

		$_SESSION['success'] = "Successfully Added ".$business->name;
		redirect('/admin/business/new');
	}else{
		echo mysql_errno();
	}

}
else{
	redirect('/admin/business/new');
	$errors = [];
	foreach ($_POST as $key => $value) {
		if(is_null($value)){
			array_push($errors = $_POST[$key]);
		}
	}
	$_SESSION['errors'][] = $errors;
	$_SESSION['old'] = $_POST;
}
?>