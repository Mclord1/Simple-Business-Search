<?php

require '../partials/admin_header.php';
if(isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	header("Location: dashboard.php");
}
$business = $query->get('companies','id',$_GET['id']);

$categories = $query->getCategories($_GET['id']);

?>			
	<div class="col-sm-8">
		<div class="title" style="font-size: 30px; color: maroon">
			<?= $business->name ?>
		</div>
		<p><?= $business->description ?></p>
		<p><span class="def">Email:</span> <?= $business->email ?></p>
		<p><span class="def">Phone:</span> <?= $business->phone ?></p>
		<p><span class="def">Website:</span> <?= $business->website ?></p>
		<p><span class="def">Location</span> <?= $business->address ?></p>
		<p><span class="def">Categories</span> 
		<?php foreach($categories as $c => $cat): 
			if($c < (count($categories)) -1): 
				echo $cat->name.', '; 
			else:
				echo $cat->name;
			endif; 
		endforeach;  ?>
		</p>
		<a href="edit_business.php?id=<?=$id?>" class="btn btn-warning">Edit</a>
	</div>
<?php
require '../partials/admin_footer.php';
