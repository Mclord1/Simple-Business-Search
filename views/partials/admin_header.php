<?php
if(!$query->isAdmin()){
    redirect("/login");
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
    <link href="../../public/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../public/css/jquery-ui.min.css" rel="stylesheet" type="text/css" >
    <link href="../../public/css/jquery.multiselect.css" rel="stylesheet" type="text/css" >
    <link href="../../public/css/styles.css" rel="stylesheet" type="text/css">
    </style>
</head>
<body>
    <header>
        <div class="top-left">
            <h2>Admin Panel</h2>
        </div>
        <div class="top-right links" style="text-transform: capitalize;">
            <a href="/">Main Site</a>
            <strong><?php admin()->username; ?></strong>
            <a href="/logout">Logout</a>
        </div>
    </header>
    <div class="row position-ref full-height">
            <div class="col-sm-3" id="admin-nav">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="/admin">Dashboard</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/admin/business/new">Add Business</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/admin/categories">Categories</a>
                    </li>
                    <li class="list-group-item">
                        <a href="/admin/views">Viewed Businesses</a>
                    </li>
                </ul>
            </div>
