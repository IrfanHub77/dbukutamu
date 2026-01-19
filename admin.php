<!-- panggil file header -->
<?php include "header.php"; ?>

<?php

// uji jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
    $tgl = date('Y-m-d');

    // htmlspecialchars agar inputan lebih dari injection
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $alamat = htmlspecialchars($_POST['alamat'], ENT_QUOTES);
    $tujuan = htmlspecialchars($_POST['tujuan'], ENT_QUOTES);
    $nope = htmlspecialchars($_POST['nope'], ENT_QUOTES);

    // persiapan query simpan data
    $simpan = mysqli_query($koneksi, "INSERT INTO ttamu VALUES ('','$tgl', '$nama', '$alamat', '$tujuan', '$nope')");

    // uji jika tombol simpan data sukses
    if ($simpan) {
        echo "<script>alert('Simpan Data Sukses, Terima Kasih..!');
              document.location='?'</script>";
    } else {
        echo "<script>alert('Simpan Data GAGAL!!!');
              document.location='?'</script>";
    }
}


?>



<!-- Head -->
<div class="head text-center">
    <img src="assets/img/logo1.png" alt="Logo" style="max-width:100px;">
    <h2 style="color: #ffffff;">Sistem Informasi Buku Tamu</h2>
</div>
<!-- end Head -->
<!-- Awal Rouw -->
<div class="row mt-2">
    <!-- Col-ig-7 -->
    <div class="col-lg-7 mb-3">
        <div class="card shadow bg-gradient-light">
            <!-- card body -->
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Identitas Pengunjung</h1>
                </div>
                <form class="user" method="post" action="">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="alamat" placeholder="Alamat"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="tujuan" placeholder="Tujuan"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="nope" placeholder="No. HP"
                            required>
                    </div>

                    <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">
                        Simpan Data
                    </button>
                </form>

                <hr>
                <div class="text-center">
                    <a class="small" href="#">Irfan D4 SIKC 1C | 2026 <?= date('') ?></a>
                </div>
            </div>
        </div>
        <!-- end card-body -->
    </div>
    <!-- end col-ig-7 -->

    <!-- col-ig-5 -->
    <div class="col-lg-5 mb-3">
        <!-- card-->
        <div class="card shadow">
            <!-- card body -->
            <div class="card-body">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Statistik Pengunjung</h1>
                </div>
                <?php
                // deklarasi tanggal
                
                // menampilkan tanggal sekarang
                $tgl_sekarang = date('Y-m-d');

                // menampilkan tgl kemarin
                $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))))
                ;

                // mendapatkan 6 hari sebelum tgl skrg
                $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime
                ($tgl_sekarang)));

                $sekarang = date('Y-m-d h:i:s');

                // persiapan query tampilKan jumlah data pengunjung
                
                $tgl_sekarang = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where tanggal like '%$tgl_sekarang%' "
                ));

                $kemarin = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where tanggal like '%$kemarin%' "
                ));

                $seminggu = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where tanggal BETWEEN '$seminggu' and
                                     '$sekarang' "
                ));

                $bulan_ini = date('m');

                $sebulan = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu where month(tanggal) = '$bulan_ini'"
                ));

                $keseluruhan = mysqli_fetch_array(mysqli_query(
                    $koneksi,
                    "SELECT count(*) FROM ttamu"
                ));


                ?>
                <table class="table table-bordered">
                    <tr>
                        <td>Hari Ini</td>
                        <td>: <?= $tgl_sekarang[0] ?></td>
                    <tr>
                    <tr>
                        <td>Kemarin</td>
                        <td>: <?= $kemarin[0] ?></td>
                    <tr>
                    <tr>
                        <td>Minggu ini</td>
                        <td>: <?= $seminggu[0] ?></td>
                    <tr>
                    <tr>
                        <td>Bulan Ini</td>
                        <td>: <?= $sebulan[0] ?></td>
                    <tr>
                    <tr>
                        <td>Keseluruhan</td>
                        <td>: <?= $keseluruhan[0] ?></td>
                    <tr>
                </table>
            </div>
            <!-- card body -->
        </div>
        <!-- end card body -->
    </div>
    <!-- end col-ig-5 -->

</div>
<!-- end Row -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari ini [<?= date('d-m-Y') ?>]</h6>
    </div>
    <div class="card-body">
        <a href="rekapitulasi.php" class="btn btn-success btn-sm mb-3">
            <i class="fas fa-table"></i> Rekapitulasi Pengunjung
        </a>

        <a href="logout.php" class="btn btn-danger btn-sm mb-3">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <style>
                    .dataTables_filter {
                        float: right;
                        text-align: right;
                    }
                </style>


                <style>
                    /* Samakan baris Show entries & Search */
                    .dataTables_wrapper .row:first-child {
                        align-items: center;
                    }

                    /* Show entries di kiri atas */
                    .dataTables_length {
                        display: flex;
                        align-items: center;
                        gap: 6px;
                        margin-top: 15px;
                    }

                    /* Search di kanan atas (biar konsisten) */
                    .dataTables_filter {
                        margin-top: 15px;
                    }

                    /* Kecilkan select */
                    .dataTables_length select {
                        width: 55px;
                        height: 28px;
                        padding: 2px 4px;
                        font-size: 12px;
                        border-radius: 6px;
                    }

                    /* Samakan TOTAL: input search & select show entries */
                    .dataTables_wrapper .dataTables_filter input,
                    .dataTables_wrapper .dataTables_length select {
                        height: 28px;
                        padding: 2px 6px;
                        font-size: 12px;
                        /* INI KUNCI UKURAN TEKS */
                        line-height: 1.2;
                        /* BIAR TEKS TENGAH */
                        border-radius: 6px;
                    }
                </style>

                <style>
                    /* Kembalikan search ke default sebaris */
                    .dataTables_wrapper .dataTables_filter {
                        display: block;
                        margin-top: 8px;
                    }

                    /* Label & input sebaris */
                    .dataTables_wrapper .dataTables_filter label {
                        display: inline-flex;
                        align-items: center;
                        gap: 6px;
                        font-size: 12px;
                    }

                    /* Ukuran input */
                    .dataTables_wrapper .dataTables_filter input {
                        height: 28px;
                        padding: 2px 6px;
                        font-size: 12px;
                        border-radius: 6px;
                    }
                </style>

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Nama Pengunjung</th>
                        <th>Alamat</th>
                        <th>Tujuan</th>
                        <th>No. HP</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Nama Pengunjung</th>
                        <th>Alamat</th>
                        <th>Tujuan</th>
                        <th>No. HP</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $tgl = date('Y-m-d');  // 2026-01-14
                    $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu where 
                                             tanggal like '%$tgl%' order by id desc");
                    $no = 1;

                    while ($data = mysqli_fetch_array($tampil)) {
                        ?>
                        <tr>
                            <td>1<?= $no++ ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= $data['tujuan'] ?></td>
                            <td><?= $data['nope'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- panggil file footer -->
<?php include "footer.php"; ?>