<?php

require 'views/partials/admin_header.php';

if(isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	redirect("/admin");
}
$business = $query->find('businesses','id',$_GET['id']);

$categories = $query->getCategories($_GET['id']);

$cat_names = [];
foreach ($categories as $cate) {
	array_push($cat_names, $cate->name);
}

$cats = $query->selectAll('categories');
?>
	<div class="col-sm-8">
		<h5>Add Business</h5>
		<form action="/admin/business/update" method="post" id="save_business" enctype="multipart/form-data"> 
			<?php if(isset($_SESSION['success'])):
				?>
			<div class="alert alert-success">
				<p><?php if(isset($_SESSION['success'])){ echo $_SESSION['success']; } ?></p>
			</div>
			<?php 
			unset($_SESSION['success']); endif;
			if(isset($_SESSION['failure'])):
				?>
			<div class="alert alert-success">
				<p><?= $_SESSION['failure']  ?></p>
			</div>
			<?php  unset($_SESSION['failure']); endif;?>
			<div class="form-block">
				<label for="name">Category</label>
				<select id="category" class="form-control" name="category[]" multiple>
					<option value="">--None--</option>
					<?php foreach($cats as $c => $cat): 
						if(in_array($cat->name, $cat_names)): ?>
						<option required value="<?= $cat->id ?>" selected><?= $cat->name ?></option>
					<?php else: ?>
						<option required value="<?= $cat->id ?>"><?= $cat->name ?></option>
					<?php endif; endforeach; ?>
				</select>
			</div>
			<div class="form-block">
				<label for="name">Name</label>
				<input id="name" class="form-control" type="text" name="name" value="<?= $business->name ?>" required>
			</div>
			<div class="form-block">
				<label for="email">Email</label>
				<input id="email" class="form-control" type="email" name="email" value="<?= $business->email ?>" required>
			</div>
			<div class="form-block">
				<label for="phone">Phone</label>
				<input id="phone" class="form-control" type="text" name="phone" value="<?= $business->phone ?>" required>
			</div>
			<div class="form-block">
				<label for="website">Website</label>
				<input id="website" class="form-control" type="url" name="website" value="http://<?= str_replace('http://', '', $business->website) ?>" required>
			</div>
			<div class="form-block">
				<label for="location">Address</label>
				<input id="location" class="form-control" type="text" name="address" value="<?= $business->address ?>" required>
			</div>
			<div class="form-block">
				<label for="descr">Desciption</label>
				<textarea id="descr" class="form-control" name="description" required placeholder="Please Describe the business"><?=  $business->description ?></textarea>
			</div>
			<input type="hidden" name="id" value="<?= $business->id ?>">
			
			<div class="form-block text-center">
				<input type="submit" class="bg-primary" value="Update">
			</div>
		</form>
	</div>


<?php
require 'views/partials/admin_footer.php';
