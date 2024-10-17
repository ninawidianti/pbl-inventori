<?php
require 'ceklogin.php';
include 'navbar.php';

//Hitung jumlah Peminjam
$h1 = mysqli_query($c, "select * from user");
$h2 = mysqli_num_rows($h1) //jumlah Peminjam
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
                <div class="container-fluid px-4 mb-5">
                    <h3 class="mt-4 text-center font-weight-bold">Data Peminjam</h3>

                    <!-- Trigger the modal with a button -->
                    <!-- <button type="button" class="btn btn-primary mb-4" data-toggle="modal"
                        data-target="#myModal">Tambah Peminjam</button> -->

                        <div class="card shadow mt-5">
                        <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data User
                        </div>
                        <div class="row">
                            <div class="px-2 text-black ">
                                <div class="card-body">Jumlah Peminjam:
                                    <?= $h2; ?>
                                </div>
                            </div>
                        </div>

                        <div class="py-0 card-body">
                            <div class="m-0 table-responsive">
                                <table class="table table-bordered data-table" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Email</th>
                                            <th>No Hp</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $get = mysqli_query($c, "select * from user");
                                        $i = 1; //penomoran
                                        
                                        while ($p = mysqli_fetch_array($get)) {
                                            $id_user = $p['id_user'];
                                            $nama = $p['nama'];
                                            $jenis_kelamin = $p['jenis_kelamin'];
                                            $email = $p['email'];
                                            $no_hp = $p['no_hp'];
                                            $password = $p['password'];
                                            $level = $p['level'];

                                            ?>

                                            <tr>
                                                <td>
                                                    <?= $i++; ?>
                                                </td>
                                                <td>
                                                    <?= $nama; ?>
                                                </td>
                                                <td>
                                                    <?= $jenis_kelamin; ?>
                                                </td>
                                                <td>
                                                    <?= $email; ?>
                                                </td>
                                                <td>
                                                    <?= $no_hp; ?>
                                                </td>
                                                <td>
                                                    <!-- Ikon untuk Edit -->
                                                    <a class="text-warning" style="cursor: pointer;" data-toggle="modal" data-target="#edit<?= $id_user; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <!-- Ikon untuk Delete -->
                                                    <a class="text-danger" style="cursor: pointer;" data-toggle="modal" data-target="#delete<?= $id_user; ?>">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>

                                                </td>
                                            </tr>


                                            <!-- modal edit -->
                                            <div class="modal fade" id="edit<?= $id_user; ?>"
                                                role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Ubah
                                                                <?= $nama; ?>
                                                            </h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <form class="form-control" method="post">
                                                            <div class="modal-body">
                                                            <div class="nama mt-0"> 
                                                                <label>Nama:</label>                                         
                                                                <input type="text" name="nama"
                                                                    class="form-control"
                                                                    placeholder="Nama Peminjam"
                                                                    value="<?= $nama; ?>" required>
                                                                </div>
                                                                <div class="form-group mt-2">
                                                                    <label>Jenis Kelamin:</label><br>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input"
                                                                            type="radio" name="jenis_kelamin"
                                                                            id="laki" value="Laki-laki" required
                                                                            <?php if (['jenis_kelamin'] == 'Laki-laki')
                                                                                echo 'checked'; ?>>
                                                                        <label class="form-check-label"
                                                                            for="laki">Laki-laki</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input"
                                                                            type="radio" name="jenis_kelamin"
                                                                            id="perempuan" value="Perempuan"
                                                                            required<?php if (['jenis_kelamin'] == 'Perempuan')
                                                                                echo 'checked'; ?>>
                                                                        <label class="form-check-label"
                                                                            for="perempuan">Perempuan</label>
                                                                    </div>
                                                                </div>
                                                                <div class="email mt-2">
                                                                <label>Email:</label>
                                                                        <input type="email" name="email"
                                                                        class="form-control"
                                                                        value="<?= $email; ?>"
                                                                    required>
                                                                </div>
                                                                <div class="nohp mt-2">
                                                                <label>No Hp:</label>
                                                                <input type="text" name="no_hp"
                                                                    class="form-control"
                                                                        value="<?= $no_hp; ?>"
                                                                    required>
                                                                </div>
                                                                <input type="hidden" name="id_user"
                                                                    value="<?= $id_user; ?>">
                                                                <input type="hidden" name="password"
                                                                    value="<?= $password; ?>">
                                                                <input type="hidden" name="level"
                                                                    value="<?= $level; ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success"
                                                                    name="edituser">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- modal delete -->
                                            <div class="modal fade" id="delete<?= $id_user; ?>"
                                                role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Hapus
                                                                <?= $nama; ?>
                                                            </h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah Anda ingin menghapus peminjam ini?
                                                                <input type="hidden" name="id_user"
                                                                    value="<?= $id_user; ?>">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-success"
                                                                    name="hapususer">Ya</button>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-dismiss="modal">Close</button>
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
                <h4 class="modal-title">Tambah Data Peminjam</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Peminjam" required>
                    <br>
                    <div class="form-group">
                        <label>Jenis Kelamin:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki"
                                value="Laki-laki" required>
                            <label class="form-check-label" for="laki">Laki-laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan"
                                value="Perempuan" required>
                            <label class="form-check-label" for="perempuan">Perempuan</label>
                        </div>
                    </div>
                    <input type="email" name="email" class="form-control mt-2" placeholder="Email" required>
                    <br>
                    <input type="text" name="no_hp" class="form-control mt-2" placeholder="No Hp" required>
                    <br>
                    <!-- <select class="form-control mt-2" id="jaminan" name="jaminan" placeholder="Jaminan" required>
                        <option value="" disabled selected>Jaminan</option>
                        <option value="KTM">KTM</option>
                        <option value="KTP">KTP</option>
                    </select> -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success" name="tambahuser">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>