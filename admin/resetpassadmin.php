<?php
global $conn;
require '../include/conn.php';
$idadmin = $_POST['idadmin'];
$kata = $_POST['kata'];
$hash_password = password_hash($kata, PASSWORD_BCRYPT);
$sql = "UPDATE admin
SET kata = '$hash_password'
WHERE idadmin = $idadmin";
$conn->query($sql);
header('location: index.php');
