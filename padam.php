<?php
global $conn;
require 'conn.php';
$idwarden = $_GET['idwarden'];
$sql = "DELETE FROM warden WHERE idwarden = $idwarden";
$conn->query($sql);
header('location: index.php');