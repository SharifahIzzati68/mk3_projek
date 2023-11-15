<?php
/**
 * @var object $conn
 */
require '../include/conn.php';
// Validate and sanitize user input
$jenisperalatan =  $_POST['jenisperalatan'];
$nosiri =  $_POST['nosiri'];
$jenama =  $_POST['jenama'];

// Check if the nosiri already exists
$check_sql = "SELECT COUNT(*) AS count FROM peralatan WHERE nosiri = '$nosiri'";
$check_result = $conn->query($check_sql);
$row = $check_result->fetch_assoc();

if ($row['count'] > 0) {
    // Redirect back to the nosiri registration page with an error message
    header('location: index.php?menu=peralatanPelajar&error=exists');
    exit;
}

// Check if input is valid
if (empty($jenisperalatan) || empty($nosiri) || empty($jenama))
{
    echo '<p class="error">Input tidak dapat disahkan.Mohon isi semua ruang yang disediakan dengan betul.</p>';
    exit;
}

// Set the 'pelajar' value to the appropriate user ID (you need to determine this)
$pelajar = $_SESSION['idpelajar']; // Update this based on your session structure

// Interpolate variables directly into the SQL query (not recommended for security)
$sql = "INSERT INTO peralatan (pelajar, jenisperalatan, nosiri, jenama) VALUES ('$pelajar', '$jenisperalatan', '$nosiri', '$jenama')";

$result = $conn->query($sql);

if ($result)
{
    header('Location: index.php?menu=peralatanPelajar');
}

else
{
    echo "Error: " . $conn->error;
}

$conn->close();

