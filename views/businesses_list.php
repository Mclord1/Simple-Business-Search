<?php
require 'partials/header.php';

if($_GET['company']) :

	$searchinput = $_GET['company'];

	$businesses = $query->searchWhere('companies',$searchinput);
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
							<a href="business_details.php?name=<?= $bus->id ?>"> More...</a>
						</p>
					</li>
				</div>
				<?php
					endforeach;
			endif; ?>	
			</div>
		</div>
	</div>
<?php
require 'partials/footer.php';
?>
