<?php
/** @var object $conn */
$conn;
require 'include/conn.php';
# baca data dari form yang user isi
$idpengguna = $_POST['idpengguna'];
$katalaluan = $_POST['katalaluan'];
# jika user adalah pentadbir sistem
if ($idpengguna == 'admin') {
    $sql = 'SELECT * FROM admin';
    $row = $conn->query($sql)->fetch_object();
    if (password_verify($katalaluan, $row->kata)) {
        $_SESSION['idadmin'] = $row->idadmin;
        header('location: admin/index.php');
        exit;
    } else {
        ?>
        <script>
            alert('Maaf, kata laluan salah.');
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
                alert('Maaf, kata laluan salah.');
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
                header('location: pelajar/index.php');
                exit;
            } else {
                ?>
                <script>
                    alert('Maaf, kata laluan salah.');
                    window.location = './';
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert('Maaf, ID pengguna/kata laluan salah.');
                window.location = './';
            </script>
            <?php
        }
    }
}