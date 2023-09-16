<?php
global $conn;
session_start();
require '../include/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user input
    $jenisperalatan = filter_input(INPUT_POST, 'jenisperalatan', FILTER_SANITIZE_STRING);
    $nosiri = filter_input(INPUT_POST, 'nosiri', FILTER_SANITIZE_STRING);
    $jenama = filter_input(INPUT_POST, 'jenama', FILTER_SANITIZE_STRING);

    // Check if input is valid
    if (empty($jenisperalatan) || empty($nosiri) || empty($jenama)) {
        echo "Invalid input. Please fill in all fields correctly.";
        exit;
    }

    // Set the 'pelajar' value to the appropriate user ID (you need to determine this)
    $pelajar = $_SESSION['idpelajar']; // Update this based on your session structure

    $sql = "INSERT INTO peralatan (pelajar, jenisperalatan, nosiri, jenama) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Database error: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssss", $pelajar, $jenisperalatan, $nosiri, $jenama);

    if ($stmt->execute()) {
        header('Location: index.php?menu=peralatan');
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}

