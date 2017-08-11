<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<meta charset="utf-8">
    <link href="../../public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="../../public/css/styles.css">
</head>
<body>
	<header>
        <div class="top-left">
            <h2>Business Listing</h2>
        </div>
        <div class="top-right links">
            <a href="admin/login.php">Login</a>
        </div>
    </header>
    <section id="content" style="margin: 0 auto; text-align: center;">
    		<form name="login" action="process_login.php">
				<div class="form-group">
					<label for="user">Username</label>
					<input type="text" name="username" required id="user">
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
