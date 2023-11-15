<?php
require '../include/conn.php';
/**
 * @var object $conn
 */
$idpelajar = $_GET['idpelajar'];

$sql_check = "SELECT * FROM peralatan WHERE pelajar = $idpelajar";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    echo "<div class='error-message'>Tidak boleh dipadam data pelajar. Rekod peralatan pelajar telah wujud.</div>";
} else {
    $sql_delete = "DELETE FROM pelajar WHERE idpelajar = $idpelajar";
    if ($conn->query($sql_delete)) {
        header('location: index.php?menu=Student');
        exit;
    } else {
        echo "<div class='error-message'>Data Pelajar Tidak Boleh Dipadam: </div>" . $conn->error;
    }
}


