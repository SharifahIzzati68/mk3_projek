<?php
require '../include/conn.php';
/**
 * @var object $conn
 */
$idwarden = $_POST['idwarden'];
$namawarden = $_POST['namawarden'];
$nokpwarden = $_POST['nokpwarden'];
$katas = $_POST['nokpwarden'];

// Check if the nokpwarden (warden's identification number) already exists
$check_sql = "SELECT COUNT(*) AS count FROM warden WHERE nokpwarden = '$nokpwarden' AND idwarden != $idwarden";
$check_result = $conn->query($check_sql);
$row = $check_result->fetch_assoc();

if ($row['count'] > 0) {
    // Redirect back to the warden registration page with an error message
    header('location: index.php?menu=warden&error=exists');
    exit;
}

// Check if the provided 'No.KP warden' is not a pelajar's 'nokppelajar'
$pelajar_check_sql = "SELECT COUNT(*) AS count FROM pelajar WHERE nokppelajar = '$nokpwarden'";
$pelajar_check_result = $conn->query($pelajar_check_sql);

if (!$pelajar_check_result) {
    // Handle the query error
    echo "Error: " . $conn->error;
    $conn->close();
    exit;
}

$pelajar_row = $pelajar_check_result->fetch_assoc();

if ($pelajar_row['count'] > 0) {
    // Redirect back to the warden registration page with an error message
    header('location: index.php?menu=warden&error=pelajar');
    exit;
}

$kata = password_hash($katas, PASSWORD_BCRYPT);

$sql = "UPDATE warden
SET namawarden = '$namawarden', nokpwarden = '$nokpwarden', kata = '$kata'
WHERE idwarden = $idwarden";
$conn->query($sql);
header('location: index.php?menu=warden');
?>
