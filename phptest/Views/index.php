<?php
require 'partials/header.php';
$companies = $query->selectAll('companies');
?>
		<div class="content ">
            <div class="m-b-md">
            	<div class="title">
            		Search for businesses near you
            	</div>
                <form action="/Listing/businesses_list.php" method="get" class="text-center">
                	<div class="form-group">
                		<input type="text" list="companies" name="company" id="main-search" required size="50" placeholder="What Business do you want to find?" value="" autocomplete="off">
                        <?php if(isset($companies)): 
                            foreach($companies as $c):?>

                        <datalist id="companies">

                            <option><?= $c->name ?></option>

                        </datalist>

                        <?php endforeach; 
                        endif; ?>
                	</div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-warning">Search</button>
                    </div>
                </form>
            </div>
        </div>
<script type="text/javascript">
    var businesses = [
        <?php foreach($companies as $c): ?>
        '<?= $c->name ?>',
        <?php endforeach; ?>
    ];
</script>
<?php
require 'partials/footer.php';
?>