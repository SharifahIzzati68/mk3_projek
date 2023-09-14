<?php global $conn;
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
    <title>Admin</title>

</head>
<body>

<?php echo "Selamat Datang Admin"; ?>
<p><a href="../logout.php">LOGOUT</a></p>
<table>
    <tr>
        <td>System for Student</td>
        <td>
            <a href="index.php?menu=home">Home Pelajar</a>
            ::
            <a href="index.php?menu=peralatanA">Senarai Peralatan</a>
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

