<?php

require 'views/partials/admin_header.php';
if(isset($_GET['id'])){
	
	$id = $_GET['id'];
	
	$business = $query->find('businesses','id',$_GET['id']);

	if(!$business){
		redirect('/error/404');
	}

}else{
	header("Location: /dashboard");
}
$images = $query->get('uploads','business_id',$id);
$categories = $query->getCategories($_GET['id']);

?>			
	<div class="col-sm-8">
		<div class="title" style="font-size: 30px; color: maroon">
			<?= $business->name ?>
		</div>
		<?= flash('success','success'); flash('failure','danger');?>
		<div class="row">
			<div class="col-md-6">
				<p><?= $business->description ?></p>
				<p><span class="def">Email:</span> <?= $business->email ?></p>
				<p><span class="def">Phone:</span> <?= $business->phone ?></p>
				<p><span class="def">Website:</span> <a href="<?= $business->website ?>"><?= $business->website ?></a></p>
				<p><span class="def">Location</span> <?= $business->address ?></p>
				<p><span class="def">Categories</span> 
				<?php foreach($categories as $c => $cat): 
					if($c < count($categories) -1): 
						echo $cat->name.', '; 
					else:
						echo $cat->name;
					endif; 
				endforeach;  ?>
				</p>
				<a href="/admin/business/edit?id=<?= $id ?>" class="btn btn-warning">Edit</a>	
			</div>
			<div class="col-md-6">
				<h2>Images</h2>
				<div class="container">
					<?php 
					if(count($images) > 0 ): foreach ($images as $image): ?>
					
						<div style="width: 50%;float: left; padding: 10px;">
							<img src="<?= $image->file_name ?>" style="width: 100%; height: 100%;max-width: 300px;" >
							<a  href="#" id="<?= $image->id ?>" class="image_delete btn btn-default">Remove Image </a> | 
							<a  href="#" id="<?= $image->id ?>" class="perm_delete btn btn-default"> Permanently Delete image</a>

						</div>
						
					<?php endforeach; else: ?>
						<p>No Images added to this business</p>
					<?php endif; ?>
				</div>
				<div class="container" style="clear: both;">
				<hr>
					<form action="/admin/images/update" method="post" enctype="multipart/form-data">
						<div class="form-block">
							<label>Upload Images (multiple images allowed max-size:2MB)</label>
							<input type="hidden" name="business_id" value="<?= $business->id ?>">
							<input type="file" name="images[]" multiple>
							<input type="submit" value="Upload">
						</div>
					</form>
				</div>					
			</div>
		</div>
		
	</div>
<?php
require 'views/partials/admin_footer.php';
