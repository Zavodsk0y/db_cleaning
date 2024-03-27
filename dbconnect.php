<?php
$host = 'localhost';
$database = 'cleaning';
$user = 'root';
$password = '';

$mysqli = mysqli_connect($host, $user, $password, $database);

if (mysqli_connect_errno()) echo "Couldn't connect to MySQL: " . mysqli_connect_error();