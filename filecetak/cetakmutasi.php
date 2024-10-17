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
    <title>Cetak Laporan Mutasi Barang</title>
</head>

<body>
    <header style="text-align:center;">
        DATA MUTASI BARANG
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
            Bulan :
            <?= $bulan; ?>
            <?= isset($item['tanggal_masuk']) ? date('F', strtotime($item['tanggal_masuk'])) : ''; ?>

        </div>
    </header>
    <hr>
    <section>
        <div class="table-responsive">
            <table class="table table-bordered data-table" border="1" width="100%" cellspacing="0">
                <thead>
                        <tr>
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
                            <td>
                                <?= $jumlah; ?>
                            </td>
                            <td>
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