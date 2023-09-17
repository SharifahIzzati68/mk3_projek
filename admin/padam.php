<?php
require '../include/conn.php';
/** @var object $conn */
$idwarden = $_GET['idwarden'];
$sql = "DELETE FROM warden WHERE idwarden = $idwarden";
$conn->query($sql);
header('location: index.php?menu=warden');