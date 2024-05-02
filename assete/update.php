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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departmentName = $_POST['departement'];
    $id = $_POST['id'];
    echo $departmentName, $id;

    if (!empty($departmentName)) {
        $sql = "UPDATE departement SET departement = ? WHERE id_dep = ?";
        $stmt = $cnx->prepare($sql);
        $stmt->bind_param("si", $departmentName, $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Department updated successfully";
            header("location: Dashboard.php");
        } else {
            echo "Failed to update department";
        }
    } else {
        echo "Department name is required";
    }
}
