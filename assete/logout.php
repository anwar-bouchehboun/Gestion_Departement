<?php
session_start();

$_SESSION = array();


setcookie('id_admin', '', time() - 3600, "/");
setcookie('admin', '', time() - 3600, "/");

session_destroy();
header("location: ./../login.php");
exit();
