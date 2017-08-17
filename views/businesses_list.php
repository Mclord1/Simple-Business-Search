<?php
require 'partials/header.php';

if($_GET['company']) :

	$searchinput = $_GET['company'];

	$businesses = $query->searchWhere('businesses',$searchinput);
endif;
?>
	<div class="container">
		<div class="row">
			<div class="title" style="font-size: 30px; color: maroon">
				Businesses Matching your Search
			</div>
			<div class="col-md-12">
			<?php if(isset($businesses)): 
				foreach($businesses as $bus): ?>
				<div class="col-md-4 b">
					<li class="list-group-item">
						<h5 class="small-caps"><?= $bus->name; ?></h5>
						<p>
							<?= $bus->description; ?>
							<a href="" id="<?= $bus->id ?>" class="more"> More...</a>
						</p>
					</li>
				</div>
				<?php
					endforeach;
			endif; ?>	
			</div>
			<form method="get" action="/business" id="view_business">
				<input type="text" name="id" id="business_id" style="display: none;">
			</form>
		</div>
	</div>
<?php
require 'partials/footer.php';
?>
