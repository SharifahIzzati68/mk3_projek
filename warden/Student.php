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
    <title>Senarai Pelajar</title>
    <link rel="stylesheet" href="../include/spel.css">
</head>
<body>
<h2>Student List</h2>
<?php
if (!isset($_GET['edit'])) {
    ?>
    <form action="save.php" method="post">
        <fieldset>
            <legend>Daftar Pelajar</legend>
            <table>
                <tr>
                    <td>Nama Pelajar</td>
                    <td><label>
                            <input type="text" name="namapelajar" required>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>NRIC</td>
                    <td>
                        <label>
                            <input type="text" name="nokppelajar" required minlength="12" maxlength="12">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>Kata Laluan</td>
                    <td>
                        <label>
                            <input type="text" name="kata" >
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
    $idpelajar = $_GET['edit'];
    $sql = "SELECT * FROM pelajar WHERE idpelajar = $idpelajar";
    $row = $conn->query($sql)->fetch_object();
    ?>
    <form action="update.php" method="post">
        <input type="hidden" name="idpelajar" value="<?php echo $row->idpelajar; ?>">
        <fieldset>
            <legend>Kemaskini Data Pelajar</legend>
            <table>
                <tr>
                    <td>Nama Pelajar</td>
                    <td>
                        <label>
                            <input type="text" name="namapelajar" required value="<?php echo $row->namapelajar; ?>">
                        </label></td>
                </tr>
                <tr>
                    <td>NRIC</td>
                    <td>
                        <label>
                            <input type="text" name="nokppelajar" required value="<?php echo $row->nokppelajar; ?>" minlength="12" maxlength="12">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>Kata Laluan</td>
                    <td>
                        <label>
                            <input type="text" name="kata" required value="<?php echo $row->kata; ?>">
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
    <?php
}
?>

<table class="table3">
    <tr class="tr3">
        <th class="tr3">Bil</th>
        <th class="tr3">Student Name</th>
        <th class="tr3">NRIC</th>
        <th class="tr3">Action</th>

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
                <a href="Student.php?edit=<?php echo $row->idpelajar; ?>">Edit</a>
                |
                <a href="deletew.php?idpelajar=<?php echo $row->idpelajar; ?>"
                   onclick="return sahkan()">Delete</a>
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