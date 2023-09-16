<?php
global $conn;
session_start();
require '../include/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user input
    $namapelajar = $_POST['namapelajar'];
    $nokppelajar = $_POST['nokppelajar'];
    $katas = $_POST['nokppelajar'];
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
    } else {
        echo "Error: " . $conn->error;
        exit;
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
