<?php
require '../include/conn.php';
if (!isset($_SESSION['idadmin'])) header('location: ../');
$idadmin = $_SESSION['idadmin'];
$sql = "SELECT * FROM admin WHERE idadmin = $idadmin";
$row = $conn->query($sql)->fetch_object();
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
<form action="resetpassadmin.php" method="post">
    <input type="hidden" name="idadmin" value="<?php echo $row->idadmin; ?>">
    <fieldset>
        <legend><h1>Change password</h1></legend>
        <table>
            <tr>
                <th>Current Password</th>
                <td><input type="password" name="current_password" required></td>
            </tr>
            <tr>
                <th>New Password</th>
                <td><input type="password" name="new_password" required></td>
            </tr>
            <tr>
                <th>Confirm New Password</th>
                <td><input type="password" name="confirm_password" required></td>
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
