<?php
session_start();
include "koneksi.php";

if (isset($_POST['username'], $_POST['password'])) {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5($_POST['password']); // sementara pakai md5

    $login = mysqli_query($koneksi, "
        SELECT * FROM tuser 
        WHERE username = '$username'
        AND password = '$password'
        AND status = 'Aktif'
    ");

    if (!$login) {
        die("Query error: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_array($login);

    if ($data) {
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama_pengguna'] = $data['nama_pengguna'];

        header("Location: admin.php");
        exit;
    } else {
        echo "<script>
            alert('MMaaf, Login Gagal, Pastikan Username dan Password anda Benar!');
            window.location='index.php';
        </script>";
    }
}
?>