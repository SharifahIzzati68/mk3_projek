<?php
/**
 * @var object $conn
 *  @var string $idpelajar
 */

// Check for error messages from simpan.php
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error === 'exists') {
        $error_message = "Equipment with this serial number already exists for you.";
    } elseif ($error === 'invalid') {
        $error_message = "Invalid input. Please fill in all fields correctly.";
    }
}

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
    <link rel="stylesheet" href="../include/spel.css">
</head>
<body>

<?php

if (isset($error_message)) {
    echo '<p class="error">' . $error_message . '</p>';
}
if (!isset($_GET['edit'])) {
    ?>
    <form action="simpan.php" method="post">
        <fieldset>
            <legend><h1>Peralatan</h1></legend>
            <table>
                <tr>
                    <th>Jenis Peralatan</th>
                    <td><label>
                            <input type="text" name="jenisperalatan" required>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th class="th">No Siri</th>
                    <td>
                        <label>
                            <input type="text" name="nosiri">
                        </label>
                    </td>
                </tr>
                <tr>
                    <th class="th">Jenama</th>
                    <td>
                        <label>
                            <input type="text" name="jenama">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td class="but" colspan="2">
                        <button type="submit">SIMPAN</button>
                        <button type="reset">BATAL</button>
                    </td>
                </tr>
            </table>
            <br>
        </fieldset>
    </form>
    <?php
} else {
    $idperalatan = $_GET['edit'];
    $sql = "SELECT * FROM peralatan WHERE idperalatan = $idperalatan AND pelajar = $idpelajar ORDER BY pelajar";
    $row = $conn->query($sql)->fetch_object();
    ?>
    <form action="kemaskini.php?" method="post">
        <input type="hidden" name="idperalatan" value="<?php echo $row->idperalatan; ?>">
        <fieldset>
            <legend><h1>Kemaskini Peralatan</h1></legend>
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
            <br>
        </fieldset>
    </form>
    <?php
}
?>
<br>
<h2>Senarai Peralatan</h2>
<table class="table3">
    <tr class="tr3">
        <th class="tr4">Bil</th>
        <th class="tr4">Jenis Peralatan</th>
        <th class="tr4">No siri</th>
        <th class="tr4">Jenama</th>
        <th class="tr4">Tindakan</th>
    </tr>
    <?php
    $bil = 1;
    $sql = "SELECT * FROM peralatan WHERE pelajar = $idpelajar";
    $result = $conn->query($sql);
    while ($row = $result->fetch_object()) {
        ?>
        <tr class="tr">
            <td class="tableprofile"><?php echo $bil++; ?></td>
            <td class="tableprofile"><?php echo $row->jenisperalatan; ?></td>
            <td class="tableprofile"><?php echo $row->nosiri; ?></td>
            <td class="tableprofile"><?php echo $row->jenama; ?></td>
            <td class="tableprofile">
                <a href="index.php?edit=<?php echo $row->idperalatan; ?>&menu=peralatanPelajar">Edit</a>
                |
                <a href="padamPelajar.php?idperalatan=<?php echo $row->idperalatan; ?>"
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
