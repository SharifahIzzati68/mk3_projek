<?php
global $conn;
require '../include/conn.php';
$idadmin = $_POST['idadmin'];
$sql = "UPDATE admin
SET kata = 'admin'
WHERE idadmin = $idadmin";
$conn->query($sql);
header('location: index.php');
