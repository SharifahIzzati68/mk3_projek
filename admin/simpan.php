<?php
/** @var object $conn */
require '../include/conn.php';
$namawarden = $_POST['namawarden'];
$nokpwarden = $_POST['nokpwarden'];
$kata = password_hash($nokpwarden, PASSWORD_BCRYPT);

// Check if input is valid
if (empty($namawarden) || empty($nokpwarden) || strlen($nokpwarden) !== 12) {
echo "Invalid input. Please fill in all fields correctly.";
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
