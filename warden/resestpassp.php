<?php
require '../include/conn.php';
$idpelajar = $_GET['idpelajar'];
$nokppelajar= $_GET['nokppelajar'];
// Hash the new password (for security)
$hashed_password = password_hash($nokppelajar, PASSWORD_DEFAULT);

// Update the user's password in the database
$sql = "UPDATE pelajar SET kata = '$hashed_password' WHERE idpelajar = '$idpelajar'";
if ($conn->query($sql)) {
    echo "Password updated successfully!";
} else {
    echo "Error updating password: " . $conn->error;
}
header('location: index.php?menu=Student');