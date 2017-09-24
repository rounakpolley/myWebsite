<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'the-password');
define('DB_DATABASE', 'mywebsitedb');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE) OR DIE('Unable to connect');
if (!$db){die("Database Connection Failed" . mysqli_error($connection));}
?>