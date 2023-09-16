<?php
global $conn;
require '../include/conn.php';

if (!isset($_SESSION['idpelajar'])) {
    header('location: ../');
    exit;
}

$idpelajar = $_SESSION['idpelajar'];

// Check if the password reset form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password'])) {
    // Get the new password from the form
    $new_password = $_POST['new_password'];

    // Hash the new password (for security)
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $update_sql = "UPDATE pelajar SET kata = '$hashed_password' WHERE idpelajar = '$idpelajar'";
    if ($conn->query($update_sql)) {
        echo "Password updated successfully!";
    } else {
        echo "Error updating password: " . $conn->error;
    }
}

// Check if the edit form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    // Get the updated profile information from the form
    $new_namapelajar = $_POST['new_namapelajar'];
    $new_nokppelajar = $_POST['new_nokppelajar'];

    // Update the user's profile information in the database
    $update_sql = "UPDATE pelajar SET namapelajar = '$new_namapelajar', nokppelajar = '$new_nokppelajar' WHERE idpelajar = '$idpelajar'";
    if ($conn->query($update_sql)) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

// Fetch the user's current profile information
$sql = "SELECT pelajar.namapelajar, pelajar.nokppelajar, warden.namawarden
        FROM pelajar
        INNER JOIN warden ON pelajar.warden = warden.idwarden
        WHERE pelajar.idpelajar = '$idpelajar'";

$result = $conn->query($sql);

if (!$result) {
    echo "Error: " . $conn->error;
    exit;
}

$row = $result->fetch_object();

if (!$row) {
    echo "No data found for this student.";
    exit;
}

$namapelajar = $row->namapelajar;
$nokppelajar = $row->nokppelajar;
$namawarden = $row->namawarden;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../include/styllePelajar.css">
    <title>Profile</title>
</head>
<body>
<h1>Profile</h1>
<table>
    <tr>
        <th class="tableprofile">Nama Pelajar</th>
        <td class="tableprofile"><?php echo $namapelajar; ?></td>
    </tr>
    <tr>
        <th class="tableprofile">No KP Pelajar</th>
        <td class="tableprofile"><?php echo $nokppelajar; ?></td>
    </tr>
    <tr>
        <th class="tableprofile">Nama Warden</th>
        <td class="tableprofile"><?php echo $namawarden; ?></td>
    </tr>
</table>


<form action="index.php?menu=profile" method="post">
    <input type="hidden" name="update_profile" value="1">
    <fieldset>
        <legend><h2>Edit Profile</h2></legend>
            <table>
                <tr>
                    <th>
                        <label for="new_namapelajar">New Name:</label>
                    </th>
                    <td>
                        <label>
                            <input type="text" name="new_namapelajar" value="<?php echo $namapelajar; ?>" required>
                        </label>
                    </td>
                </tr>

                <tr>
                    <th>
                        <label for="new_nokppelajar">New IC Number:</label>
                    </th>
                    <td>
                        <label>
                            <input type="text" name="new_nokppelajar" value="<?php echo $nokppelajar; ?>" required minlength="12" maxlength="12">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit">
                            Update
                        </button>
                    </td>
                </tr>
            </table>
        <br>
    </fieldset>
</form>

<form action="index.php?menu=profile" method="post">
    <input type="hidden" name="reset_password" value="1">
    <fieldset>
        <legend>
            <h2>
                Change Password
            </h2>
        </legend>
        <label for="new_password">
            New Password:
        </label>
        <label>
            <input type="password" name="new_password" required>
        </label>
        <button type="submit">
            Change Password
        </button>
        <br>
        <br>
    </fieldset>
</form>
</body>
</html>
