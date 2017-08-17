<?php

require 'views/partials/admin_header.php';

$cats = $query->selectAll('categories');
?>
	<div class="col-sm-8">
		<h5>Add Business</h5>
		<form action="/admin/business/save" method="post" id="save_business" enctype="multipart/form-data">
			<?= flash('success','success'); flash('failure','danger');?>
			<div class="form-block">
				<label for="name">Category</label>
				<select id="category" class="form-control" name="category[]" multiple>
					<option value="">--None--</option>
					<?php foreach($cats as $c => $cat): ?>
						<option required value="<?= $cat->id ?>"><?= $cat->name ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-block">
				<label for="name">Name</label>
				<input id="name" class="form-control" type="text" name="name" value="<?= oldInput('name') ?>" required>
			</div>
			<div class="form-block">
				<label for="email">Email</label>
				<input id="email" class="form-control" type="email" name="email" value="<?= oldInput('email') ?>" required>
			</div>
			<div class="form-block">
				<label for="phone">Phone</label>
				<input id="phone" class="form-control" type="text" name="phone" value="<?= oldInput('phone') ?>" required>
			</div>
			<div class="form-block">
				<label>Upload Images <i>(multiple images allowed)</i></label>
				<input type="file" name="images[]" multiple title="allows multiple images" class="form-control">
			</div>
			<div class="form-block">
				<label for="website">Website</label>
				<input id="website" class="form-control" type="url" name="website" value="http://<?= str_replace('http://', '', oldInput('website')) ?>" required>
			</div>
			<div class="form-block">
				<label for="location">Address</label>
				<input id="location" class="form-control" type="text" name="address" value="<?= oldInput('address') ?>" required>
			</div>
			<div class="form-block">
				<label for="descr">Desciption</label>
				<textarea id="descr" class="form-control" name="description" required placeholder="Please Describe the business"><?= oldInput('description') ?></textarea>
			</div>
			
			<div class="form-block text-center">
				<input type="submit" class="bg-primary" value="Add">
			</div>
		</form>
	</div>


<?php
require 'views/partials/admin_footer.php';
