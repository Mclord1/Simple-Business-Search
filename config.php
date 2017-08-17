<?php
return [
    "database" => [
        "name" => "companies_directory",
        "user" => "root",
        "password" => "root",
        "connection" => "mysql:dbhost=127.0.0.1",
        "options" => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];
?>