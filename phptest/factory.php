<?php

$config = require "config.php";

require 'Database/Connection.php';

require 'Database/QueryBuilder.php';

require 'functions.php';

$query = new QueryBuilder(
	Connection::make($config['database'])
);