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

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    if (!empty($id)) {
        $sql = "DELETE FROM departement WHERE id_dep = ?";
        $stmt = $cnx->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Department deleted successfully";
            header("location: Dashboard.php");
        } else {
            echo "Failed to delete department";
        }
    } else {
        echo "Department ID is required";
    }


    // if ($res) {
    // }
}
