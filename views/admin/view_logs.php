<?php
require '../partials/admin_header.php';

$views = $query->getALlViews();
?>
	<div class="col-sm-8">
		<h5>Businessese added</h5>
		<table class="table table-responsive">
			<thead>
				<tr>
					<th>Name</th>
					<th>Views</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($views as $view):?>
				<tr>
					<td><?= $view->name ?></td>
					<td><?= $view->views ?></td>
				</tr>				
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>


<?php
require '../partials/admin_footer.php';
