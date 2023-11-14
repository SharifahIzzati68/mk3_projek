<?php
require '../include/conn.php';
/**
 * @var object $conn
 */
$idwarden = $_GET['idwarden'];
$sqlCheckStudents = "SELECT COUNT(*) as studentCount FROM pelajar WHERE warden = $idwarden";
$resultCheckStudents = $conn->query($sqlCheckStudents);
$rowCheckStudents = $resultCheckStudents->fetch_object();
if ($rowCheckStudents->studentCount > 0) {
    // There are students associated with the warden, show an error message
    echo "<script>
            alert('Maaf, ada pelajar yang berdaftar di bawah warden ini');
            window.location.href = 'index.php?menu=warden';
          </script>";
    exit();
}

$sql = "DELETE FROM warden WHERE idwarden = $idwarden";
$conn->query($sql);
header('location: index.php?menu=warden');