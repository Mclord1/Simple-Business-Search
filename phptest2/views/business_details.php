<?php
require 'partials/header.php';

if($_GET['name']) :	
	$id = $_GET['name'];
	$log = $query->logView($id);
	$business = $query->get('companies','id', $id);

	$categories = $query->selectAll('categories');
endif;
?>

	<div class="container">
		<div class="row">
		<?php if(isset($business)) : ?>
			
			<div class="col-md-8">
				<div class="title" style="font-size: 30px; color: maroon">
					<?= $business->name ?>
				</div>
				<p><?= $business->description ?></p>
				<p><span class="def">Email:</span> <?= $business->email ?></p>
				<p><span class="def">Phone:</span> <?= $business->phone ?></p>
				<p><span class="def">Website:</span> <?= $business->website ?></p>
				<p><span class="def">Location</span> <?= $business->address ?></p>
			</div>
		<?php else: ?>
			<div class="col-md-8">
				<div class="title" style="font-size: 30px; color: maroon">
					OOPS!! This Business is no longer listed here;
				</div>
			</div>
		<?php endif; ?>
			<div class="col-md-4">
				<p>Not what you are looking for?</p>
				<div class="col-md-12 title" style="font-size: 20px; color: maroon">
					Refine your Search
				</div>
				<form action="businesses_list.php" method="get" class="col-md-12">
					<div class="input-group">
						<input type="type" list="categories" name="company" placeholder="what business do you want to find?">
						<datalist id="categories">
							<?php foreach($categories as $cat) : ?>
							<option><?= $cat->name ?></option>
						<?php endforeach; ?>
						</datalist>
						<button type="submit" class="btn btn-warning">Submit</button>
					</div>
				</form>
				<div class="col-md-12">
				<?php foreach($categories as $cat) : ?>
					<li class="list-group-item"><a href="business_category.php" style="color: teal !important;"><?= $cat->name ?></a></li>
				<?php endforeach; ?>
				</div>
			</div>
	</div>
	</div>
<?php
require 'partials/footer.php'; 

?>
