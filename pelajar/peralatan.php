<?php
global $conn;
require '../include/conn.php';
if (!isset($_SESSION['idpelajar'])) header('location: ../');
$idpelajar = $_SESSION['idpelajar'];
$sql = "SELECT namapelajar FROM pelajar WHERE idpelajar = $idpelajar";
$row = $conn->query($sql)->fetch_object();
$namapelajar = $row->namapelajar;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Peralatan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Senarai Peralatan</h2>
<?php
if (!isset($_GET['edit'])) {
    ?>
    <form action="simpan.php" method="post">
        <fieldset>
            <legend>Peralatan</legend>
            <table>
                <tr>
                    <td>Jenis Peralatan</td>
                    <td><label>
                            <input type="text" name="jenisperalatan" required>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>No Siri</td>
                    <td>
                        <label>
                            <input type="text" name="nosiri" >
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>Jenama</td>
                    <td>
                        <label>
                            <input type="text" name="jenama" >
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">SIMPAN</button>
                        <button type="reset">BATAL</button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    <?php
} else {
    $idperalatan = $_GET['edit'];
    $sql = "SELECT * FROM peralatan WHERE idperalatan = $idperalatan ORDER BY pelajar";
    $row = $conn->query($sql)->fetch_object();
    ?>
    <form action="kemaskini.php" method="post">
        <input type="hidden" name="idperalatan" value="<?php echo $row->idperalatan; ?>">
        <fieldset>
            <legend>Kemaskini Peralatan</legend>
            <table>
                <tr>
                    <td>Jenis Peralatan</td>
                    <td>
                        <label>
                            <input type="text" name="jenisperalatan" required value="<?php echo $row->jenisperalatan; ?>">
                        </label></td>
                </tr>
                <tr>
                    <td>No Siri</td>
                    <td>
                        <label>
                            <input type="text" name="nosiri" required value="<?php echo $row->nosiri; ?>">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>Jenama</td>
                    <td>
                        <label>
                            <input type="text" name="jenama" required value="<?php echo $row->jenama; ?>">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">SIMPAN</button>
                        <button type="reset">BATAL</button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    <br>
    <a href="index.php?menu=peralatan">Kembali ke Senarai Peralatan</a>
    <br>
    <?php
}
?>
<br>
<table class="table" border="1">
    <tr>
        <th>Bil</th>
        <th>Jenis Peralatan</th>
        <th>No siri</th>
        <th>Jenama</th>
        <th>Tindakan</th>
    </tr>
    <?php
    $bil = 1;
    $sql = "SELECT * FROM peralatan WHERE pelajar = '$idpelajar'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_object()) {
        ?>
        <tr>
            <td><?php echo $bil++; ?></td>
            <td><?php echo $row->jenisperalatan; ?></td>
            <td><?php echo $row->nosiri; ?></td>
            <td><?php echo $row->jenama; ?></td>
            <td>
                <a href="peralatan.php?edit=<?php echo $row->idperalatan; ?>">Edit</a>
                |
                <a href="padam.php?idperalatan=<?php echo $row->idperalatan; ?>"
                   onclick="return sahkan()">Padam</a>
            </td>
        </tr>
        <?php
    }
    ?>

</table>
<script>
    function sahkan() {
        return confirm('Adakah anda pasti?');
    }
</script>
</body>
</html>
