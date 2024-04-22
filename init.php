<?php
require_once 'dbconnect.php';
require_once 'methods.php';

if (!isset($_COOKIE['login'])) {
    header('Location: login.php');
    exit;
}
$login = $_COOKIE['login'];
$user = getUserById($mysqli, $login);
if (!$user) {
    header('Location: login.php');
    exit;
}
$id = $user['id'];
$userRoles = getUserRoles($mysqli, $id);

