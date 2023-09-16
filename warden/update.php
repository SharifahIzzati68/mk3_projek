<?php
global $conn;
require '../include/conn.php';
$idpelajar = $_POST['idpelajar'];
$namapelajar = $_POST['namapelajar'];
$nokppelajar= $_POST['nokppelajar'];
$kata= $_POST['kata'];

$sql = "UPDATE pelajar
 SET namapelajar = '$namapelajar', nokppelajar = '$nokppelajar', kata = '$kata'
 WHERE idpelajar = $idpelajar";
$conn->query($sql);
header('location: index.php?menu=Student');