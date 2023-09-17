<?php
require '../include/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idadmin = $_POST['idadmin'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the current password is correct
    $sql = "SELECT kata FROM admin WHERE idadmin = $idadmin";
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_object()) {
        $hashed_password = $row->kata;

        if (password_verify($current_password, $hashed_password)) {
            // Check if the new password and confirm password match
            if ($new_password === $confirm_password) {
                $hash_password = password_hash($new_password, PASSWORD_BCRYPT);
                $sql = "UPDATE admin SET kata = '$hash_password' WHERE idadmin = $idadmin";
                $conn->query($sql);

                // Update the user's password in the database
                $update_sql = "UPDATE admin SET kata = '$hashed_password' WHERE idadmin = '$idadmin'";
                if ($conn->query($update_sql)) {
                    echo "Password updated successfully!";
                } else {
                    echo "Error updating password: " . $conn->error;
                }
            } else {
                echo "New password and confirm new password do not match.";
            }
        } else {
            echo "Current password is incorrect.";
        }
    } else {
        echo "Error fetching current password: " . $conn->error;
    }
}