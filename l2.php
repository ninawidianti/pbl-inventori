<?php
require 'ceklogin.php';
include 'navbar.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SistemIventori</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- Skrip jQuery untuk modal -->
    <script>
        $(document).ready(function () {
            $(".btn-kembali").click(function () {
                var idPeminjaman = $(this).data("id");
                $("#modalPengembalian-" + idPeminjaman).modal("show");
            });
        });
    </script>
    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


</head>

<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800">Gedung E</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
                data-target="#cetak"><i class="fas fa-download fa-sm text-white-50"></i>Cetak</a> -->
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h3 class="mt-4 text-center font-weight-bold">Mutasi Ruang </h3>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="l2.php">Lantai 2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="l3.php">Lantai 3</a>
                        </li>
                    </ul>
                </div>
            </main>
        </div>


        <?php
        $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
        FROM barang b
        INNER JOIN mutasi m ON b.id_barang = m.id_barang
        WHERE m.ruang = 'E201'");

        $data = mysqli_num_rows($get);

        if ($data >= 1) {
            ?>
            <!-- E201 -->
            <div class="card mb-4 mt-5">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">RUANG E201</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Merk</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
                                        FROM barang b
                                        INNER JOIN mutasi m ON b.id_barang = m.id_barang
                                        WHERE m.ruang = 'E201'");

                                $i = 1;

                                while ($p = mysqli_fetch_array($get)) {
                                    $id_mutasi = $p['id_mutasi'];
                                    // $id_barang = $p['id_barang'];
                                    $kode_barang = $p['kode_barang'];
                                    $nama_barang = $p['nama_barang'];
                                    $merk = $p['merk'];
                                    $jumlah = $p['jumlah'];
                                    $satuan = $p['satuan'];
                                    $kategori = $p['kategori'];
                                    $status_mutasi = $p['status_mutasi'];
                                    $ruang = $p['ruang'];
                                    $tanggal_mutasi = $p['tanggal_mutasi'];


                                    ?>

                                    <tr>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <td>
                                            <?= $kode_barang; ?>
                                        </td>
                                        <td>
                                            <?= $nama_barang; ?>
                                        </td>
                                        <td>
                                            <?= $merk; ?>
                                        </td>
                                        <td>
                                            <?= $jumlah; ?>
                                        </td>
                                        <td>
                                            <?= $satuan; ?>
                                        </td>
                                        <td>
                                            <?= $tanggal_mutasi; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ; //end of while
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
        FROM barang b
        INNER JOIN mutasi m ON b.id_barang = m.id_barang
        WHERE m.ruang = 'E202'");

        $data = mysqli_num_rows($get);

        if ($data >= 1) {
            ?>
            <!-- E202 -->
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">RUANG E202</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Merk</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
                                        FROM barang b
                                        INNER JOIN mutasi m ON b.id_barang = m.id_barang
                                        WHERE m.ruang = 'E202'");

                                $i = 1;

                                while ($p = mysqli_fetch_array($get)) {
                                    $id_mutasi = $p['id_mutasi'];
                                    // $id_barang = $p['id_barang'];
                                    $kode_barang = $p['kode_barang'];
                                    $nama_barang = $p['nama_barang'];
                                    $merk = $p['merk'];
                                    $jumlah = $p['jumlah'];
                                    $satuan = $p['satuan'];
                                    $kategori = $p['kategori'];
                                    $status_mutasi = $p['status_mutasi'];
                                    $ruang = $p['ruang'];
                                    $tanggal_mutasi = $p['tanggal_mutasi'];


                                    ?>

                                    <tr>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <td>
                                            <?= $kode_barang; ?>
                                        </td>
                                        <td>
                                            <?= $nama_barang; ?>
                                        </td>
                                        <td>
                                            <?= $merk; ?>
                                        </td>
                                        <td>
                                            <?= $jumlah; ?>
                                        </td>
                                        <td>
                                            <?= $satuan; ?>
                                        </td>
                                        <td>
                                            <?= $tanggal_mutasi; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ; //end of while
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
        FROM barang b
        INNER JOIN mutasi m ON b.id_barang = m.id_barang
        WHERE m.ruang = 'E203'");

        $data = mysqli_num_rows($get);

        if ($data >= 1) {
            ?>
            <!-- E203 -->
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">RUANG E203</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Merk</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
                                        FROM barang b
                                        INNER JOIN mutasi m ON b.id_barang = m.id_barang
                                        WHERE m.ruang = 'E203'");

                                $i = 1;

                                while ($p = mysqli_fetch_array($get)) {
                                    $id_mutasi = $p['id_mutasi'];
                                    // $id_barang = $p['id_barang'];
                                    $kode_barang = $p['kode_barang'];
                                    $nama_barang = $p['nama_barang'];
                                    $merk = $p['merk'];
                                    $jumlah = $p['jumlah'];
                                    $satuan = $p['satuan'];
                                    $kategori = $p['kategori'];
                                    $status_mutasi = $p['status_mutasi'];
                                    $ruang = $p['ruang'];
                                    $tanggal_mutasi = $p['tanggal_mutasi'];


                                    ?>

                                    <tr>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <td>
                                            <?= $kode_barang; ?>
                                        </td>
                                        <td>
                                            <?= $nama_barang; ?>
                                        </td>
                                        <td>
                                            <?= $merk; ?>
                                        </td>
                                        <td>
                                            <?= $jumlah; ?>
                                        </td>
                                        <td>
                                            <?= $satuan; ?>
                                        </td>
                                        <td>
                                            <?= $tanggal_mutasi; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ; //end of while
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>


        <?php
        $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
        FROM barang b
        INNER JOIN mutasi m ON b.id_barang = m.id_barang
        WHERE m.ruang = 'E204'");

        $data = mysqli_num_rows($get);

        if ($data >= 1) {
            ?>
            <!-- E204 -->
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">RUANG E204</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Merk</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
                                        FROM barang b
                                        INNER JOIN mutasi m ON b.id_barang = m.id_barang
                                        WHERE m.ruang = 'E204'");

                                $i = 1;

                                while ($p = mysqli_fetch_array($get)) {
                                    $id_mutasi = $p['id_mutasi'];
                                    // $id_barang = $p['id_barang'];
                                    $kode_barang = $p['kode_barang'];
                                    $nama_barang = $p['nama_barang'];
                                    $merk = $p['merk'];
                                    $jumlah = $p['jumlah'];
                                    $satuan = $p['satuan'];
                                    $kategori = $p['kategori'];
                                    $status_mutasi = $p['status_mutasi'];
                                    $ruang = $p['ruang'];
                                    $tanggal_mutasi = $p['tanggal_mutasi'];


                                    ?>

                                    <tr>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <td>
                                            <?= $kode_barang; ?>
                                        </td>
                                        <td>
                                            <?= $nama_barang; ?>
                                        </td>
                                        <td>
                                            <?= $merk; ?>
                                        </td>
                                        <td>
                                            <?= $jumlah; ?>
                                        </td>
                                        <td>
                                            <?= $satuan; ?>
                                        </td>
                                        <td>
                                            <?= $tanggal_mutasi; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ; //end of while
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
        FROM barang b
        INNER JOIN mutasi m ON b.id_barang = m.id_barang
        WHERE m.ruang = 'E205'");

        $data = mysqli_num_rows($get);

        if ($data >= 1) {
            ?>
            <!-- E205 -->
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">RUANG E205</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Merk</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
                                        FROM barang b
                                        INNER JOIN mutasi m ON b.id_barang = m.id_barang
                                        WHERE m.ruang = 'E205'");

                                $i = 1;

                                while ($p = mysqli_fetch_array($get)) {
                                    $id_mutasi = $p['id_mutasi'];
                                    // $id_barang = $p['id_barang'];
                                    $kode_barang = $p['kode_barang'];
                                    $nama_barang = $p['nama_barang'];
                                    $merk = $p['merk'];
                                    $jumlah = $p['jumlah'];
                                    $satuan = $p['satuan'];
                                    $kategori = $p['kategori'];
                                    $status_mutasi = $p['status_mutasi'];
                                    $ruang = $p['ruang'];
                                    $tanggal_mutasi = $p['tanggal_mutasi'];


                                    ?>

                                    <tr>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <td>
                                            <?= $kode_barang; ?>
                                        </td>
                                        <td>
                                            <?= $nama_barang; ?>
                                        </td>
                                        <td>
                                            <?= $merk; ?>
                                        </td>
                                        <td>
                                            <?= $jumlah; ?>
                                        </td>
                                        <td>
                                            <?= $satuan; ?>
                                        </td>
                                        <td>
                                            <?= $tanggal_mutasi; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ; //end of while
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
        FROM barang b
        INNER JOIN mutasi m ON b.id_barang = m.id_barang
        WHERE m.ruang = 'E206'");

        $data = mysqli_num_rows($get);

        if ($data >= 1) {
            ?>
            <!-- E206 -->
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">RUANG E206</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table"  id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Merk</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
                                        FROM barang b
                                        INNER JOIN mutasi m ON b.id_barang = m.id_barang
                                        WHERE m.ruang = 'E206'");

                                $i = 1;

                                while ($p = mysqli_fetch_array($get)) {
                                    $id_mutasi = $p['id_mutasi'];
                                    // $id_barang = $p['id_barang'];
                                    $kode_barang = $p['kode_barang'];
                                    $nama_barang = $p['nama_barang'];
                                    $merk = $p['merk'];
                                    $jumlah = $p['jumlah'];
                                    $satuan = $p['satuan'];
                                    $kategori = $p['kategori'];
                                    $status_mutasi = $p['status_mutasi'];
                                    $ruang = $p['ruang'];
                                    $tanggal_mutasi = $p['tanggal_mutasi'];


                                    ?>

                                    <tr>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <td>
                                            <?= $kode_barang; ?>
                                        </td>
                                        <td>
                                            <?= $nama_barang; ?>
                                        </td>
                                        <td>
                                            <?= $merk; ?>
                                        </td>
                                        <td>
                                            <?= $jumlah; ?>
                                        </td>
                                        <td>
                                            <?= $satuan; ?>
                                        </td>
                                        <td>
                                            <?= $tanggal_mutasi; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ; //end of while
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
        FROM barang b
        INNER JOIN mutasi m ON b.id_barang = m.id_barang
        WHERE m.ruang = 'E207'");

        $data = mysqli_num_rows($get);

        if ($data >= 1) {
            ?>
            <!-- E207 -->
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">RUANG E207</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Merk</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
                                        FROM barang b
                                        INNER JOIN mutasi m ON b.id_barang = m.id_barang
                                        WHERE m.ruang = 'E207'");

                                $i = 1;

                                while ($p = mysqli_fetch_array($get)) {
                                    $id_mutasi = $p['id_mutasi'];
                                    // $id_barang = $p['id_barang'];
                                    $kode_barang = $p['kode_barang'];
                                    $nama_barang = $p['nama_barang'];
                                    $merk = $p['merk'];
                                    $jumlah = $p['jumlah'];
                                    $satuan = $p['satuan'];
                                    $kategori = $p['kategori'];
                                    $status_mutasi = $p['status_mutasi'];
                                    $ruang = $p['ruang'];
                                    $tanggal_mutasi = $p['tanggal_mutasi'];


                                    ?>

                                    <tr>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <td>
                                            <?= $kode_barang; ?>
                                        </td>
                                        <td>
                                            <?= $nama_barang; ?>
                                        </td>
                                        <td>
                                            <?= $merk; ?>
                                        </td>
                                        <td>
                                            <?= $jumlah; ?>
                                        </td>
                                        <td>
                                            <?= $satuan; ?>
                                        </td>
                                        <td>
                                            <?= $tanggal_mutasi; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ; //end of while
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

        <?php
        $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
        FROM barang b
        INNER JOIN mutasi m ON b.id_barang = m.id_barang
        WHERE m.ruang = 'E208'");

        $data = mysqli_num_rows($get);

        if ($data >= 1) {
            ?>
            <!-- E208 -->
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">RUANG E208</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Merk</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
                                        FROM barang b
                                        INNER JOIN mutasi m ON b.id_barang = m.id_barang
                                        WHERE m.ruang = 'E208'");

                                $i = 1;

                                while ($p = mysqli_fetch_array($get)) {
                                    $id_mutasi = $p['id_mutasi'];
                                    // $id_barang = $p['id_barang'];
                                    $kode_barang = $p['kode_barang'];
                                    $nama_barang = $p['nama_barang'];
                                    $merk = $p['merk'];
                                    $jumlah = $p['jumlah'];
                                    $satuan = $p['satuan'];
                                    $kategori = $p['kategori'];
                                    $status_mutasi = $p['status_mutasi'];
                                    $ruang = $p['ruang'];
                                    $tanggal_mutasi = $p['tanggal_mutasi'];


                                    ?>

                                    <tr>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <td>
                                            <?= $kode_barang; ?>
                                        </td>
                                        <td>
                                            <?= $nama_barang; ?>
                                        </td>
                                        <td>
                                            <?= $merk; ?>
                                        </td>
                                        <td>
                                            <?= $jumlah; ?>
                                        </td>
                                        <td>
                                            <?= $satuan; ?>
                                        </td>
                                        <td>
                                            <?= $tanggal_mutasi; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ; //end of while
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>© Website Kelompok 2 2024</span>
            </div>
        </div>
    </footer>


    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="nav-link btn btn-primary" href="logout.php">
                        <!-- <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> -->
                        <span>Logout</span></a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- jQuery UI -->
    <script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


    <!-- Chart JS -->
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

</body>

</html>