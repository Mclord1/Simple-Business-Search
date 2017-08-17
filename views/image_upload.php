<?php

require 'views/partials/admin_header.php';

$cats = $query->selectAll('uploads');
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
			<form class="col-sm-6" action="/tester" name="create_category" method="post" enctype="multipart/form-data">
				<div class="form-block">
					<label>Add Image</label>
					<input type="file" multiple name="images[]" value="<?= oldInput('images'); ?>" required>
				</div>
				<div class="form-block text-center">
					<input type="submit" class="bg-primary" value="Add">
				</div>
			</form>
		</div>
	</div>


<?php
require 'views/partials/admin_footer.php';
