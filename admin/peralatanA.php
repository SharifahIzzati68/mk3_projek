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

<form action="peralatanA.php" method="post">
    <fieldset>
        <legend>Carian</legend>
        <table>
            <tr>
                <td>No Siri Peralatan</td>
                <td><input type="text" name="nosiri"></td>

                <td colspan="2">
                    <button type="submit">Cari</button>
                </td>
            </tr>
        </table>
    </fieldset>
</form>
<?php
// Your database connection code (require 'conn.php') should be here.

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nosiri'])) {
// Handle the equipment search here.
$nosiri = $_POST['nosiri'];

// Query the equipment based on the serial number.
$sql = "SELECT peralatan.nosiri, pelajar.namapelajar AS nama_pelajar, warden.namawarden AS nama_warden
        FROM peralatan
        INNER JOIN pelajar ON peralatan.pelajar = pelajar.idpelajar
        INNER JOIN warden ON pelajar.warden = warden.idwarden
        WHERE peralatan.nosiri = '$nosiri'";

$result = $conn->query($sql);
?>
    <!-- Display the equipment results here -->
<table class="table">
    <tr>
        <th>Bil</th>
        <th>Nama Pelajar</th>
        <th>Nama Warden</th>
        <th>No. Siri Peralatan</th>
    </tr>
    <?php
    $bil = 1;
    while ($row = $result->fetch_object()) {
        ?>
        <tr>
            <td><?php echo $bil++; ?></td>
            <td><?php echo $row->nama_pelajar; ?></td>
            <td><?php echo $row->nama_warden; ?></td>
            <td><?php echo $row->nosiri; ?></td>
        </tr>
        <?php
    }
    ?>
    <?php
    }
    ?>
</table>


</body>
</html>

