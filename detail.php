<?php
require 'ceklogin.php';
include 'koneksi/koneksi.php';
include 'navbar.php';

//untuk barang masuk
// dapetin ID barang yang di passing di halaman sebelumnya
$id_barang = $_GET['id'];
$id_mutasi = $_GET['idm'];
// get informasi barang berdasarkan database
$get = mysqli_query($c, "select * from barang where id_barang='$id_barang'");
$fetch = mysqli_fetch_assoc($get);
//set variable
$nama_barang = $fetch['nama_barang'];
$merk = $fetch['merk'];
$kode_barang = $fetch['kode_barang'];
$satuan = $fetch['satuan'];
$kategori = $fetch['kategori'];

//untuk mutasi barang
$get1 = mysqli_query($c, "SELECT * FROM mutasi m JOIN barang b ON m.id_barang = b.id_barang WHERE m.id_mutasi='$id_mutasi'");
$fetch1 = mysqli_fetch_assoc($get1);
$jumlah = $fetch1['jumlah'];
$satuan = $fetch1['satuan'];

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
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Load jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/atlantis.min.css">

    <style>
        a {
            text-decoration: none;
            color: white;
        }
    </style>

</head>

<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <!-- <h1 class="h5 mb-0 text-gray-800">INVENTORI</h1> -->
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#cetak"><i
            class="fas fa-download fa-sm text-white-50"></i>Cetak</a> -->
        </div>

        <!-- DataTales Example -->
        <?php
        if ($_SESSION['level'] == 'admin') {
            ?>
            <div class="card shadow mt-0">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Detail Barang
                </div>
                <?php
        } else {
            ?>
                <div class="card shadow mt-5">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Detail Barang
                    </div>
                    <?php
        } ?>
                <div class="card-header py-3">
                    <h3 class="font-weight-bold text-primary">
                        <?= $nama_barang; ?>
                        <?= $merk; ?>
                    </h3>
                    <p class="mb-0">Kode Barang :
                        <?= $kode_barang; ?>
                    </p>
                    <p class="mb-0">Satuan :
                        <?= $satuan; ?>
                    </p>
                    <p class="mb-0">Kategori :
                        <?= $kategori; ?>
                    </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <p class="text-center font-weight-bold">Barang Masuk</p>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <?php
                            $get = mysqli_query($c, "SELECT * FROM barang_masuk m JOIN barang b ON m.id_barang = b.id_barang WHERE m.id_barang='$id_barang'");
                            $i = 1;

                            while ($p = mysqli_fetch_array($get)) {
                                $kode_barang = $p['kode_barang'];
                                $nama_barang = $p['nama_barang'];
                                $merk = $p['merk'];
                                $satuan = $p['satuan'];
                                $jumlah = $p['jumlah'];
                                $tanggal_masuk = $p['tanggal_masuk'];
                                ?>
                                <tr>
                                    <td>
                                        <?= $i++; ?>
                                    </td>
                                    <td>
                                        <?= $tanggal_masuk; ?>
                                    </td>
                                    <td>
                                        <?= $jumlah; ?>
                                    </td>
                                    <td>
                                        <?= $satuan; ?>
                                    </td>
                                </tr>
                                <?php

                            }
                            ; //end of while
                            ?>


                            </tbody>
                        </table>
                    </div>


                    <div class="table-responsive mt-5">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                <p class="text-center font-weight-bold">Barang Mutasi</p>
                                    <th>No</th>
                                    <th>Tanggal Mutasi</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Ruang</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $get = mysqli_query($c, "SELECT b.kode_barang, b.nama_barang, b.merk, m.id_mutasi, m.jumlah, b.satuan, b.kategori, m.status_mutasi, m.ruang, DATE_FORMAT(m.tanggal_mutasi, '%d-%m-%Y') AS tanggal_mutasi
                                          FROM barang b
                                          INNER JOIN mutasi m ON b.id_barang = m.id_barang");

                                $i = 1;

                                while ($p = mysqli_fetch_array($get)) {
                                    $id_mutasi = $p['id_mutasi'];
                                    $jumlah = $p['jumlah'];
                                    $satuan = $p['satuan'];
                                    $ruang = $p['ruang'];
                                    $tanggal_mutasi = $p['tanggal_mutasi'];


                                    ?>

                                    <tr>
                                        <td>
                                            <?= $i++; ?>
                                        </td>
                                        <td>
                                            <?= $tanggal_mutasi; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $jumlah; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $satuan; ?>
                                        </td>
                                        <td>
                                            <?= $ruang; ?>
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

        </div>
        <!-- /.container-fluid -->
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

    <!-- <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    <span>Logout</span></a>
            </li> -->

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

</body>

</html>