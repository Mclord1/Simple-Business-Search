<?php
if(!$query->isAdmin()){
	redirect('/login');
}
if(!empty($_POST) && !isset($_POST['business_id'])){	

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

	$business = $query->find('businesses','id',$_POST['id']);

	$updated = $query->update('businesses',[
		'name' => $request['name'],
		'email' => $request['email'],
		'website' => $request['website'],
		'phone' => $request['phone'],
		'address' => $request['address'],
		'description' => $request['description']
	], $business->id);
	if($updated){

		$query->detach_and_attach(
			'businesses_categories',$business->id,
			'business_id', 'category_id',
			$request['category']
		);

		$_SESSION['success'] = $business->name." Updated Successfully";
		redirect('/admin/business?id='.$business->id);
	}
	else{
		echo mysql_errno();
	}

}
// elseif(isset($_POST['images']) && isset($_POST['business_id'])){
// 	$business = $query->find('businesses','id',$_POST['business_id']);
// 	//if insert was successful, add the categories and upload the images
// 	if($business){
		
// 		//Upload the images accept 3 arguments(input_name,folder_name',[mimetypes])
// 		$upload_paths = uploadImages('images','images',['jpg','jpeg','png']);

// 		echo implode(' | ', $upload_paths);

// 		$_SESSION['success'] = "Successfully Added ".$business->name;

// 		redirect('/admin/business/new');

// 	}else{
// 		echo mysql_errno();
// 	}

// }
else{
	redirect('/error/403');
}

