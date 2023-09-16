<?php
/** @var object $conn */
$conn;
require '../include/conn.php';

// Check if the user is logged in as a warden
if (!isset($_SESSION['idwarden'])) {
    header('location: ../');
    exit;
}

$idwarden = $_SESSION['idwarden'];

// Check if the password reset form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password'])) {
    // Get the new password from the form
    $new_password = $_POST['new_password'];

    // Hash the new password (for security)
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the warden's password in the database
    $update_sql = "UPDATE warden SET kata = '$hashed_password' WHERE idwarden = '$idwarden'";
    if ($conn->query($update_sql)) {
        echo "Password updated successfully!";
    } else {
        echo "Error updating password: " . $conn->error;
    }
}

// Check if the edit form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    // Get the updated profile information from the form
    $new_namawarden = $_POST['new_namawarden'];
    $new_nokpwarden = $_POST['new_nokpwarden'];

    // Update the warden's profile information in the database
    $update_sql = "UPDATE warden SET namawarden = '$new_namawarden', nokpwarden = '$new_nokpwarden' WHERE idwarden = '$idwarden'";
    if ($conn->query($update_sql)) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

// Fetch the warden's current profile information
$sql = "SELECT * FROM warden WHERE idwarden = '$idwarden'";

$result = $conn->query($sql);

if (!$result) {
    echo "Error: " . $conn->error;
    exit;
}

$row = $result->fetch_object();

if (!$row) {
    echo "No data found for this warden.";
    exit;
}

$namawarden = $row->namawarden;
$nokpwarden = $row->nokpwarden;
$kata = $row->kata;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>
<body>
<h1>Profile</h1>
<table border="1">
    <tr>
        <th>Nama warden</th>
        <td><?php echo $namawarden; ?></td>
    </tr>
    <tr>
        <th>No KP warden</th>
        <td><?php echo $nokpwarden; ?></td>
    </tr>
</table>

<h2>Edit Profile</h2>
<form action="index.php?menu=profile" method="post">
    <input type="hidden" name="update_profile" value="1">
    <label for="new_namawarden">New Name:</label>
    <label>
        <input type="text" name="new_namawarden" value="<?php echo $namawarden; ?>" required>
    </label>
    <br>
    <label for="new_nokpwarden">New IC Number:</label>
    <label>
        <input type="text" name="new_nokpwarden" value="<?php echo $nokpwarden; ?>" required minlength="12" maxlength="12">
    </label>
    <br>
    <button type="submit">Update Profile</button>
</form>

<h2>Change Password</h2>
<form action="index.php?menu=profile" method="post">
    <input type="hidden" name="reset_password" value="1">
    <label for="new_password">New Password:</label>
    <label>
        <input type="password" name="new_password" required>
    </label>
    <button type="submit">Change Password</button>
</form>
</body>
</html>
