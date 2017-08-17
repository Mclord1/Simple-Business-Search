<?php
require 'views/partials/admin_header.php';

$all_businesses = $query->selectClass('businesses','Business');
?>
	<div class="col-sm-8">
		<h5>ALl Businesses</h5>
		<?php flash('success'); flash('failure');?>
		<table class="table table-responsive">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Website</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($all_businesses as $b):?>
				<tr>
					<td><?= $b->name ?></td>
					<td><?= str_limit($b->description,150,'<sub>  *****</sub>') ?></td>
					<td><?= $b->website ?></td>
				</tr>
				<tr><td colspan="3">
						<a href="/admin/business?id=<?= $b->id ?>" class="btn btn-primary" >More>> </a> | 
						<a href="/admin/business/delete?id=<?= $b->id ?>" class="btn btn-danger delete-btn">Delete </a>
					</td></tr>

			<?php endforeach; ?>
			</tbody>
		</table>
	</div>


<?php
require 'views/partials/admin_footer.php';
