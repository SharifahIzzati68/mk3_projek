<?php
global $conn;
require '../include/conn.php';
if (!isset($_SESSION['idpelajar'])) header('location: ../');
$idpelajar = $_SESSION['idpelajar'];
$sql = "SELECT namapelajar,nokppelajar FROM pelajar WHERE idpelajar = $idpelajar";
$row = $conn->query($sql)->fetch_object();
$namapelajar = $row->namapelajar;
$nokppelajar = $row->nokppelajar;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pendaftaran Peralatan Elektrik</title>
</head>
<body>
<?php echo "Selamat Datang $namapelajar"; ?>
<p><a href="../logout.php">LOGOUT</a></p>
<table>
    <tr>
        <td>Sistem Pelajar/td>
        <td>
            <a href="index.php?menu=home">Home Pelajar</a>
            ::
            <a href="index.php?menu=peralatan">Senarai Peralatan</a>
            ::
            <a href="index.php?menu=profile">Profile</a>
        </td>
    </tr>
</table>
<?php
$menu = 'home'; # default value
if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
}
include "$menu.php";
?>
</body>
    </html>
