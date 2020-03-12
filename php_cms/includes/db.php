<?php
ob_start();

// Database Credentials
$db['db_host'] = 'localhost';
$db['db_user'] = 'leojt401_leolou';
$db['db_password'] = 'C9hyperx';
$db['db_name'] = 'leojt401_cms';

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

// Connection to localhost cms database
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// If not connected to mySQL
if (!$connection) {
    die("Database Connection failed" . mysqli_error($connection));
}
?>