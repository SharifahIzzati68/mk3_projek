<?php
/**
 * @var object $conn
 */
require '../include/conn.php';
$idpelajar = $_GET['idpelajar'];
$sql = "DELETE FROM pelajar WHERE idpelajar = $idpelajar";
$conn->query($sql);
if ($conn->query($sql)) {
    // Deletion successful, redirect back to student list page
    header('location: index.php?menu=Student');
    exit;
} else {
    // Error handling: Display an error message or log the error
    echo "Error deleting student: " . $conn->error;
}