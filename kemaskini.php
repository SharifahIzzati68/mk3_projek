<?php
global $conn;
require 'conn.php';
$idwarden = $_POST['idwarden'];
$namawarden = $_POST['namawarden'];
$nokpwarden= $_POST['nokpwarden'];
$kata = $_POST['kata'];
$sql = "UPDATE warden
SET namawarden = '$namawarden', nokpwarden = '$nokpwarden', kata = '$kata'
WHERE idwarden = $idwarden";
$conn->query($sql);
header('location: index.php');