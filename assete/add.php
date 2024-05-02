<?php
session_start();
include 'cnx.php';

// Check if the necessary session variables are set and not empty
if (
    isset($_COOKIE['id_admin'], $_COOKIE['admin']) &&
    !empty($_COOKIE['id_admin']) && !empty($_COOKIE['admin'])
) {
    $id = $_COOKIE['id_admin'];
    $admin = $_COOKIE['admin'];
} else {
    header("location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    $departement = $_POST['departement'];
    // echo $departement;
    $query = "INSERT INTO `departement`(`departement`) VALUES ('$departement')";
    // Execute the query
    $res = mysqli_query($cnx, $query);

    if ($res) {
        header("location: Dashboard.php");
    }
}
