<?php
/**
 * @var object $conn
 * @var string $idpelajar
 */
// Fetch the user's current profile information
$sql = "SELECT pelajar.namapelajar, pelajar.nokppelajar, warden.namawarden
        FROM pelajar
        INNER JOIN warden ON pelajar.warden = warden.idwarden
        WHERE pelajar.idpelajar = '$idpelajar'";
$row = $conn->query($sql)->fetch_object();

$namapelajar = $row->namapelajar;
$nokppelajar = $row->nokppelajar;
$namawarden = $row->namawarden;

// Check if the password reset form has been submitted
if (isset($_POST['reset_password'])) {
    // Get the current password from the form
    $current_password = $_POST['current_password'];

    // Get the new password from the form
    $new_password = $_POST['new_password'];

    // Get the confirm new password from the form
    $confirm_new_password = $_POST['confirm_new_password'];

    // Fetch the user's current password from the database
    $password_sql = "SELECT kata FROM pelajar WHERE idpelajar = '$idpelajar'";
    $password_result = $conn->query($password_sql);

    if ($password_result) {
        $row = $password_result->fetch_assoc();
        $current_hashed_password = $row['kata'];

        // Verify if the current password matches the stored password
        if (password_verify($current_password, $current_hashed_password)) {
            // Check if the new password and confirm new password match
            if ($new_password === $confirm_new_password) {
                // Hash the new password (for security)
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update the user's password in the database
                $update_sql = "UPDATE pelajar SET kata = '$hashed_password' WHERE idpelajar = '$idpelajar'";
                if ($conn->query($update_sql)) {
                    echo "Katalaluan berjaya dikemaskinikan!";
                } else {
                    echo "Error updating password: " . $conn->error;
                }
            } else {
                echo "Katalaluan baru dan katalaluan tetap tidak sepadan.";
            }
        } else {
            echo "Katalaluan tetap tidak sama.";
        }
    } else {
        echo "Error fetching current password: " . $conn->error;
    }
}

// Check if the edit form has been submitted
if (isset($_POST['update_profile'])) {
    // Get the updated profile information from the form
    $new_namapelajar = $_POST['new_namapelajar'];
    $new_nokppelajar = $_POST['new_nokppelajar'];

    // Update the user's profile information in the database
    $update_sql = "UPDATE pelajar SET namapelajar = '$new_namapelajar', nokppelajar = '$new_nokppelajar' WHERE idpelajar = '$idpelajar'";
    if ($conn->query($update_sql)) {
        echo "Profil berjaya dikemaskinikan!";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../include/spel.css">
    <title>Profile</title>
</head>
<body>
<h1>Profil</h1>
<table class="table3">
    <tr class="tr3">
        <th class="tableprofile">Nama Pelajar</th>
        <td class="tableprofile"><?php echo $namapelajar; ?></td>
    </tr>
    <tr class="tr3">
        <th class="tableprofile">No KP Pelajar</th>
        <td class="tableprofile"><?php echo $nokppelajar; ?></td>
    </tr>
    <tr class="tr3">
        <th class="tableprofile">Nama Warden</th>
        <td class="tableprofile"><?php echo $namawarden; ?></td>
    </tr>
</table>

<form action="index.php?menu=profilePelajar" method="post">
    <input type="hidden" name="update_profile" value="1">
    <fieldset>
        <legend><h2>Kemaskini Profil</h2></legend>
        <table>
            <tr>
                <th class="th">
                    <label for="new_namapelajar">Nama Baru:</label>
                </th>
                <td>
                    <label>
                        <input type="text" name="new_namapelajar" value="<?php echo $namapelajar; ?>" required>
                    </label>
                </td>
            </tr>

            <tr>
                <th>
                    <label for="new_nokppelajar">IC Nombor Baru:</label>
                </th>
                <td>
                    <label>
                        <input type="text" name="new_nokppelajar" value="<?php echo $nokppelajar; ?>" required minlength="12" maxlength="12">
                    </label>
                </td>
            </tr>
            <tr>
                <td class="but4" colspan="2">
                    <button type="submit">Kemaskini</button>
                </td>
            </tr>
        </table>
        <br>
    </fieldset>
</form>

<form action="index.php?menu=profilePelajar" method="post">
    <input type="hidden" name="reset_password" value="1">
    <fieldset>
        <legend>
            <h2>
                Tukar KataLaluan
            </h2>
        </legend>
        <table>
            <tr>
                <th class="th">
                    <label for="current_password">
                        KataLaluan Tetap:
                    </label>
                </th>
                <td>
                    <label>
                        <input type="password" name="current_password" required>
                    </label>
                </td>
            </tr>
            <tr>
                <th class="th">
                    <label for="new_password">
                        KataLaluan Baru:
                    </label>
                </th>
                <td>
                    <label>
                        <input type="password" name="new_password" required>
                    </label>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="confirm_new_password">
                        Sahkan Kata Laluan Baru:
                    </label>
                </th>
                <td>
                    <label>
                        <input type="password" name="confirm_new_password" required>
                    </label>
                </td>
            </tr>
            <tr>
                <td class="but5" colspan="2">
                    <button type="submit">Tukar Katalaluan</button>
                </td>
            </tr>
        </table>
        <br>
    </fieldset>
</form>
</body>
</html>
