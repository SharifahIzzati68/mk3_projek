<?php
global $conn;
require '../include/conn.php';
$idadmin = $_POST['idadmin'];
$kata = "admin";
$sql = "UPDATE admin
SET kata = '$kata'
WHERE idadmin = $idadmin";
$conn->query($sql);
header('location: index.php');
