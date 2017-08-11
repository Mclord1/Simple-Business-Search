<?php
require '../../factory.php';
if($query->isAdmin()){
    $auth = $_SESSION['auth'];
}
else{
    header("Location: /views/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PHP Test - Admin</title>

    <!-- Fonts -->
    <link href="/public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/public/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/jquery.multiselect.css">
    <link href="/public/css/styles.css" rel="stylesheet" type="text/css">
    </style>
</head>
<body>
    <header>
        <div class="top-left">
            <h2>Admin Panel</h2>
        </div>
        <div class="top-right links" style="text-transform: capitalize;">
            <a href="/views/">Main Site</a>
            <strong><?php if(isset($auth)){ echo $auth->username; }?></strong>
            <a href="/views/logout.php">Logout</a>
        </div>
    </header>
    <div class="row position-ref full-height">
            <div class="col-sm-3" id="admin-nav">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="/views/admin/dashboard.php">Dashboard</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/views/admin/add_business.php">Add Business</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/views/admin/categories.php">Categories</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/views/admin/view_logs.php">Viewed Businesses</a>
                    </li>
                </ul>
            </div>
