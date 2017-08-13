<?php

require '../partials/admin_header.php';

$cats = $query->selectAll('categories');
?>
	<div class="col-sm-8">
		<h5>Catgories</h5>
		<div class="row">
			<div class="col-sm-6">
				<ul>
					<?php foreach($cats as $c => $cat):?>
						<li><?= $cat->name ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<form class="col-sm-6 ajax-form" action="save_category.php" name="create_category" method="post">
				<div class="form-block">
					<label>Add Category</label>
					<input type="text" name="category" value="" required>
				</div>
				<div class="form-block text-center	">
					<input type="submit" id="ajax-save-btn" class="bg-primary" value="Add">
				</div>
			</form>
		</div>
	</div>


<?php
require '../partials/admin_footer.php';
