<?php

require '../partials/admin_header.php';

$cats = $query->selectAll('categories');
?>
	<div class="col-sm-8">
		<h5>Add Business</h5>
		<form action="save_business.php" method="post" id="save_business">
			<?php if(isset($_SESSION['success'])):
				?>
			<div class="alert alert-success">
				<p><?php if(isset($_SESSION['success'])){ echo $_SESSION['success']; } ?></p>
			</div>
			<?php 
			endif; unset($_SESSION['success']);
			if(isset($_SESSION['failure'])):
				?>
			<div class="alert alert-success">
				<p><?= $_SESSION['failure']  ?></p>
			</div>
			<?php endif; unset($_SESSION['failure']);?>
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
				<input id="name" class="form-control" type="text" name="name" value="" required>
			</div>
			<div class="form-block">
				<label for="email">Email</label>
				<input id="email" class="form-control" type="email" name="email" value="" required>
			</div>
			<div class="form-block">
				<label for="phone">Phone</label>
				<input id="phone" class="form-control" type="text" name="phone" value="" required>
			</div>
			<div class="form-block">
				<label for="website">Website</label>
				<input id="website" class="form-control" type="url" name="website" value="http://" required>
			</div>
			<div class="form-block">
				<label for="location">Address</label>
				<input id="location" class="form-control" type="text" name="location" value="" required>
			</div>
			<div class="form-block">
				<label for="descr">Desciption</label>
				<textarea id="descr" class="form-control" name="description" required placeholder="Please Describe the business"></textarea>
			</div>
			
			<div class="form-block text-center">
				<input type="submit" class="bg-primary" value="Add">
			</div>
		</form>
	</div>


<?php
require '../partials/admin_footer.php';
