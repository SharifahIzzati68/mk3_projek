<?php
global $conn;
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
<h2><?php echo "Selamat Datang $namawarden"; ?></h2>
<p><a href="../logout.php">LOGOUT</a></p>
<table>
    <tr>
        <td>System</td>
        <td>
            <a href="index.php?menu=Student">Student List</a>
            ::
            <a href="index.php?menu=peralatanP">Equipment List</a>
            ::
            <a href="index.php?menu=about">About</a>
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