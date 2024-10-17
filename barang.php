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

        
</head>

<body id="page-top">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h5 mb-0 text-gray-800"></h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"
            data-target="#cetak"><i
            class="fas fa-download fa-sm text-white-50"></i>Cetak</a> -->
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h3 class="mt-4 text-center font-weight-bold">Stock Barang </h3>
                    
                    <?php
                            if ($_SESSION['level'] == 'admin') {
                                ?>
                                <!-- Tombol dengan simbol tambah menggunakan Font Awesome -->
                                <div class="col">
                                <button type="button" class="btn btn-primary mt-5 mb-4 px-4" data-toggle="modal" data-target="#myModal">
                                    <i class="fas fa-plus"></i> Barang
                                </button>
                                </div>
                    <?php
                            } ?>
                       
                    <?php
                            if ($_SESSION['level'] == 'admin') {
                                ?>
                                <div class="card shadow mt-0">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Data Stock Barang
                                    </div>
                                <?php
                            } else{
                                ?>
                                <div class="card shadow mt-4">
                                    <div class="card-header">
                                        <i class="fas fa-table me-1"></i>
                                        Data Stock Barang
                                    </div>
                        <?php
                            }?> 
                        <div class="row">
                            <div class="px-3 text-black ">
                                <div class="card-body">Jumlah Barang:
                                    <?= $h2; ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-header py-0">
                            <h6 class="m-0 font-weight-bold text-primary"></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered data-table"  width="100%"
                                    cellspacing="0">
                                    <!-- <table id="datatablesSimple"> -->
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Merk</th>
                                            <th>Stock</th>
                                            <th>Satuan</th>
                                            <th>Kategori</th>
                                            <th>Status Data</th>
                                            <th>Keterangan</th>
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
                                        $get = mysqli_query($c, "select * from barang");
                                        $i = 1;

                                        while ($p = mysqli_fetch_array($get)) {
                                            $id_barang = $p['id_barang'];
                                            $kode_barang = $p['kode_barang'];
                                            $nama_barang = $p['nama_barang'];
                                            $merk = $p['merk'];
                                            $stock = $p['stock'];
                                            $satuan = $p['satuan'];
                                            $kategori = $p['kategori'];
                                            $status_data = $p['status_data'];
                                            $keterangan = $p['keterangan'];


                                            ?>

                                            <tr>
                                                <td class="text-center">
                                                    <?= $i++; ?>
                                                </td>
                                                <td>
                                                    <?= $kode_barang; ?>
                                                </td>
                                                <td>
                                                <?= $nama_barang;?>
                                                <!-- <strong><a href="detail.php?id=<?=$id_barang?>"><?= $nama_barang;?></a></ strong></td> -->
                                                </td>
                                                <td>
                                                    <?= $merk; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $stock; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $satuan; ?>
                                                </td>
                                                <td>
                                                    <?= $kategori; ?>
                                                </td>
                                                <td>
                                                    <?= $status_data; ?>
                                                </td>
                                                <td>
                                                <?php
                                            //cek status
                                            if ($status_data == 'Tersedia') {
                                                echo 'Barang Dapat dipinjam';
                                            } else {
                                                //jika status_datanya Tidak Tersedia
                                                echo 'Tidak Dapat dipinjam';
                                            }
                                            ?>
                                                </td>
                                                <?php
                                            if ($_SESSION['level'] == 'admin') {
                                                ?>
                                                <td>
                                                    <!-- Ikon untuk Edit -->
                                                    <i class="fas fa-edit text-warning" style="cursor: pointer;" data-toggle="modal" data-target="#edit<?= $id_barang; ?>"></i>

                                                    <!-- Ikon untuk Delete -->
                                                    <i class="fas fa-trash-alt text-danger" style="cursor: pointer;" data-toggle="modal" data-target="#delete<?= $id_barang; ?>"></i>
                                                </td>  
                                                <?php
                                            } ?>
                                            </tr>

                                            <!-- modal edit -->
                                            <div class="modal fade" id="edit<?= $id_barang; ?>" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit <?= $nama_barang; ?></h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <form class="form-control" method="post">
                                                            <div class="modal-body">
                                                            <div class="kode_barang mt-0">
                                                                <label for="kode_barang">Kode Barang</label>
                                                                <input type="text" name="kode_barang"
                                                                    id="kode_barang" class="form-control"
                                                                    value="<?= $kode_barang; ?>" required>
                                                            </div>
                                                            <div class="nama_barang mt-1">
                                                                <label for="nama_barang">Nama Barang</label>
                                                                <input type="text" name="nama_barang"
                                                                    class="form-control mt-0"
                                                                    value="<?= $nama_barang; ?>" required>
                                                            </div>
                                                            <div class="Merk mt-1">
                                                                <label for="Merk">Merk</label>
                                                                <input type="text" name="merk"
                                                                    class="form-control mt-0" 
                                                                    value="<?= $merk; ?>" required>
                                                            </div>
                                                            <div class="stock mt-1">
                                                                <label for="stock">Stock</label>
                                                                <input type="text" name="stock"
                                                                    class="form-control mt-0"
                                                                        value="<?= $stock; ?>"
                                                                    required>
                                                            </div>
                                                            <div class="satuan mt-1">
                                                                <label for="satuan">Pilih Satuan</label>
                                                                <select class="form-control mt-0" id="satuan" name="satuan" required>
                                                                    <option value="" disabled></option>
                                                                    <option value="Unit" <?php if ($satuan === 'Unit') echo 'selected'; ?>>Unit</option>
                                                                    <option value="Pcs" <?php if ($satuan === 'Pcs') echo 'selected'; ?>>Pcs</option>
                                                                    <option value="Meter" <?php if ($satuan === 'Meter') echo 'selected'; ?>>Meter</option>
                                                                </select>
                                                            </div>
                                                            <div class="kategori mt-1">
                                                                <label for="kategori">Pilih kategori</label>
                                                                <select class="form-control mt-0" id="kategori" name="kategori" required>
                                                                    <option value="" disabled></option>
                                                                    <option value="Peralatan" <?php if ($kategori === 'Peralatan') echo 'selected'; ?>>Peralatan</option>
                                                                    <option value="Barang Habis Pakai" <?php if ($kategori === 'Barang Habis Pakai') echo 'selected'; ?>>Barang Habis Pakai</option>
                                                                </select>
                                                            </div>
                                                            <div class="status_data mt-1">
                                                                <label for="status_data">Pilih Status Data</label>
                                                                <select class="form-control mt-0" id="status_data" name="status_data" required>
                                                                    <option value="" disabled></option>
                                                                    <option value="Tersedia" <?php if ($status_data === 'Tersedia') echo 'selected'; ?>>Tersedia</option>
                                                                    <option value="Tidak Tersedia" <?php if ($status_data === 'Tidak Tersedia') echo 'selected'; ?>>Tidak Tersedia</option>
                                                                </select>
                                                            </div>
                                                                <!-- <div class="keterangan mt-2">
                                                                    <label for="keterangan">Kode Barang</label>
                                                                    <input type="text" name="keterangan"
                                                                    class="form-control mt-0"
                                                                    value="<?= $keterangan; ?>" required>
                                                                </div> -->
                                                                
                                                                <input type="hidden" name="id_barang"
                                                                    value="<?= $id_barang; ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success"
                                                                    name="editbarang">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- modal delete -->
                                            <div class="modal fade" id="delete<?= $id_barang; ?>" role="dialog">
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
                                                                <input type="hidden" name="id_barang"
                                                                    value="<?= $id_barang; ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success"
                                                                    name="hapusbarang">Ya</button>
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
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Baru</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <div class="kode_barang mt-1">
                        <label for="kode_barang">Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control" required>
                    </div>

                    <div class="nama_barang mt-1">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" required>
                    </div>

                    <div class="merk mt-1">
                        <label for="merk">Merk</label>
                        <input type="text" name="merk" class="form-control" required>
                    </div>

                    <div class="stock mt-1">
                        <label for="stock">Stock</label>
                        <input type="num" name="stock" class="form-control" required>
                    </div>
                    
                    <div class="satuan mt-1">
                        <label for="satuan">Pilih Satuan</label>
                        <select class="form-control mt-0" id="satuan" name="satuan" required>
                            <option value=""selected disabled></option>
                            <option value="Unit">Unit</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Meter">Meter</option>
                        </select>
                    </div>
                    
                    <div class="kategori mt-1">
                        <label for="kategori">Pilih Kategori</label>
                        <select class="form-control mt-0" id="kategori" name="kategori" required>
                            <option value=""selected disabled></option>
                            <option value="Peralatan">Peralatan</option>
                            <option value="Barang Habis Pakai">Barang Habis Pakai</option>
                        </select>
                    </div>

                    <div class="status_data mt-2">
                        <label for="status_data">Pilih Status Data</label>
                        <select class="form-control mt-0" id="status_data" name="status_data" required>
                            <option value=""selected disabled></option>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="tambahbarang">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>