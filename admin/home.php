<?php
require '../include/conn.php';
global $conn;
if (!isset($_SESSION['idadmin'])) header('location: ../');
$idadmin = $_SESSION['idadmin'];
$sql = "SELECT * FROM admin WHERE idadmin = $idadmin";
$row = $conn->query($sql)->fetch_object();
$namapelajar = $row->idadmin; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

</head>
<body>

<?php
if (!isset($_GET['edit'])) {
    ?>
    <form action="simpan.php" method="post">
        <fieldset>
            <legend><h1>Daftar Warden Baru</h1></legend>
            <table>
                <tr>
                    <td>Nama warden</td>
                    <td><input type="text" name="namawarden"></td>
                </tr>
                <tr>
                    <td>No. KP</td>
                    <td><input type="text" name="nokpwarden" required maxlength="12" minlength="12"></td>
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
            <legend><h1>Kemaskini Data Warden</h1></legend>
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
                    <td colspan="2">
                        <button type="submit">SIMPAN</button>
                        <button type="reset">BATAL</button>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    <br>
    <a href="index.php?menu=home">Kembali ke Senarai Warden</a>
    <?php
}
?>

<br>
<h2>Senarai Warden</h2>

<table  border="1">
    <tr>
        <th>Bil</th>
        <th>Nama Warden</th>
        <th>No. KP</th>
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
            <td>
                <a href="resetpass.php?nokpwarden=<?php echo $row->nokpwarden; ?>&idwarden=<?php echo $row->idwarden; ?>">Reset
                    Kata Laluan</a>
                |
                <a href="home.php?edit=<?php echo $row->idwarden; ?>">Edit</a>
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


