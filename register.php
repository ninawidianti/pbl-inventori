<?php
require 'function.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <h1 class="h4 text-gray-900 mb-0 text-center mt-5 font-weight-bold">Website Inventori</h1>
                        <h1 class="h4 text-gray-900 mb-3 text-center mt-1 font-weight-bold">Jurusan Teknologi Informasi</h1>
                        <div class="row">
                            <div class="col-lg-5 d-none d-lg-block ">
                            <img src="img/ilus1.png" style="width: 350px; height: 300px; margin-left: 40px; margin-top: 120px">
                            </div>
                            <div class="col-lg-7">
                                <div class="p-5" style="margin-right: 10px;">
                                    <div class="text-center">
                                        <h4 class="h4 text-gray-900 mb-4">Register</h4>
                                    </div>
                                    <form action="proses_register.php?proses=insert" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="text" name="nama" class="form-control form-control-user" id="nama"
                                                placeholder="Nama" required>
                                        </div>
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
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control form-control-user"
                                                placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password"
                                                class="form-control form-control-user" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="no_hp" name="no_hp" id="no_hp" class="form-control form-control-user"
                                                placeholder="No Hp" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="level" id="level" class="form-control form-control-user"
                                                placeholder="Level" required>
                                        </div>
                                        <button type="submit" name="proses" class="btn btn-primary btn-user btn-block">Register</button>
                                </div>
                                <!-- <a href="index.php" type="submit" name="proses" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </a> -->
                                </form>
                                <div class="text-center mb-5">
                                    <a class="small" href="login.php">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
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

</body>

</html>