<?php
global $conn;
session_start();
require '../include/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user input
    $namapelajar = filter_input(INPUT_POST, 'namapelajar', FILTER_SANITIZE_STRING);
    $nokppelajar = filter_input(INPUT_POST, 'nokppelajar', FILTER_SANITIZE_STRING);
    $katas = filter_input(INPUT_POST, 'nokppelajar', FILTER_SANITIZE_STRING);
    $kata = password_hash($katas, PASSWORD_BCRYPT);

    // Check if input is valid
    if (empty($namapelajar)|| empty($kata) || empty($nokppelajar) || strlen($nokppelajar) !== 12) {
        echo "Invalid input. Please fill in all fields correctly.";
        exit;
    }
    $warden = $_SESSION['idwarden'];

    // Use prepared statement to prevent SQL injection
    $sql = "INSERT INTO pelajar (warden, namapelajar, nokppelajar, kata) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Database error: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssss", $warden,$namapelajar, $nokppelajar, $kata);

    if ($stmt->execute()) {
        header('Location: index.php?menu=Student'); // Redirect to the desired page after successful insertion
        exit;
    } else {
        echo "Error: " . $stmt->error;
        exit;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}

