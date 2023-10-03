<?php
/**
 * @var object $conn
 */
require '../include/conn.php';
$namawarden = $_POST['namawarden'];
$nokpwarden = $_POST['nokpwarden'];

// Check if the nokpwarden (warden's identification number) already exists
$check_sql = "SELECT COUNT(*) AS count FROM warden WHERE nokpwarden = '$nokpwarden'";
$check_result = $conn->query($check_sql);
$row = $check_result->fetch_assoc();
if ($row['count'] > 0) {
    // Redirect back to the warden registration page with an error message
    header('location: index.php?menu=warden&error=exists');
    exit;
}
// Check if the provided 'nokppelajar' is not a warden's 'No.KP warden'
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

// Continue with the insertion if nokpwarden is unique
$kata = password_hash($nokpwarden, PASSWORD_BCRYPT);

// Check if input is valid
if (empty($namawarden) || empty($nokpwarden) || strlen($nokpwarden) !== 12) {
    // Redirect back to the warden registration page with an error message
    header('location: index.php?menu=warden&error=invalid');
    exit;
}

$sql = "INSERT INTO warden (namawarden, nokpwarden, kata) VALUES ('$namawarden', '$nokpwarden', '$kata')";
$result = $conn->query($sql);

if ($result) {
    header('location: index.php?menu=warden');
    exit;
} else {
    echo "Error: " . $conn->error;
}
