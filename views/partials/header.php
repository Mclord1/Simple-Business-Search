<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PHP Test</title>

    <!-- Fonts -->
    <link href="../public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/jquery-ui.min.css">
    <link href="../public/css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header>
        <div class="top-left">
            <h2>Business Listing</h2>
        </div>
        <div class="top-right links">
        <a href="/">Home</a>
        <?php if($query->isAdmin()): ?>
            <a href="/admin">Dashboard</a>
        <?php else: ?>
            <a href="/login">Login</a>
        <?php endif; ?>
        </div>
    </header>
    <div class="container position-ref full-height">
