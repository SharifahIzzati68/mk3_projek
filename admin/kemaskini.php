<?php
global $conn;
require '../include/conn.php';
$idwarden = $_POST['idwarden'];
$namawarden = $_POST['namawarden'];
$nokpwarden= $_POST['nokpwarden'];
$sql = "UPDATE warden
SET namawarden = '$namawarden', nokpwarden = '$nokpwarden'
WHERE idwarden = $idwarden";
$conn->query($sql);
header('location: index.php?menu=warden');