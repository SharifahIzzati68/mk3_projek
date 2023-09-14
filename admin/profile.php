<?php global $conn;
require '../include/conn.php';
if (!isset($_SESSION['idadmin'])) header('location: ../');
$idadmin = $_SESSION['idadmin'];
$sql = "SELECT * FROM admin WHERE idadmin = $idadmin";
$row = $conn->query($sql)->fetch_object();
$namapelajar = $row->idadmin;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

</head>
<body>


<form action="resetpassadmin.php" method="post">
    <fieldset>
        <legend>reset password</legend>
        <table>
            <tr>
                <td><input type="text" name="idadmin"></td>
                <td colspan="2">
                    <button type="submit">SIMPAN</button>
                </td>
            </tr>
        </table>
    </fieldset>
</form>


</body>
</html>


