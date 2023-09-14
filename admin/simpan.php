<?php
global $conn;
require '../include/conn.php';
$namawarden = $_POST['namawarden'];
$nokpwarden= $_POST['nokpwarden'];
$kata = $_POST['kata'];
$sql = "INSERT INTO warden VALUES(null, '$namawarden', '$nokpwarden', '$kata')";
$conn->query($sql);
echo $conn->error;
header('location: index.php');