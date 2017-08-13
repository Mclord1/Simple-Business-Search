<?php
require '../partials/admin_header.php';

$all = $query->selectAll('companies');
?>
	<div class="col-sm-8">
		<h5>ALl Businesses</h5>
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
		<table class="table table-responsive">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Website</th>
					<th>More+</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($all as $b):?>
				<tr>
					<td><?= $b->name ?></td>
					<td><?= $b->description ?></td>
					<td><?= $b->website ?></td>
					<td>
						<a href="business.php?id=<?= $b->id ?>" class="btn btn-primary" >More>> </a><br>
						<a href="delete_business.php?id=<?= $b->id ?>" class="btn btn-danger delete-btn">Delete </a>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>


<?php
require '../partials/admin_footer.php';
