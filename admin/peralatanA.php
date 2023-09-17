<?php
require '../include/conn.php';

if (!isset($_SESSION['idadmin'])) {
    header('location: ../');
    exit; // Ensure script execution stops after redirection
}

$idadmin = $_SESSION['idadmin'];
$sql = "SELECT * FROM admin WHERE idadmin = $idadmin";
$row = $conn->query($sql)->fetch_object();
$namapelajar = $row->idadmin;

// Initialize variables for search results
$searchResults = [];
$searchMessage = '';

// Check if 'nosiri' is set in the POST data
if (isset($_POST['nosiri'])) {
    $nosiri = $_POST['nosiri'];

    // Query the equipment based on the serial number.
    $sql = "SELECT peralatan.nosiri, pelajar.namapelajar AS nama_pelajar, warden.namawarden AS nama_warden
            FROM peralatan
            INNER JOIN pelajar ON peralatan.pelajar = pelajar.idpelajar
            INNER JOIN warden ON pelajar.warden = warden.idwarden
            WHERE peralatan.nosiri = '$nosiri'";

    $result = $conn->query($sql);

    if ($result !== false && $result->num_rows > 0) {
        // Store search results in an array
        while ($row = $result->fetch_object()) {
            $searchResults[] = $row;
        }
    } else {
        // No equipment found for the provided serial number.
        $searchMessage = "No equipment found for the provided serial number.";
    }
}
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
<form action="index.php?menu=peralatanA" method="post">
    <fieldset>
        <legend><h1>Carian</h1></legend>
        <table>
            <tr>
                <th>No Siri Peralatan</th>
                <td><input type="text" name="nosiri"></td>
                <td colspan="2">
                    <button type="submit">Cari</button>
                </td>
            </tr>
        </table>
        <br>
    </fieldset>
</form>

<!-- Display search results here -->
<?php if (!empty($searchResults)) { ?>
    <h2>Hasil Carian</h2>
    <table>
        <tr>
            <th class="tableadmin">Bil</th>
            <th class="tableadmin">Nama Pelajar</th>
            <th class="tableadmin">Nama Warden</th>
            <th class="tableadmin">No. Siri Peralatan</th>
        </tr>
        <?php foreach ($searchResults as $bil => $result) { ?>
            <tr>
                <td class="tableadmin"><?php echo $bil + 1; ?></td>
                <td class="tableadmin"><?php echo $result->nama_pelajar; ?></td>
                <td class="tableadmin"><?php echo $result->nama_warden; ?></td>
                <td class="tableadmin"><?php echo $result->nosiri; ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } else if (!empty($searchMessage)) { ?>
    <p><?php echo $searchMessage; ?></p>
<?php } ?>
</body>
</html>
