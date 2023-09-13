<?php
global $conn;
require 'conn.php';
$idwarden = $_GET['idwarden'];
$nokpwarden= $_GET['nokpwarden'];
$sql = "UPDATE warden
SET kata = '$nokpwarden'
WHERE idwarden = $idwarden";
$conn->query($sql);
header('location: index.php');
