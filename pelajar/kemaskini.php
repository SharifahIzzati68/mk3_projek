<?php
require '../include/conn.php';
/**
 * @var object $conn
 */
$idperalatan = $_POST['idperalatan'];
$jenisperalatan = $_POST['jenisperalatan'];
$nosiri = $_POST['nosiri'];
$jenama = $_POST['jenama'];

$sql = "UPDATE peralatan
 SET jenisperalatan = '$jenisperalatan', nosiri = '$nosiri', jenama = '$jenama'
 WHERE idperalatan = $idperalatan";
$conn->query($sql);
header('location: index.php?menu=peralatan');

