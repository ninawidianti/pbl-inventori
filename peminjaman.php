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
            <h2 class="h5 mb-0 text-gray-800"></h2>

        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h3 class="mt-4 text-center font-weight-bold">Peminjaman Barang</h3>
                    <?php
                    if ($_SESSION['level'] == 'user') {
                        ?>
                        <!-- Tombol dengan simbol tambah menggunakan Font Awesome -->
                        <button type="button" class="btn btn-primary mt-5 mb-4" data-toggle="modal"
                            data-target="#myModal"><i class="fas fa-plus"></i> Barang</button>
                        <?php
                    } ?>

                    <?php
                    if ($_SESSION['level'] == 'admin' || 'pimpinan') {
                        ?>
                        <div class="col">
                            <a href="#" class="btn btn-outline-primary mt-5 mb-4 px-4" data-toggle="modal"
                                data-target="#cetak"><i class="fas fa-print fa-sm text-blue-50"></i> Cetak</a>
                        </div>
                        <?php
                    } ?>

                    <?php
                    if ($_SESSION['level'] == 'admin') {
                        ?>
                        <div class="card shadow mt-2">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Peminjaman Barang
                            </div>
                            <?php
                    } else {
                        ?>
                            <div class="card shadow mt-0">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    Data Peminjaman Barang
                                </div>
                                <?php
                    } ?>

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
                                            <form action='./filecetak/cetakpeminjaman.php' method="post">
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
                                    <table class="table table-bordered data-table" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal Peminjaman</th>
                                                <th>Tanggal Pengembalian</th>
                                                <th>Jaminan</th>
                                                <th>Status</th>
                                                <?php
                                                if ($_SESSION['level'] == 'admin') {
                                                    ?>
                                                    <th>Aksi</th>
                                                    <?php
                                                } ?>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $get = mysqli_query($c, "SELECT pb.id_peminjaman, u.nama AS nama_user, b.kode_barang, b.nama_barang, pb.jumlah, DATE_FORMAT(pb.tanggal_peminjaman, '%d-%m-%Y') AS tanggal_peminjaman, DATE_FORMAT(pb.tanggal_pengembalian, '%d-%m-%Y') AS tanggal_pengembalian, pb.jaminan, pb.status
                                                        FROM peminjaman_barang pb
                                                        INNER JOIN user u ON pb.id_user = u.id_user
                                                        INNER JOIN barang b ON pb.id_barang = b.id_barang");

                                            $i = 1;

                                            while ($p = mysqli_fetch_array($get)) {
                                                // $id_barang = $p['id_barang'];
                                                $id_peminjaman = $p['id_peminjaman'];
                                                $nama_user = $p['nama_user'];
                                                $kode_barang = $p['kode_barang'];
                                                $nama_barang = $p['nama_barang'];
                                                $jumlah = $p['jumlah'];
                                                $tanggal_peminjaman = $p['tanggal_peminjaman'];
                                                $tanggal_pengembalian = $p['tanggal_pengembalian'];
                                                $jaminan = $p['jaminan'];
                                                $status = $p['status'];


                                                ?>

                                                <tr>
                                                    <td>
                                                        <?= $i++; ?>
                                                    </td>
                                                    <td>
                                                        <?= $nama_user; ?>
                                                    </td>
                                                    <td>
                                                        <?= $kode_barang; ?>
                                                    </td>
                                                    <td>
                                                        <?= $nama_barang; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $jumlah; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $tanggal_peminjaman; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $tanggal_pengembalian; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $jaminan; ?>
                                                    </td>
                                                    <td>
                                                        <?= $status; ?>
                                                    </td>
                                                    <?php
                                                    if ($_SESSION['level'] == 'admin') {
                                                        ?>
                                                        <td>
                                                            <?php
                                                            //cek status
                                                            if ($status == 'Dipinjam') {
                                                                echo '<button type="button" class="btn btn-success"
                                                                        data-toggle="modal"
                                                                        data-target="#edit' . $id_peminjaman . '">Dikembalikan</button>';
                                                            } else {
                                                                //jika statusnya bukan di pinjam
                                                                echo 'Selesai';
                                                            }
                                                            ?>
                                                        </td>
                                                        <?php
                                                    } ?>
                                                </tr>

                                                <!-- modal edit -->
                                                <div class="modal fade" id="edit<?= $id_peminjaman; ?>" role="dialog">
                                                    <div class="modal-dialog">
                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Selesaikan
                                                                </h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <form method="post">
                                                                <div class="modal-body">
                                                                    Apakah Barang ini sudah selesai dipinjam?
                                                                    <input type="hidden" name="id_peminjaman"
                                                                        value="<?= $id_peminjaman; ?>">
                                                                    <input type="hidden" name="id_barang"
                                                                        value="<?= $id_barang; ?>">
                                                                    <br>
                                                                    <input type="submit" class="btn btn-primary mt-3"
                                                                        name="barangkembali" value="Submit">
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
                            $getbarang = mysqli_query($c, "SELECT * 
                            FROM barang 
                            WHERE id_barang NOT IN (SELECT id_barang 
                                                    FROM barang 
                                                    WHERE status_data = 'Tidak Tersedia')");

                            while ($pl = mysqli_fetch_array($getbarang)) {
                                $id_peminjaman = $pl['id_peminjaman'];
                                $id_barang = $pl['id_barang'];
                                $id_user = $pl['id_user'];
                                $kode_barang = $pl['kode_barang'];
                                $nama_barang = $pl['nama_barang'];
                                $merk = $pl['merk'];
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

                    <div class="tanggal_peminjaman mt-3">
                        <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                        <input type="date" name="tanggal_peminjaman" class="form-control mt-0"
                            placeholder="Tanggal Peminjaman" min="1" required>
                    </div>

                    <div class="tanggal_pengembalian mt-3">
                        <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                        <input type="date" name="tanggal_pengembalian" class="form-control mt-0"
                            placeholder="Tanggal Pengembalian" min="1" required>
                    </div>

                    <div class="jaminan mt-3">
                        <label for="jaminan">Pilih Jaminan</label>
                        <select class="form-control mt-0" id="jaminan" name="jaminan" placeholder="Jaminan" required>
                            <option value="" selected disabled></option>
                            <option value="KTM">KTM</option>
                            <option value="KTP">KTP</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="tambahpinjambarang">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>

</html>