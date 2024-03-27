<?php
require_once 'dbconnect.php';
setcookie('login', null);
header('Location: login.php');