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
                    echo "Kata laluan berjaya dikemaskini!";
                } else {
                    echo "Ralat semasa mengemaskini kata laluan: " . $conn->error;
                }
            } else {
                echo "Kata laluan baru dan pengesahan kata laluan baru tidak sepadan.";
            }
        } else {
            echo "Kata laluan semasa tidak betul.";
        }
    } else {
        echo "Ralat mendapatkan kata laluan semasa: " . $conn->error;
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
    echo "Tiada data warden yang dijumpai .";
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
<form action="index.php?menu=kata_warden" method="post">
    <input type="hidden" name="idadmin" value="<?php echo $row->idadmin; ?>">
    <fieldset>
        <legend><h1>Tukar Kata Laluan</h1></legend>
        <table>
            <tr>
                <th class="th">Kata Laluan Semasa</th>
                <td><label>
                        <input type="password" name="current_password" required>
                    </label></td>
            </tr>
            <tr>
                <th class="th">Kata Laluan Baru</th>
                <td><label>
                        <input type="password" name="new_password" required>
                    </label></td>
            </tr>
            <tr>
                <th>Pengesahan Kata Laluan Baru</th>
                <td><label>
                        <input type="password" name="confirm_password" required>
                    </label></td>
            </tr>
            <tr>
                <td class="but6" colspan="2">
                    <button type="submit">SIMPAN</button>
                </td>
            </tr>
        </table>
        <br>
    </fieldset>
</form>
</body>
</html>
