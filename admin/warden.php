<?php
/**
 * @var object $conn
 *@var string $idadmin
 */

// Check for error messages from simpan.php
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error === 'pelajar') {
        $error_message = "The provided NRIC belongs to pelajar.";
    }
    if ($error === 'exists') {
        $error_message = "The Warden's Identification Number already exists in the database.";
    } elseif ($error === 'invalid') {
        $error_message = "Invalid input. Please fill in all fields correctly.";
    }
}

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
    <link rel="stylesheet" href="../include/spel.css">
    <title>Admin</title>

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
                <legend><h1>Daftar Warden Baru</h1></legend>
                <table>
                    <tr>
                        <th>Nama warden</th>
                        <td><input type="text" name="namawarden"></td>
                    </tr>
                    <tr>
                        <th>No. KP Warden</th>
                        <td><input type="text" name="nokpwarden" required maxlength="12" minlength="12"></td>
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
        if (isset($error_message)) {
            echo '<p class="error">' . $error_message . '</p>';
        }
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
                        <th>Nama Warden</th>
                        <td><input type="text" name="namawarden"
                                   required value="<?php echo $row->namawarden; ?>"></td>
                    </tr>
                    <tr>
                        <th>No. KP Warden</th>
                        <td><input type="text" name="nokpwarden"
                                   required value="<?php echo $row->nokpwarden; ?>" minlength="12"
                                   maxlength="12"></td>
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
        <br>
        <?php
    }
    ?>

    <br>
    <h2>Senarai Warden</h2>

    <table class="table3">
        <tr class="tr3">
            <th class="tr4">Bil</th>
            <th class="tr4">Nama Warden</th>
            <th class="tr4">No. KP Warden</th>
            <th class="tr4">Tindakan</th>
        </tr>
        <?php
        $bil = 1;
        $sql = "SELECT * FROM warden ORDER BY namawarden";
        $result = $conn->query($sql);
        while ($row = $result->fetch_object()) {
            ?>
            <tr class="tr3">
                <td class="tableadmin"><?php echo $bil++; ?></td>
                <td class="tableadmin"><?php echo $row->namawarden; ?></td>
                <td class="tableadmin"><?php echo $row->nokpwarden; ?></td>
                <td class="tableadmin">
                    <a href="resetpassWarden.php?nokpwarden=<?php echo $row->nokpwarden; ?>&idwarden=<?php echo $row->idwarden; ?>">Reset
                        Kata Laluan</a>
                    |
                    <a href="index.php?edit=<?php echo $row->idwarden; ?>&menu=warden">Edit</a>
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
