<?php
require '../include/conn.php';
/**
 * @var object $conn
 */
if (!isset($_SESSION['idpelajar'])) header('location: ../');
$idpelajar = $_SESSION['idpelajar'];

$sql = "SELECT namapelajar, nokppelajar FROM pelajar WHERE idpelajar = $idpelajar";
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
<h1><?php echo "Selamat Datang $namapelajar"; ?></h1>

<table>
    <tr>
        <th>Sistem Pelajar</th>
        <td>
            <a href="index.php?menu=home">Laman Utama</a>
            ::
            <a href="index.php?menu=peralatanPelajar">Senarai Peralatan</a>
            ::
            <a href="index.php?menu=profilePelajar">Profil</a>
            ::
            <a href="../logout.php">Logout</a>
        </td>
    </tr>
</table>
<?php
$menu = 'home'; // Default value
if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
}
include "$menu.php";
?>
</body>
</html>
