<?php
/**
 * @var object $conn
 */
require '../include/conn.php';

$idpelajar = $_GET['idpelajar'];

// Check if the student has any associated equipment
$sql_check = "SELECT * FROM peralatan WHERE pelajar = $idpelajar";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    echo "<script>
    // If there are associated equipment records, prevent deletion
            alert('Harap maaf,data pelajar ini tidak boleh dipadamkan kerana rekod peralatan pelajar ini telahpun direkodkan!');
            window.location.href = 'index.php?menu=Student';
          </script>";
} else {
    // No associated equipment, proceed with deletion
    $sql_delete = "DELETE FROM pelajar WHERE idpelajar = $idpelajar";
    if ($conn->query($sql_delete)) {
        // Deletion successful, redirect back to student list page
        header('location: index.php?menu=Student');
        exit;
    } else {
        // Error handling: Display an error message or log the error
        echo "Error deleting student: " . $conn->error;
    }
}
?>
