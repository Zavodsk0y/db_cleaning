<?php
require_once 'dbconnect.php';

if (!isset($_COOKIE['login'])) {
    header('Location: login.php');
    exit;
}
$login = $_COOKIE['login'];
?>
