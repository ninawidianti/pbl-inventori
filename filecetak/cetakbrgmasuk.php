<?php
//Bikin Koneksi
$c = mysqli_connect('localhost', 'root', '', 'inventori2');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/atlantis.min.css">
    <title>Cetak Laporan Barang Masuk</title>
</head>

<body>
    <header style="text-align:center;">
        DATA BARANG MASUK
        <?php
        include '../koneksi/koneksi.php';

        $bulan = $_POST['bulan'];

        $query = "SELECT * FROM barang_masuk 
    INNER JOIN barang ON barang_masuk.id_barang = barang.id_barang 
    WHERE DATE_FORMAT(barang_masuk.tanggal_masuk,'%Y-%m') = '$bulan'";
        $result = $c->query($query);

        $item = mysqli_fetch_assoc($result);
        ?>
        <div class="">
            Bulan : <?= $bulan; ?>
            <?= isset($item['tanggal_masuk']) ? date('F', strtotime($item['tanggal_masuk'])) : ''; ?>

        </div>
    </header>
    <hr>
    <section>
        <div class="table-responsive">
            <table class="table table-bordered data-table" width="100%" cellspacing="0">
                <thead>
                    <table class="" border="1" style="width:100%;">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Merk</th>
                            <th>Tanggal Masuk</th>
                        </tr>
                    </table>
                </thead>
                <tbody>

                    <?php
                    $bulan = $_POST['bulan'];

                    $query = "SELECT * FROM barang_masuk 
                                    INNER JOIN barang ON barang_masuk.id_barang = barang.id_barang 
                                    WHERE DATE_FORMAT(barang_masuk.tanggal_masuk,'%Y-%m') = '$bulan'";
                    $result = $c->query($query);
                    $i = 1;

                    while ($p = mysqli_fetch_array($result)) {
                        $id_masuk = $p['id_masuk'];
                        $nama_barang = $p['nama_barang'];
                        $jumlah = $p['jumlah'];
                        $satuan = $p['satuan'];
                        $tanggal_masuk = $p['tanggal_masuk'];
                        $id_barang = $p['id_barang'];
                        $merk = $p['merk'];

                        ?>

                        <tr>
                            <td>
                                <?= $i++; ?>
                            </td>
                            <td>
                                <?= $nama_barang; ?>
                            </td>
                            <td>
                                <?= $jumlah; ?>
                            </td>
                            <td>
                                <?= $merk; ?>
                            </td>
                            <td>
                                <?= $tanggal_masuk; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ; //end of while
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <script>
        window.print()

    </script>
</body>

</html>