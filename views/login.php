<?php
if($query->isAdmin()){
    redirect('/admin');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<meta charset="utf-8">
    <link href="../public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="../public/css/styles.css">
</head>
<body>
	<header>
        <div class="top-left">
            <h2>Business Listing</h2>
        </div>
        <div class="top-right links">

            <a href="login">Login</a>
        </div>
    </header>
    <section id="content" style="margin: 0 auto; text-align: center;">
    	<?php if(sessionCheck('errors')): ?>
    		<div class="alert alert-warning" style="width: 60%; margin: auto;">
    		<?php foreach($errors as $error): ?>
    			<p><?php echo $error['title'].' : '.$error['message']; unsetSession('errors');?></p>
    		<?php endforeach; ?>
    		</div>
    	<?php endif; ?>
    		</div>
    		<form action="/login" method="POST">
				<div class="form-group">
					<label for="user">Username</label>
					<input type="text" name="username" required id="user" value="<?php oldInput('username');?>" >
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" required id="password">
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Submit</button>
				</div>
			</form>
	</section>
	<footer style="position: fixed;bottom: 10px; width: 100%">
		<p style="text-align: center;"">@copyright bleh bleh bleh (*_*)</p>
	</footer>
</body>
</html>
