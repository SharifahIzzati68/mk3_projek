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

    // Interpolate variables directly into the SQL query (not recommended for security)
    $sql = "INSERT INTO peralatan (pelajar, jenisperalatan, nosiri, jenama) VALUES ('$pelajar', '$jenisperalatan', '$nosiri', '$jenama')";

    $result = $conn->query($sql);

    if ($result) {
        header('Location: index.php?menu=peralatan');
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method.";
}
