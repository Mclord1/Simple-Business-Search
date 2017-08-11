<?php

require '../partials/admin_header.php';
if(isset($_GET['id'])){
	$id = $_GET['id'];
}else{
	header("Location: /views/admin/dashboard.php");
}
$business = $query->get('companies','id',$_GET['id']);

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
		<p><span class="def">Categories</span> <?= $business->address ?></p>
	</div>
	<div class="col-sm-8">
		<div class="title" style="font-size: 30px; color: maroon">
			OOPS!! This Business is no longer listed here;
		</div>
	</div>
<?php
require '../partials/admin_footer.php';
