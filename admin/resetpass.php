<?php
/** @var object $conn */
require '../include/conn.php';
$idwarden = $_GET['idwarden'];
$nokpwarden= $_GET['nokpwarden'];
$hash_password = password_hash($nokpwarden, PASSWORD_BCRYPT);
$sql = "UPDATE warden
SET kata = '$hash_password'
WHERE idwarden = $idwarden";
$conn->query($sql);
header('location: index.php?menu=warden');
