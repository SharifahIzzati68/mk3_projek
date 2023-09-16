<?php
global $conn;
session_start();
require 'include/conn.php';
# baca data dari form yang user isi
$idpengguna = $_POST['idpengguna'];
$katalaluan = $_POST['katalaluan'];
# jika user adalah pentadbir sistem
if ($idpengguna == 'admin') {
    $sql = 'SELECT * FROM admin';
    $row = $conn->query($sql)->fetch_object();
    if (password_verify($katalaluan, $row->kata)) {
        $_SESSION['idpengguna'] = 'admin';
        header('location: admin/index.php');
        exit;
    } else {
        ?>
        <script>
            alert('1.Maaf, kata laluan salah.');
            window.location = './';
        </script>
        <?php
    }
} else {
    # jika bukan admin, cari dalam table staff
    $sql = "SELECT idwarden, kata FROM warden WHERE nokpwarden = '$idpengguna'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_object();
        if (password_verify($katalaluan, $row->kata)) {
            $_SESSION['idwarden'] = $row->idwarden;
            header('location: warden/index.php');
            exit;
        } else {
            ?>
            <script>
                alert('2.Maaf, kata laluan salah.');
                window.location = './';
            </script>
            <?php
        }
    } else {
        # jika bukan staff, cari dalam table pelajar
        $sql = "SELECT idpelajar, kata FROM pelajar WHERE nokppelajar = '$idpengguna'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_object();
            if (password_verify($katalaluan, $row->kata)) {
                $_SESSION['idpelajar'] = $row->idpelajar;
                header('location: pelajar/indexpelajar.php');
                exit;
            } else {
                ?>
                <script>
                    alert('3.Maaf, kata laluan salah.');
                    window.location = './';
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert('4.Maaf, ID pengguna/kata laluan salah.');
                window.location = './';
            </script>
            <?php
        }
    }
}