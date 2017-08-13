<?php
require 'partials/header.php';
$companies = $query->selectAll('companies');
$cats = $query->selectAll('categories', 5);
?>
		<div class="content ">
            <div class="m-b-md">
            	<div class="title">
            		Search for businesses near you
            	</div>
                <form action="businesses_list.php" method="get" class="text-center">
                	<div class="form-group">
                		<input type="text" list="companies" name="company" id="main-search" required size="50" placeholder="What Business do you want to find?" value="<?php oldInput('company'); ?>" autocomplete="off">
                        <?php if(isset($companies)): ?>
                        <datalist id="companies">
                            <?php foreach($companies as $c):?>
                            <option><?= $c->name ?></option>
                        <?php endforeach;?>
                        </datalist>  
                        <?php endif; ?>
                	</div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-warning">Search</button>
                    </div>
                </form>
            </div>
            <div class="links">
            <?php foreach($cats as $c => $cat): ?>
                <a href="#"><?= $cat->name ?></a>
            <?php endforeach; ?>
            </div>
        </div>
<?php
require 'partials/footer.php';
?>