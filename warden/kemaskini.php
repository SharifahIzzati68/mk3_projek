<?php

require '../include/conn.php';
/** @var object $conn */
$idpelajar = $_POST['idpelajar'];
$namapelajar = $_POST['namapelajar'];
$nokppelajar= $_POST['nokppelajar'];
$katas= $_POST['nokppelajar'];

// Check if the nokppelajar already exists in the 'pelajar' table
$check_sql = "SELECT COUNT(*) AS count FROM pelajar WHERE nokppelajar = '$nokppelajar'";
$check_result = $conn->query($check_sql);

if (!$check_result) {
    // Handle the query error
    echo "Error: " . $conn->error;
    $conn->close();
    exit;
}

$row = $check_result->fetch_assoc();

if ($row['count'] > 0) {
    // Redirect back to the warden registration page with an error message
    header('location: index.php?menu=Student&error=exists');
    exit;
}

// Check if the provided 'nokppelajar' is not a warden's 'No.KP warden'
$warden_check_sql = "SELECT COUNT(*) AS count FROM warden WHERE nokpwarden = '$nokppelajar'";
$warden_check_result = $conn->query($warden_check_sql);

if (!$warden_check_result) {
    // Handle the query error
    echo "Error: " . $conn->error;
    $conn->close();
    exit;
}

$warden_row = $warden_check_result->fetch_assoc();

if ($warden_row['count'] > 0) {
    // Redirect back to the warden registration page with an error message
    header('location: index.php?menu=Student&error=warden');
    exit;
}

$kata = password_hash($katas, PASSWORD_BCRYPT);

$sql = "UPDATE pelajar
 SET namapelajar = '$namapelajar', nokppelajar = '$nokppelajar', kata = '$kata'
 WHERE idpelajar = $idpelajar";
$conn->query($sql);
header('location: index.php?menu=Student');