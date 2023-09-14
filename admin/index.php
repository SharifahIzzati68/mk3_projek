<?php global $conn;
require '../include/conn.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

</head>
<body>

<form action="index.php" method="post">
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
<form action="resetpassadmin.php" method="post">
    <fieldset>
        <legend>reset password</legend>
        <table>
            <tr>
                <td><input type="text" name="idadmin"></td>
                <td colspan="2">
                    <button type="submit">SIMPAN</button>
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
<h2>Senarai Warden</h2>

<?php
if (!isset($_GET['edit'])) {
?>
<form action="simpan.php" method="post">
    <fieldset>
        <legend>Daftar Warden Baru</legend>
        <table>
            <tr>
                <td>Nama warden</td>
                <td><input type="text" name="namawarden"></td>
            </tr>
            <tr>
                <td>No. KP</td>
                <td><input type="text" name="nokpwarden"></td>
            </tr>
            <tr>
                <td>Kata</td>
                <td><input type="text" name="kata"></td>
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
$idwarden = $_GET['edit'];
$sql = "SELECT * FROM warden WHERE idwarden = $idwarden";
$row = $conn->query($sql)->fetch_object();
?>
<form action="kemaskini.php" method="post">
    <input type="hidden" name="idwarden" value="<?php echo $row->idwarden; ?>">
    <fieldset>
        <legend>Kemaskini Data Warden</legend>
        <table>
            <tr>
                <td>Nama Warden</td>
                <td><input type="text" name="namawarden"
                           required value="<?php echo $row->namawarden; ?>"></td>
            </tr>
            <tr>
                <td>No. KP</td>
                <td><input type="text" name="nokpwarden"
                           required value="<?php echo $row->nokpwarden; ?>" minlength="12"
                           maxlength="12"></td>
            </tr>
            <tr>
                <td>Kata</td>
                <td><input type="text" name="kata"
                           required value="<?php echo $row->kata; ?>" minlength="5"
                           maxlength="5"></td>
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
}
?>
<table class="table">
    <tr>
        <th>Bil</th>
        <th>Nama Warden</th>
        <th>No. KP</th>
        <th>Kata</th>
    </tr>
    <?php
    $bil = 1;
    $sql = "SELECT * FROM warden ORDER BY namawarden";
    $result = $conn->query($sql);
    while ($row = $result->fetch_object()) {
        ?>
        <tr>
            <td><?php echo $bil++; ?></td>
            <td><?php echo $row->namawarden; ?></td>
            <td><?php echo $row->nokpwarden; ?></td>
            <td><?php echo $row->kata; ?></td>
            <td>
                <a href="resetpass.php?nokpwarden=<?php echo $row->nokpwarden; ?>&idwarden=<?php echo $row->idwarden; ?>">Reset
                    Kata Laluan</a>
                |
                <a href="index.php?edit=<?php echo $row->idwarden; ?>">Edit</a>
                |
                <a href="padam.php?idwarden=<?php echo $row->idwarden; ?>"
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

