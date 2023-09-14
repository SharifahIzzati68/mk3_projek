<?php
global $conn;
require '../include/conn.php';
$nosiri = $_GET['nosiri'];
$sql = "SELECT peralatan.nosiri, pelajar.namapelajar AS nama_pelajar, pelajar.warden, warden.nama AS nama_warden
        FROM peralatan
        INNER JOIN pelajar ON peralatan.pelajar = pelajar.idpelajar
        INNER JOIN pelajar AS warden ON pelajar.warden = warden.idwarden
        WHERE peralatan.nombor_siri = '$nosiri'";
$conn->query($sql);
header('location: index.php');
