<?php
/**
 * @var object $conn
 * @var string $idadmin
 */

if (isset($_POST['idadmin'])) {
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
                if ($conn->query($sql)) {
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

// Fetch the warden's current profile information
$sql = "SELECT * FROM admin WHERE idadmin = '$idadmin'";

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

$idadmin = $row->idadmin;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../include/spel.css">
    <title>Admin</title>
</head>
<body>
<form action="index.php?menu=kata" method="post">
    <input type="hidden" name="idadmin" value="<?php echo $row->idadmin; ?>">
    <fieldset>
        <legend><h1>Change password</h1></legend>
        <table>
            <tr>
                <th>Current Password</th>
                <td><label>
                        <input type="password" name="current_password" required>
                    </label></td>
            </tr>
            <tr>
                <th>New Password</th>
                <td><label>
                        <input type="password" name="new_password" required>
                    </label></td>
            </tr>
            <tr>
                <th>Confirm New Password</th>
                <td><label>
                        <input type="password" name="confirm_password" required>
                    </label></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">SIMPAN</button>
                </td>
            </tr>
        </table>
        <br>
    </fieldset>
</form>
</body>
</html>
