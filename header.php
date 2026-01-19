<?php

// buat session start 
session_start();

// uji jika session telah di set atau tidak
if (
    !isset($_SESSION['username']) ||
    !isset($_SESSION['nama_pengguna'])
) {
    echo "<script>
        alert('Maaf, untuk mengakses halaman ini, Anda harus login terlebih dahulu!');
        document.location='index.php';
    </script>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Informasi Buku Tamu</title>

    <!-- fonts -->
    <link href="assets/svendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- styles -->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


</head>

<body class="bg-gradient-success">
    <!-- container -->
    <div class="container">
        <?php include "koneksi.php"; ?>