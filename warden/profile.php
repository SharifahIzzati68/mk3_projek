<?php
/**
 * @var string $idwarden
 * @var object $conn
 */
// Check if the password reset form has been submitted
if (isset($_POST['reset_password'])) {
    // Get the new password and confirm password from the form
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the new password matches the confirm password
    if ($new_password === $confirm_password) {
        // Fetch the warden's current hashed password
        $fetch_password_sql = "SELECT kata FROM warden WHERE idwarden = '$idwarden'";
        $password_result = $conn->query($fetch_password_sql);

        if ($password_result && $password_result->num_rows > 0) {
            $current_password = $password_result->fetch_object()->kata;

            // Check if the entered current password matches the stored password
            if (password_verify($_POST['current_password'], $current_password)) {
                // Hash the new password (for security)
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the warden's password in the database
                $update_sql = "UPDATE warden SET kata = '$hashed_password' WHERE idwarden = '$idwarden'";
                if ($conn->query($update_sql)) {
                    echo "Kata Laluan berjaya dikemaskini";
                } else {
                    echo "<div class='error-message'>Kata Laluan Tidak Berjaya dikemaskini: </div>" . $conn->error;
                }
            } else {
                echo "<div class='error-message'>Kata laluan semasa adalah tidak betul.</div>";
            }
        } else {
            echo "<div class='error-message'>Ralat semasa mengambil kata laluan semasa: </div>" . $conn->error;
        }
    } else {
        echo "<div class='error-message'>Kata laluan baharu dan sahkan kata laluan tidak sepadan.</div>";
    }
}
// Check if the edit form has been submitted
if (isset($_POST['update_profile'])) {
    // Get the updated profile information from the form
    $new_namawarden = $_POST['new_namawarden'];
    $new_nokpwarden = $_POST['new_nokpwarden'];

    // Update the warden's profile information in the database
    $update_sql = "UPDATE warden SET namawarden = '$new_namawarden', nokpwarden = '$new_nokpwarden' WHERE idwarden = '$idwarden'";
    if ($conn->query($update_sql)) {
        echo "Profile updated successfully!";
    } else {
        echo "<div class='error-message'>Error updating profile: </div>" . $conn->error;
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
    echo "<div class='error-message'>No data found for this warden.</div>";
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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../include/spel.css">
    <title>Profil</title>
</head>
<body>
<h1>Profil</h1>
<table class="table3">
    <tr class="tr3">
        <th class="tableprofile">Nama warden</th>
        <td class="tableprofile1"><?php echo $namawarden; ?></td>
    </tr>
    <tr class="tr3">
        <th class="tableprofile">No KP warden</th>
        <td class="tableprofile1"><?php echo $nokpwarden; ?></td>
    </tr>
</table>

<form action="index.php?menu=profile" method="post">
    <input type="hidden" name="update_profile" value="1">
    <fieldset>
        <legend>
            <h2>Kemaskini Profil</h2>
        </legend>
        <table>
            <tr>
                <th class="th">
                    <label for="new_namawarden">Nama Baru:</label>
                </th>
                <td>
                    <label>
                        <input type="text" name="new_namawarden" value="<?php echo $namawarden; ?>" required>
                    </label>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="new_nokpwarden">No Ic Baru:</label>
                </th>
                <td><label>
                        <input type="text" name="new_nokpwarden" value="<?php echo $nokpwarden; ?>" required minlength="12" maxlength="12">
                    </label></td>
            </tr>
            <tr>
                <td class="but2"  colspan="2">
                    <button type="submit">Kemaskini Profil</button>
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
            <h2>Tukar Kata Laluan</h2>
        </legend>
        <table>
            <tr>
                <th>
                    <label for="current_password">Kata Laluan Semasa:</label>
                </th>
                <td>
                    <label>
                        <input type="password" name="current_password" required>
                    </label>
                </td>
            </tr>
            <tr>
                <th class="th">
                    <label for="new_password">Kata Laluan Baru:</label>
                </th>
                <td>
                    <label>
                        <input type="password" name="new_password" required>
                    </label>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="confirm_password">Sahkan Kata Laluan:</label>
                </th>
                <td>
                    <label>
                        <input type="password" name="confirm_password" required>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="but3" colspan="2">
                    <button type="submit">Tukar Kata Laluan</button>
                </td>
            </tr>
        </table>
        <br>
    </fieldset>
</form>
</body>
</html>