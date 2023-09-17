<?php
require '../include/conn.php';
if (!isset($_SESSION['idwarden'])) header('location: ../');
$idwarden = $_SESSION['idwarden'];
$sql = "SELECT namawarden FROM warden WHERE idwarden = $idwarden";
$row = $conn->query($sql)->fetch_object();
$namawarden = $row->namawarden;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../include/spel.css">
    <title>Warden</title>
</head>
<body>
    <!-- Display the equipment results here -->
    <table>
        <tr>
            <th class="tr3">Bil</th>
            <th class="tr3">Nama Pelajar</th>
            <th class="tr3">No KP Pelajar</th>
            <th class="tr3">No. Siri Peralatan</th>
            <th class="tr3">Jenis Peralatan</th>
            <th class="tr3">Jenama Peralatan</th>
        </tr>
        <?php
        $bil = 1;
        $sql = "SELECT pelajar.namapelajar, pelajar.nokppelajar, peralatan.nosiri, peralatan.jenisperalatan, peralatan.jenama FROM pelajar
                INNER JOIN peralatan ON pelajar.idpelajar = peralatan.pelajar
                INNER JOIN warden ON pelajar.warden = warden.idwarden
                WHERE warden.namawarden = '$namawarden'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_object()) {
            ?>
            <tr>
                <td class="tr3"><?php echo $bil++; ?></td>
                <td class="tr3"><?php echo $row->namapelajar; ?></td>
                <td class="tr3"><?php echo $row->nokppelajar; ?></td>
                <td class="tr3"><?php echo $row->nosiri; ?></td>
                <td class="tr3"><?php echo $row->jenisperalatan; ?></td>
                <td class="tr3"><?php echo $row->jenama; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>

