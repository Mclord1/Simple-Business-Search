<?php
require '../factory.php';
?>
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
    </style>
</head>
<body>
    <header>
        <div class="top-left">
            <h2>Business Listing</h2>
        </div>
        <div class="top-right links">
        <a href="../index.php">Home</a>
        <?php if(isset($auth)): ?>
            <a href="../views/admin/dashboard.php">Dashboard</a>
        <?php else: ?>
            <a href="../views/login.php">Login</a>
        <?php endif; ?>
        </div>
    </header>
    <div class="container position-ref full-height">
