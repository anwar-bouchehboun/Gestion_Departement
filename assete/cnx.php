<?php
$servername = "localhost";
$username = "root";
$password = "";
$bd = "gestiondp";

$cnx = new mysqli($servername, $username, $password, $bd);

// Check connection
if ($cnx->connect_error) {
    die("Connection failed: " . $cnx->connect_error);
}
