<?php
require 'ceklogin.php';
include 'navbar.php';

//Hitung jumlah barang
$h1 = mysqli_query($c, "select * from barang");
$h2 = mysqli_num_rows($h1) //jumlah produk
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
            <h1 class="h5 mb-0 text-gray-800"></h1>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h3 class="mt-4 text-center font-weight-bold">Barang Masuk</h3>

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


                    <div class="card shadow mb-4">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Barang Masuk
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
                                            <form action='./filecetak/cetakbrgmasuk.php' method="post">
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
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Merk</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $get = mysqli_query($c, "SELECT *, DATE_FORMAT(m.tanggal_masuk, '%d-%m-%Y') AS tanggal_masuk_format FROM barang_masuk m, barang b WHERE m.id_barang = b.id_barang");
                                            $i = 1;

                                            while ($p = mysqli_fetch_array($get)) {
                                                $id_masuk = $p['id_masuk'];
                                                $nama_barang = $p['nama_barang'];
                                                $jumlah = $p['jumlah'];
                                                $satuan = $p['satuan'];
                                                $tanggal_masuk = $p['tanggal_masuk'];
                                                $id_barang = $p['id_barang'];
                                                $merk = $p['merk'];

                                                ?>

                                                <tr>
                                                    <td class="text-center">
                                                        <?= $i++; ?>
                                                    </td>
                                                    <td>
                                                        <?= $nama_barang; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?= $jumlah; ?>
                                                    </td>
                                                    <td>
                                                        <?= $merk; ?>
                                                    </td>
                                                    <td>
                                                        <?= $tanggal_masuk; ?>
                                                    </td>
                                                    <td>
                                                        <!-- Ikon untuk Edit -->
                                                        <a class="text text-warning" href="#edit<?= $id_masuk; ?>"
                                                            data-toggle="modal">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <!-- Ikon untuk Delete -->
                                                        <a class="text text-danger" href="#delete<?= $id_masuk; ?>"
                                                            data-toggle="modal">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>

                                                    </td>
                                                </tr>


                                                <!-- modal edit -->
                                                <div class="modal fade" id="edit<?= $id_masuk; ?>" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Ubah data barang masuk</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <form method="post">
                                                                <div class="modal-body">
                                                                    <!--<div class="nama_barang mt-1">
                                                                    <label for="nama_barang">Nama Barang</label>
                                                                    <input type="text" name="nama_barang"
                                                                        class="form-control" placeholder="Nama Barang"
                                                                        value="<?= $nama_barang; ?>" required>
                                                                </div> -->
                                                                    <div class="jumlah mt-1">
                                                                        <label for="jumlah">Jumlah</label>
                                                                        <input type="number" name="jumlah"
                                                                            class="form-control mt-2"
                                                                            placeholder="Jumlah Barang"
                                                                            value="<?= $jumlah; ?>">
                                                                    </div>
                                                                    <input type="hidden" name="id_barang"
                                                                        value="<?= $id_barang; ?>">
                                                                    <input type="hidden" name="id_masuk"
                                                                        value="<?= $id_masuk; ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success"
                                                                        name="editbrgmasuk">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- modal delete -->
                                                <div class="modal fade" id="delete<?= $id_masuk; ?>" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Hapus data barang masuk</h4>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <form method="post">
                                                                <div class="modal-body">
                                                                    Apakah Anda ingin menghapus barang ini?
                                                                    <input type="hidden" name="id_barang"
                                                                        value="<?= $id_barang; ?>">
                                                                    <input type="hidden" name="id_masuk"
                                                                        value="<?= $id_masuk; ?>">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success"
                                                                        name="hapusdatabarangmasuk">Ya</button>
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
                    Pilih Barang
                    <select name="id_barang" class="form-control">

                        <?php
                        $getbarang = mysqli_query($c, "select * from barang");

                        while ($pl = mysqli_fetch_array($getbarang)) {
                            $id_barang = $pl['id_barang'];
                            $nama_barang = $pl['nama_barang'];
                            $jumlah = $pl['jumlah'];
                            $satuan = $pl['satuan'];
                            $stock = $pl['stock'];
                            $merk = $pl['merk'];
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
                    <div class="jumlah mt-1">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" min="1" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" name="barangmasukya">Submit</button>
                    </div>
            </form>
        </div>
    </div>
</div>

</html>