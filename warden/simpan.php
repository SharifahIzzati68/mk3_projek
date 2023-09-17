<?php
require '../include/conn.php';
/** @var object $conn*/
// Validate and sanitize user input
$namapelajar = $_POST['namapelajar'];
$nokppelajar = $_POST['nokppelajar'];
$katas = $_POST['nokppelajar'];


// Check if the nosiri already exists
$check_sql = "SELECT COUNT(*) AS count FROM pelajar WHERE nokppelajar = '$nokppelajar'";
$check_result = $conn->query($check_sql);
$row = $check_result->fetch_assoc();

if ($row['count'] > 0) {
    // Redirect back to the warden registration page with an error message
    header('location: index.php?menu=Student&error=exists');
    exit;
}
$kata = password_hash($katas, PASSWORD_BCRYPT);
// Check if input is valid
if (empty($namapelajar) || empty($kata) || empty($nokppelajar) || strlen($nokppelajar) !== 12) {
    echo "Invalid input. Please fill in all fields correctly.";
    exit;
}

$warden = $_SESSION['idwarden'];

// Interpolate variables directly into the SQL query (not recommended for security)
$sql = "INSERT INTO pelajar (warden, namapelajar, nokppelajar, kata) VALUES ('$warden', '$namapelajar', '$nokppelajar', '$kata')";

$result = $conn->query($sql);

if ($result) {
    header('Location: index.php?menu=Student'); // Redirect to the desired page after successful insertion
    exit;
}

echo "Error: " . $conn->error;
$conn->close();