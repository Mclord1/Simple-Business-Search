<?php
require 'partials/header.php';
$businesses = $query->selectAll('businesses');
$cats = $query->selectAll('categories', 5);
?>
		<div class="content ">
            <div class="m-b-md">
            	<div class="title">
            		Search for businesses near you
            	</div>
                <form action="/businesses/search_results" method="get" class="text-center">
                	<div class="form-group">
                		<input type="text" list="companies" name="company" id="main-search" required size="50" placeholder="What Business do you want to find?" value="<?php oldInput('company'); ?>" autocomplete="off">
                        <?php if(isset($businesses)): ?>
                        <datalist id="companies">
                            <?php foreach($businesses as $b):?>
                            <option value="<?= $b->name ?>"><?= $b->name ?> : <?= $b->description ?></option>
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