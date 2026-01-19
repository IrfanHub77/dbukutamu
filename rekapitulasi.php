<?php include 'header.php'; ?>
<!-- Awal Row -->
<div class="row">
    <!-- Awal col-md-12 -->
    <div class="col-md-12">
        <!-- Awal card -->
        <div class="card shadow mb-4 mt-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Pengunjung</h6>
            </div>
            <form method="POST" action="">
                <div class="row justify-content-center text-center mt-4">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Dari Tanggal</label>
                            <input class="form-control" type="date" name="tanggal1"
                                value="<?= isset($_POST['tanggal1']) ? $_POST['tanggal1'] : date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sampai Tanggal</label>
                            <input class="form-control" type="date" name="tanggal2"
                                value="<?= isset($_POST['tanggal2']) ? $_POST['tanggal2'] : date('Y-m-d') ?>" required>
                        </div>
                    </div>

                </div>

                <!-- ROW TOMBOL -->
                <div class="card-body px-5 py-4">
                    <div class="row justify-content-center mt-3">

                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block" name="btampilkan">
                                <i class="fa fa-search"></i> Tampilkan
                            </button>
                        </div>

                        <div class="col-md-2">
                            <a href="admin.php" class="btn btn-danger btn-block">
                                <i class="fa fa-backward"></i> Kembali
                            </a>
                        </div>

                    </div>
            </form>


            <?php
            if (isset($_POST['btampilkan'])):

                ?>
                <div class="container-fluid px-4">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered">
                            <style>
                                .dataTables_filter {
                                    float: right;
                                    text-align: right;
                                }
                            </style>

                            <head>

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

                                    $tgl1 = $_POST['tanggal1'];
                                    $tgl2 = $_POST['tanggal2'];

                                    $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu where 
                                             tanggal between '$tgl1' and '$tgl2' order by id desc");
                                    $no = 1;

                                    while ($data = mysqli_fetch_array($tampil)) {
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data['tanggal'] ?></td>
                                            <td><?= $data['nama'] ?></td>
                                            <td><?= $data['alamat'] ?></td>
                                            <td><?= $data['tujuan'] ?></td>
                                            <td><?= $data['nope'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                        </table>

                        <center>
                            <form method="POST" action="exportexcel.php">
                                <div class="col-md-4">
                                    <input type="hidden" name="tanggala" value="<?= @$_POST
                                    ['tanggal1'] ?>">

                                    <input type="hidden" name="tanggalb" value="<?= @$_POST
                                    ['tanggal2'] ?>">

                                    <button class="btn btn-success form-control" name="bexport"><i
                                            class="fa fa-download"></i>
                                        Export
                                        Data Excel</button>
                                </div>
                            </form>
                        </center>

                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Akhir card-->
    </div>
    <!-- Akhir col-md-12 -->
</div>
<!-- Akhir Row -->


<?php include 'footer.php'; ?>