<?php
/** @var object $conn */
require '../include/conn.php';
// Validate and sanitize user input
$namapelajar = $_POST['namapelajar'];
$nokppelajar = $_POST['nokppelajar'];
$katas = $_POST['nokppelajar'];

// Check if input is valid
if (empty($namapelajar) || empty($katas) || empty($nokppelajar) || strlen($nokppelajar) !== 12) {
    echo "Invalid input. Please fill in all fields correctly.";
    exit;
}

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
    // Redirect back to the pelajar registration page with an error message
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

$warden = $_SESSION['idwarden'];

// Interpolate variables directly into the SQL query
$sql = "INSERT INTO pelajar (warden, namapelajar, nokppelajar, kata) VALUES ('$warden', '$namapelajar', '$nokppelajar', '$kata')";

if ($conn->query($sql) === TRUE) {
    header('Location: index.php?menu=Student'); // Redirect to the desired page after successful insertion
    exit;
}

echo "Error: " . $conn->error;
$conn->close();