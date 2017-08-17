<?php
if(isset($_FILES['images']) && isset($_POST['business_id'])){
	$business = $query->find('businesses','id',$_POST['business_id']);

	if($business){
		
		//Upload the images accept 3 arguments(input_name,folder_name',[mimetypes])
		$upload_paths = uploadImages('images','images',['jpg','jpeg','png']);

		if($upload_paths){
			foreach ($upload_paths as $path) {

				$query->insert('uploads',[
					'business_id' => $business->id,
					'file_name' => $path
				]);
			}

			$_SESSION['success'] = "Successfully Added images to ".$business->name;

			redirect('/admin/business?id='.$business->id);	
		}

	}else{
		echo mysql_errno();
	}

}
else{
	redirect('/error/403');
}