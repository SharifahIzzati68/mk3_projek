<?php
require '../include/conn.php';
/**
 * @var object $conn
 */
$idperalatan = $_GET['idperalatan'];
$sql = "DELETE FROM peralatan WHERE idperalatan = $idperalatan";
$conn->query($sql);
header('location: index.php?menu=peralatanPelajar');