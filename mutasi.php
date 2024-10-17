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
    <style>
    .button-container {
        display: flex;
        justify-content: space-between;
    }
</style>

</head>

<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800"></h1>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h3 class="mt-4 text-center font-weight-bold">Mutasi Barang</h3>

                    <!-- Tombol dengan simbol tambah menggunakan Font Awesome -->
                    
                    <div class="col">
                    <?php
                            if ($_SESSION['level'] == 'admin') {
                                ?>
                    <button type="button" class="btn btn-primary mt-5 mb-4 px-4" data-toggle="modal"
                        data-target="#myModal"><i class="fas fa-plus"></i> Barang</button>
                        <?php
                            } ?>
                        <button href="#" class="btn btn-outline-primary mt-5 mb-4 px-4 " data-toggle="modal"
                         data-target="#cetak" style="margin-left 400px; margin-top 200px;"><i
                            class="fas fa-print fa-sm text-blue-50"></i> Cetak</button>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Mutasi Barang
                        </div>

                            <!-- Modal -->
                            <div class="modal fade" id="cetak" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                    CETAK</span>
                                                <!-- <span class="fw-light">
                                                        Data
                                                    </span> -->
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action='./filecetak/cetakmutasi.php' method="post">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label>Bulan</label>
                                                        <div class="form-group form-group-default">
                                                            <input id="addName" type="month" name="bulan"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer no-bd">
                                                    <button type="submit" name="cetak"
                                                        class="btn btn-primary">Cetak</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-header py-0">
                                <h6 class="m-0 font-weight-bold text-primary"></h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered data-table"  width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Merk</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                                <th>Kategori</th>
                                                <th>Status</th>
                                                <th>Ruang</th>
                                                <th>Tanggal</th>
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
                                                    <td class="text-center">
                                                        <?= $jumlah; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $satuan; ?>
                                                    </td>
                                                    <td>
                                                        <?= $kategori; ?>
                                                    </td>
                                                    <td>
                                                        <?= $status_mutasi; ?>
                                                    </td>
                                                    <td>
                                                        <?= $ruang; ?>
                                                    </td>
                                                    <td>
                                                        <?= $tanggal_mutasi; ?>
                                                    </td>
                                                    <td>
                                                        <!-- Ikon untuk Edit -->
                                                        <i class="fas fa-edit text-warning" style="cursor: pointer;"
                                                            data-toggle="modal" data-target="#edit<?= $id_mutasi; ?>"></i>

                                                        <!-- Ikon untuk Delete -->
                                                        <i class="fas fa-trash-alt text-danger" style="cursor: pointer;"
                                                            data-toggle="modal" data-target="#delete<?= $id_mutasi; ?>"></i>

                                                    </td>
                                                </tr>

                                                <!-- modal edit -->
                                                <div class="modal fade" id="edit<?= $id_mutasi; ?>" role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit
                                                                </h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <form class="form-control" method="post">
                                                                <div class="modal-body">
                                                                    <div class="jumlah mt-2">
                                                                        <label for="jumlah">Jumlah</label>
                                                                        <input type="number" name="jumlah"
                                                                            class="form-control mt-0"
                                                                            value="<?= $jumlah; ?>" required>
                                                                    </div>
                                                                    <div class="ruang mt-2">
                                                                        <label for="ruang">Ruang</label>
                                                                        <input type="text" name="ruang"
                                                                            class="form-control mt-0" value="<?= $ruang; ?>"
                                                                            required>
                                                                    </div>
                                                                    <div class="tanggal_mutasi mt-2">
                                                                        <label for="tanggal_mutasi">Tanggal Mutasi</label>
                                                                        <input type="date" name="tanggal_mutasi"
                                                                            class="form-control mt-0"
                                                                            value="<?= $tanggal_mutasi; ?>">
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="id_mutasi"
                                                                            value="<?= $id_mutasi; ?>">
                                                                        <input type="hidden" name="id_barang"
                                                                            value="<?= $id_barang; ?>">
                                                                        <br>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-success"
                                                                                name="editmutasi">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- modal delete -->
                                                <div class="modal fade" id="delete<?= $id_mutasi; ?>" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Hapus
                                                                    <?= $nama_barang; ?>
                                                                </h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <form method="post">
                                                                <div class="modal-body">
                                                                    Apakah Anda ingin menghapus barang ini?
                                                                    <input type="hidden" name="id_mutasi"
                                                                        value="<?= $id_mutasi; ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success"
                                                                        name="hapusmutasi">Ya</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
            </main>
        </div>
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
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="piliBarang">
                        <label for="pilihBarang">Pilih Barang</label>
                        <select name="id_barang" class="form-control">

                            <?php
                            $getbarang = mysqli_query($c, "SELECT b.*
                            FROM barang b
                            LEFT JOIN mutasi m ON b.id_barang = m.id_barang AND m.id_mutasi = '$id_mutasi'
                            WHERE m.id_mutasi IS NULL"
                            );

                            while ($pl = mysqli_fetch_array($getbarang)) {
                                $id_mutasi = $pl['id_mutasi'];
                                $id_barang = $pl['id_barang'];
                                $kode_barang = $pl['kode_barang'];
                                $nama_barang = $pl['nama_barang'];
                                $merk = $pl['merk'];
                                $satuan = $pl['satuan'];
                                $kategori = $pl['kategori'];
                                $stock = $pl['stock'];

                                ?>
                                <option value="<?= $id_barang; ?>">
                                    <?= $nama_barang; ?> -
                                    <?= $merk; ?> (Stock:
                                    <?= $stock; ?>)
                                </option>

                                <?php
                            }
                            ?>

                        </select>
                    </div>

                    <div class="jumlah mt-3">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control mt-0" placeholder="1" min="1" required>
                    </div>

                    <div class="ruang mt-3">
                        <label for="ruang">Ruang</label>
                        <input type="text" name="ruang" class="form-control mt-0" required>
                    </div>

                    <div class="tanggal_mutasi mt-3">
                        <label for="tanggal_mutasi">Tanggal Mutasi</label>
                        <input type="date" name="tanggal_mutasi" class="form-control mt-0" required>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="tambahmutasi">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>

</html>