<?php
/**
 * @var object $conn
 * @var string $idwarden
 */

// Check for error messages from simpanPeralatan.php
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error === 'warden') {
        $error_message ="<div class='error-message'>The provided NRIC belongs to a warden.</div>";
    }
    if ($error === 'exists') {
        $error_message = "<div class='error-message'>The Student's Identification Number already exists in the database.</div>";
    } elseif ($error === 'invalid') {
        $error_message = "<div class='error-message'>Invalid input. Please fill in all fields correctly.</div>";
    }

}

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
    <title>Senarai Pelajar</title>
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
            <legend><h2>Daftar Pelajar</h2></legend>
            <table>
                <tr>
                    <th>Nama Pelajar </th>
                    <td><label>
                            <input type="text" name="namapelajar" required>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th class="th">NRIC </th>
                    <td>
                        <label>
                            <input type="text" name="nokppelajar" required minlength="12" maxlength="12">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td class="but1" colspan="2">
                        <button type="submit">SIMPAN</button>
                        <button type="reset">BATAL</button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    <?php
} else {
    if (isset($error_message)) {
        echo '<p class="error">' . $error_message . '</p>';
    }
    $idpelajar = $_GET['edit'];
    $sql = "SELECT * FROM pelajar WHERE idpelajar = $idpelajar";
    $row = $conn->query($sql)->fetch_object();
    ?>
    <form action="kemaskini.php?menu=Student" method="post">
        <input type="hidden" name="idpelajar" value="<?php echo $row->idpelajar; ?>">
        <fieldset>
            <legend><h2>Kemaskini Data Pelajar</h2></legend>
            <table>
                <tr>
                    <th>Nama Pelajar</th>
                    <td>
                        <label>
                            <input type="text" name="namapelajar" required value="<?php echo $row->namapelajar; ?>">
                        </label></td>
                </tr>
                <tr>
                    <th class="th">NRIC</th>
                    <td>
                        <label>
                            <input type="text" name="nokppelajar" required value="<?php echo $row->nokppelajar; ?>" minlength="12" maxlength="12">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td class="but1" colspan="2">
                        <button  type="submit">SIMPAN</button>
                        <button type="reset">BATAL</button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    <br>
    <?php
}
?>
<h2>Senarai Pelajar</h2>
<table class="table3">
    <tr class="tr3">
        <th class="tr4">Bil</th>
        <th class="tr4">Nama Pelajar</th>
        <th class="tr4">NRIC</th>
        <th class="tr4">Tindakan</th>

    </tr>
    <?php
    $bil = 1;
    $sql = "SELECT * FROM pelajar WHERE warden = '$idwarden'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_object()) {
        ?>
        <tr class="tr3">
            <td class="tr3"><?php echo $bil++; ?></td>
            <td class="tr3"><?php echo $row->namapelajar; ?></td>
            <td class="tr3"><?php echo $row->nokppelajar; ?></td>
            <td class="tr3">
                <a href="resestpassp.php?nokppelajar=<?php echo $row->nokppelajar; ?>&idpelajar=<?php echo $row->idpelajar; ?>">Reset
                    Kata Laluan</a>
                |
                <a href="index.php?edit=<?php echo $row->idpelajar; ?>& menu=Student">Kemaskini</a>
                |
                <a href="padam.php?idpelajar=<?php echo $row->idpelajar; ?>"
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
