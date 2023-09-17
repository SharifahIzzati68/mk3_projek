<?php
require '../include/conn.php';
if (!isset($_SESSION['idadmin'])) {
    header('location: ../');
    exit;
}
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
    <title>Admin</title>
</head>
<body>
<h1><?php echo "Selamat Datang Admin"; ?></h1>
<table>
    <tr>
        <th>Sistem Admin</th>
        <td>
            <a href="index.php?menu=home">Home</a>
            ::
            <a href="index.php?menu=warden">Warden</a>
            ::
            <a href="index.php?menu=peralatanA">Carian Peralatan</a>
            ::
            <a href="index.php?menu=profile">Profile</a>
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
