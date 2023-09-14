<?php
global $conn;
require '../include/conn.php';
if (!isset($_SESSION['idwarden'])) header('location: ../');
$idwarden = $_SESSION['idwarden'];
$sql = "SELECT namawarden FROM warden WHERE idwarden = $idwarden";
$row = $conn->query($sql)->fetch_object();
$namawarden = $row->namawarden;
?>
<!-- Display the equipment results here -->
<table border="1" class="table">
    <tr>
        <th>Bil</th>
        <th>Nama Pelajar</th>
        <th>No KP Pelajar</th>
        <th>No. Siri Peralatan</th>
        <th>Jenis Peralatan</th>
        <th>Jenama Peralatan</th>
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
            <td><?php echo $bil++; ?></td>
            <td><?php echo $row->namapelajar; ?></td>
            <td><?php echo $row->nokppelajar; ?></td>
            <td><?php echo $row->nosiri; ?></td>
            <td><?php echo $row->jenisperalatan; ?></td>
            <td><?php echo $row->jenama; ?></td>
        </tr>
        <?php
    }
    ?>
</table>

