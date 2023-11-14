<?php
/**
 * @var object $conn
 */
require '../include/conn.php';
if (!isset($_SESSION['idwarden'])) header('location: ../');
$idwarden = $_SESSION['idwarden'];

$sql = "SELECT namawarden FROM warden WHERE idwarden = $idwarden";
$row = $conn->query($sql)->fetch_object();
$namawarden = $row->namawarden;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warden</title>
</head>
<body>
<h1><?php echo "Selamat Datang $namawarden"; ?></h1>
<p></p>
<table>
    <tr>
        <th>Sistem Warden</th>
        <td>
            <a href="index.php?menu=Student">Senarai Pelajar</a>
            ::
            <a href="index.php?menu=peralatanP">Senarai Peralatan</a>
            ::
            <a href="index.php?menu=profile">Profil</a>
            ::
            <a href="../logout.php">Log Keluar</a>
        </td>
    </tr>
</table>
<?php
$menu = 'Student'; # default value
if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
}
include "$menu.php";
?>
</body>
</html>