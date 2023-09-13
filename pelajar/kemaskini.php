<?php
global $conn;
require '../include/conn.php';
$idperalatan = $_POST['idperalatan'];
$jenisperalatan = $_POST['jenisperalatan'];
$nosiri= $_POST['nosiri'];
$jenama= $_POST['jenama'];

$sql = "UPDATE peralatan
 SET jenisperalatan = '$jenisperalatan', nosiri = '$nosiri', jenama = '$jenama'
 WHERE idperalatan = $idperalatan";
$conn->query($sql);
header('location: indexpelajar.php?menu=peralatan');