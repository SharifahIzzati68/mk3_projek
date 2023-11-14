<?php
require '../include/conn.php';
/**
 * @var object $conn
 */
$idpelajar = $_GET['idpelajar'];

$sql_check = "SELECT * FROM peralatan WHERE pelajar = $idpelajar";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    echo "Cannot delete student. Equipment records exist.";
} else {
    $sql_delete = "DELETE FROM pelajar WHERE idpelajar = $idpelajar";
    if ($conn->query($sql_delete)) {
        header('location: index.php?menu=Student');
        exit;
    } else {
        echo "Error deleting student: " . $conn->error;
    }
}


