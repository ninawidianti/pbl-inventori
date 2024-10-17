<?php

session_start();

//Bikin Koneksi
$c = mysqli_connect('localhost', 'root', '', 'inventori2');

//Login
if (isset($_POST['login'])) {
	//Initiate variable
	$email = $_POST['email'];
	$password = $_POST['password'];

	$check = mysqli_query($c, "SELECT * FROM user WHERE email='$email' and password='$password'");
	$hitung = mysqli_num_rows($check);
	$result = mysqli_fetch_array($check);

	if ($hitung > 0) {
		//Jika datanya ditemukan
		//berhasil login

		$_SESSION['login'] = 'True';
		$_SESSION['nama'] = $result['nama'];
		$_SESSION['id_user'] = $result['id_user'];
		$_SESSION['level'] = $result['level'];
		header('location:barang.php');
	} else {
		//Data tidak ditemukan
		//gagal login
		echo '
    <script>alert("email atau Password salah");
    window.location.href="login.php"
    </script>
    ';

	}
}

//STOCK BARANG
//tambah data barang di barang.php
if (isset($_POST['tambahbarang'])) {
	$kode_barang = $_POST['kode_barang'];
	$nama_barang = $_POST['nama_barang'];
	$merk = $_POST['merk'];
	$stock = $_POST['stock'];
	$satuan = $_POST['satuan'];
	$kategori = $_POST['kategori'];
	$status_data = $_POST['status_data'];
	$keterangan = $_POST['keterangan'];

	$insert = mysqli_query($c, "insert into barang ( kode_barang, nama_barang, merk, stock, satuan, kategori, status_data, keterangan) 
	values ('$kode_barang','$nama_barang','$merk','$stock','$satuan','$kategori','$status_data','$keterangan')");

	if ($insert) {
		header('location:barang.php');
	} else {
		echo '
        <script>alert("Gagal menambah barang baru");
        window.location.href="barang.php"
        </script>
		';
	}
}

//edit barang
if (isset($_POST['editbarang'])) {
	if (
		isset($_POST['id_barang'])
	)
		$id_barang = $_POST['id_barang'];
	$kode_barang = $_POST['kode_barang'];
	$nama_barang = $_POST['nama_barang'];
	$merk = $_POST['merk'];
	$stock = $_POST['stock'];
	$satuan = $_POST['satuan'];
	$kategori = $_POST['kategori'];
	$status_data = $_POST['status_data'];
	$keterangan = $_POST['keterangan'];

	$query = mysqli_query($c, "UPDATE barang set kode_barang='$kode_barang', nama_barang='$nama_barang', merk='$merk', stock='$stock', satuan='$satuan', kategori='$kategori', status_data='$status_data', keterangan='$keterangan' WHERE id_barang='$id_barang' ");

	if ($query) {
		header('location:barang.php');
	} else {
		echo '
        <script>alert("Gagal");
        window.location.href="barang.php"
        </script>
		';
	}
}

//hapus barang
if (isset($_POST['hapusbarang'])) {
	$id_barang = $_POST['id_barang'];

	$query = mysqli_query($c, "delete from barang where id_barang='$id_barang'");

	if ($query) {
		header('location:barang.php');
	} else {
		echo '
        <script>alert("Gagal");
        window.location.href="barang.php"
        </script>
		';
	}
}

//BARANG MASUK
//Menambah barang masuk
if (isset($_POST['barangmasukya'])) {
	$id_barang = $_POST['id_barang'];
	$jumlah = $_POST['jumlah'];
	// $tanggal_masuk = $_POST['tanggal_masuk'];

	//cari tau stock sekarang berapa
	$caristock = mysqli_query($c, "select * from barang where id_barang='$id_barang'");
	$caristock2 = mysqli_fetch_array($caristock);
	$stocksekarang = $caristock2['stock'];

	
	// echo 'tanggal masuk :' .$tanggal_masuk;
	// echo '<br>';
	// echo 'stock :' .$stocksekarang;
	// exit;
	//hitung
	$newstock = $stocksekarang + $jumlah;

	$insertb = mysqli_query($c, "insert into barang_masuk (id_barang,jumlah,tanggal_masuk) values ('$id_barang','$jumlah','$tanggal_masuk')");
	$updatetb = mysqli_query($c, "update barang set stock='$newstock' where id_barang='$id_barang'");

	if ($insertb) {
		header('location:masuk.php');
	} else {
		echo '
        <script>alert("Gagal");
        window.location.href="masuk.php"
        </script>
		';
	}
}

//edit data barang masuk
if (isset($_POST['editbrgmasuk'])) {
	$jumlah = $_POST['jumlah'];
	$id_masuk = $_POST['id_masuk'];
	$id_barang = $_POST['id_barang'];

	//cari tau jumlah nya sekarang berapa
	$caritahu = mysqli_query($c, "select * from barang_masuk where id_masuk='$id_masuk'");
	$caritahu2 = mysqli_fetch_array($caritahu);
	$jumlahsekarang = $caritahu2['jumlah'];

	//cari tau stock sekarang berapa
	$caristock = mysqli_query($c, "select * from barang where id_barang='$id_barang'");
	$caristock2 = mysqli_fetch_array($caristock);
	$stocksekarang = $caristock2['stock'];

	if ($jumlah >= $jumlahsekarang) {
		//kalau inputan user lebih besar daripada jumlah yg tercatat
		//hitung selisih
		$selisih = $jumlah - $jumlahsekarang;
		$newstock = $stocksekarang + $selisih;

		$query1 = mysqli_query($c, "update barang_masuk set jumlah='$jumlah' where id_masuk='$id_masuk'");
		$query2 = mysqli_query($c, "update barang set stock='$newstock' where id_barang='$id_barang'");

		if ($query1 && $query2) {
			header('location:masuk.php');
		} else {
			echo '
            <script>alert("Gagal");
            window.location.href="masuk.php"
            </script>
		    ';
		}
	} else {
		//kalau lebih kecil
		//hitung selisih
		$selisih = $jumlahsekarang - $jumlah;
		$newstock = $stocksekarang - $selisih;

		$query1 = mysqli_query($c, "update masuk set jumlah='$jumlah' where id_masuk='$id_masuk' ");
		$query2 = mysqli_query($c, "update barang set stock='$newstock' where id_barang='$id_barang' ");

		if ($query1 && $query2) {
			header('location:masuk.php');
		} else {
			echo '
            <script>alert("Gagal");
            window.location.href="masuk.php"
            </script>
		    ';
		}
	}
}


//hapus data barang masuk
if (isset($_POST['hapusdatabarangmasuk'])) {
	if (
		isset($_POST['id_masuk']) && isset($_POST['id_barang'])
	)
		$id_masuk = $_POST['id_masuk'];
	$id_barang = $_POST['id_barang'];

	// echo "id_masuk : ".$id_masuk;
	// echo '<br>';
	// echo "id_barang : ".$id_barang;
	// echo '<br>';

	//cari tau jumlah nya sekarang berapa
	$caritahu = mysqli_query($c, "select * from barang_masuk where id_masuk='$id_masuk'");
	$caritahu2 = mysqli_fetch_array($caritahu);
	$jumlahsekarang = $caritahu2['jumlah'];

	// echo "jumlah : ".$jumlahsekarang;
	// echo '<br>';

	//cari tau stock sekarang berapa
	$caristock = mysqli_query($c, "select * from barang where id_barang='$id_barang'");
	$caristock2 = mysqli_fetch_array($caristock);
	$stocksekarang = $caristock2['stock'];

	// echo "stok sekarang : ".$stocksekarang;
	// exit;

	//hitung selisih
	$newstock = $stocksekarang - $jumlahsekarang;

	$query1 = mysqli_query($c, "delete from barang_masuk where id_masuk='$id_masuk'");
	$query2 = mysqli_query($c, "update barang set stock='$newstock' where id_barang='$id_barang'");

	if ($query1 && $query2) {
		header('location:masuk.php');
	} else {
		echo '
        <script>alert("Gagal");
        window.location.href="masuk.php"
        </script>
		';
	}
}


//USER
//menambah user di user.php
if (isset($_POST['tambahuser'])) {
	$nama = $_POST['nama'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$no_hp = $_POST['no_hp'];
	$level = $_POST['level'];

	$insert = mysqli_query($c, "INSERT into user (nama,jenis_kelamin,email,password,no_hp,level) values ('$nama','$jenis_kelamin','$email','$password','$no_hp','$level')");

	if ($insert) {
		header('location:user.php');
	} else {
		echo '
        <script>alert("Gagal menambah peminjam baru");
        window.location.href="user.php"
        </script>
		';
	}
}

//mengedit user di user.php
if (isset($_POST['edituser'])) {
	$id_user = $_POST['id_user'];
	$nama = $_POST['nama'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$no_hp = $_POST['no_hp'];
	$level = $_POST['level'];

	$query = mysqli_query($c, "update user set nama='$nama', jenis_kelamin='$jenis_kelamin', email='$email', password='$password', no_hp='$no_hp', level='$level' where id_user='$id_user'");

	if ($query) {
		echo '<script>alert("User berhasil diedit."); window.location.href="user.php?id_user=' . $id_user . '"</script>';
		exit();
	} else {
		echo '
        <script>alert("Gagal");
        window.location.href="user.php"
        </script>
		';
	}

}

//menghapus user di user.php
if (isset($_POST['hapususer'])) {
	$id_user = $_POST['id_user'];

	$query = mysqli_query($c, "delete from user where id_user='$id_user'");

	if ($query) {
		header('location:user.php');
	} else {
		echo '
        <script>alert("Gagal");
        window.location.href="user.php"
        </script>
		';
	}
}


//PEMINJAMAN BARANG
if (isset($_POST['tambahpinjambarang'])) {
	// Pastikan semua input yang diperlukan ada
	if (
		isset($_POST['id_barang'])
	) {
		$id_barang = $_POST['id_barang'];
		$id_user = $_SESSION['id_user'];
		$nama = $_SESSION['nama'];
		$jumlah = $_POST['jumlah'];
		$tanggal_peminjaman = $_POST['tanggal_peminjaman'];
		$tanggal_pengembalian = $_POST['tanggal_pengembalian'];
		$status = 'Dipinjam';
		$jaminan = $_POST['jaminan'];

		$check_active_loan = mysqli_query($c, "SELECT id_peminjaman FROM peminjaman_barang WHERE id_user = '$_SESSION[id_user]' AND status = 'Dipinjam'");
		if (mysqli_num_rows($check_active_loan) > 0) {
			// User sedang memiliki peminjaman aktif
			echo '<script>alert("Anda masih memiliki barang yang belum dikembalikan"); window.location.href="peminjaman.php"</script>';
			exit(); // Hentikan eksekusi jika masih ada peminjaman aktif
		}

		// hitung stock sekarang ada berapa
		$hitung1 = mysqli_query($c, "SELECT stock FROM barang WHERE id_barang = '$id_barang'");
		$hitung2 = mysqli_fetch_assoc($hitung1);
		$stocksekarang = $hitung2['stock']; //stock barang saat ini

		// echo "stok : ".$stocksekarang;
		// echo '<br>';
		// echo "jumlah ". $jumlah;


		if ($stocksekarang >= $jumlah) {
			// Kurangi stocknya dengan jumlah yang akan dikeluarkan
			$selisih = $stocksekarang - $jumlah;

			// Simpan status peminjaman sebelum diubah
			$old_status = $status;

			// Jika status adalah 'Dipinjam', ubah status menjadi 'Dikembalikan' saat tombol pengembalian ditekan
			if ($old_status == 'Dipinjam' && isset($_POST['pengembalian'])) {
				$status = 'Dikembalikan';
			}

			// Stocknya cukup, lakukan operasi INSERT dan UPDATE
			$insert = mysqli_query($c, "INSERT INTO peminjaman_barang (id_user, id_barang, jumlah, tanggal_peminjaman, tanggal_pengembalian, jaminan, status) VALUES ('$_SESSION[id_user]', '$id_barang', '$jumlah', '$tanggal_peminjaman', '$tanggal_pengembalian', '$jaminan', '$status')");
			$update = mysqli_query($c, "UPDATE barang SET stock='$selisih' WHERE id_barang='$id_barang'");

			if ($insert && $update) {
				if ($old_status == 'Dipinjam' && $status == 'Dikembalikan') {
					$update_stock = mysqli_query($c, "UPDATE barang SET stock=stock+'$jumlah' WHERE id_barang='$id_barang'");
					if ($update_stock) {
						echo '<script>alert("Barang berhasil dikembalikan dan stok diperbarui."); window.location.href="peminjaman.php?id_peminjaman=' . $id_peminjaman . '"</script>';
						exit();
					} else {
						echo '<script>alert("Gagal memperbarui stok barang setelah pengembalian."); window.location.href="peminjaman.php?id_peminjaman=' . $id_peminjaman . '"</script>';
						exit();
					}
				} else {
					// Jika tidak ada pengembalian barang, kembali ke halaman peminjaman
					header('Location: peminjaman.php?id_peminjaman=' . $id_peminjaman);
					exit();
				}
			} else {
				echo '<script>alert("Gagal menambah pesanan baru"); window.location.href="peminjaman.php?id_peminjaman=' . $id_peminjaman . '"</script>';
			}
		} else {
			echo '<script>alert("Stok barang tidak mencukupi untuk jumlah yang diminta"); window.location.href="peminjaman.php?id_peminjaman=' . $id_peminjaman . '"</script>';
		}
	} else {
		echo '<script>alert("Ada input yang kurang"); window.location.href="peminjaman.php"</script>';
	}
}


if (isset($_POST['barangkembali'])) {
	// Pastikan semua input yang diperlukan ada
	if (
		isset($_POST['id_peminjaman'])
	) {

		$id_peminjaman = $_POST['id_peminjaman'];

		$query_peminjaman = mysqli_query($c, "SELECT * FROM peminjaman_barang WHERE id_peminjaman='$id_peminjaman'");

		$result_peminjaman = mysqli_fetch_array($query_peminjaman);

		$jumlah = $result_peminjaman['jumlah'];
		$id_barang = $result_peminjaman['id_barang'];
		$status = $result_peminjaman['status'];

		// hitung stock sekarang ada berapa
		$hitung1 = mysqli_query($c, "SELECT stock FROM barang WHERE id_barang = '$id_barang'");
		$hitung2 = mysqli_fetch_assoc($hitung1);
		$stocksekarang = $hitung2['stock']; //stock barang saat ini

		// Tambahkan stocknya dengan jumlah yang akan dikembalikan
		$stok_baru = $stocksekarang + $jumlah;

		// Jika status adalah 'Dipinjam', ubah status menjadi 'Dikembalikan' saat tombol pengembalian ditekan
		if ($status == 'Dipinjam') {
			// Update stok dan update status
			$update_stok = mysqli_query($c, "UPDATE barang SET stock='$stok_baru' WHERE id_barang='$id_barang'");

			$update_status = mysqli_query($c, "UPDATE peminjaman_barang SET status='Dikembalikan' WHERE id_peminjaman='$id_peminjaman'");
		}

		echo '<script>alert("Pengembalian Barang Berhasil"); window.location.href="peminjaman.php"</script>';
	}
}


//MUTASI BARANG
if (isset($_POST['tambahmutasi'])) {
	// Pastikan semua input yang diperlukan ada
	if (
		isset($_POST['id_barang'])
	) {
		$id_barang = $_POST['id_barang'];
		$jumlah = $_POST['jumlah'];
		$status_mutasi = 'Mutasi';
		$ruang = $_POST['ruang'];
		$tanggal_mutasi = $_POST['tanggal_mutasi'];


		// hitung stock sekarang ada berapa
		$hitung1 = mysqli_query($c, "SELECT stock FROM barang WHERE id_barang = '$id_barang'");
		$hitung2 = mysqli_fetch_assoc($hitung1);
		$stocksekarang = $hitung2['stock']; //stock barang saat ini

		// echo "ruang : ".$ruang;
		// echo '<br>';
		// echo "id_barang : ".$id_barang;
		// echo '<br>';
		// echo "stok : ".$stocksekarang;
		// echo '<br>';
		// echo "jumlah : ".$jumlah;


		if ($stocksekarang >= $jumlah) {
			// Kurangi stocknya dengan jumlah yang akan dikeluarkan
			$selisih = $stocksekarang - $jumlah;
			// echo '<br>';
			// echo "selisih : ".$selisih;
			// exit;

			// Stocknya cukup, lakukan operasi INSERT dan UPDATE
			$insert = mysqli_query($c, "INSERT INTO mutasi (id_barang, jumlah, status_mutasi, ruang, tanggal_mutasi) VALUES ('$id_barang','$jumlah', '$status_mutasi', '$ruang', '$tanggal_mutasi')");
			$update = mysqli_query($c, "UPDATE barang SET stock='$selisih' WHERE id_barang='$id_barang'");
			if ($insert && $update) {
				header('Location: mutasi.php?id_mutasi=' . $id_mutasi);
				exit();
			} else {
				echo "Error inserting into mutasi: " . mysqli_error($c);
			}
		} else {
			echo '<script>alert("Stok barang tidak mencukupi untuk jumlah yang diminta"); window.location.href="mutasi.php?id_mutasi=' . $id_mutasi . '"</script>';
		}
	} else {
		echo "Error querying stock: " . mysqli_error($c);
	}
}

// edit mutasi barang
if (isset($_POST['editmutasi'])) {
	if (
		isset($_POST['id_mutasi'])
	)
		$id_mutasi = $_POST['id_mutasi'];
	$jumlah = $_POST['jumlah'];
	$status_mutasi = 'Mutasi';
	$ruang = $_POST['ruang'];
	$tanggal_mutasi = $_POST['tanggal_mutasi'];

	// echo "id_mutasi : ".$id_mutasi;
	// echo '<br>';
	// echo "id_barang : ".$id_barang;
	// echo '<br>';

	//cari tau jumlah nya sekarang berapa
	$caritahu = mysqli_query($c, "select * from mutasi where id_mutasi='$id_mutasi'");
	$caritahu2 = mysqli_fetch_array($caritahu);
	$jumlahsekarang = $caritahu2['jumlah'];

	$query_mutasi = mysqli_query($c, "SELECT * FROM mutasi WHERE id_mutasi='$id_mutasi'");
	$result_mutasi = mysqli_fetch_array($query_mutasi);
	$id_barang = $result_mutasi['id_barang'];
	$status = $result_mutasi['status_mutasi'];

	// hitung stock sekarang ada berapa
	$hitung1 = mysqli_query($c, "SELECT stock FROM barang WHERE id_barang = '$id_barang'");
	$hitung2 = mysqli_fetch_assoc($hitung1);
	$stocksekarang = $hitung2['stock']; //stock barang saat ini

	// echo "id_barang : ".$id_barang;
	// echo '<br>';
	// echo "jumlah : ".$jumlahsekarang;
	// echo '<br>';

	if ($stocksekarang >= $jumlah) {
		// Kurangi stocknya dengan jumlah yang akan dikeluarkan
		$selisih = $stocksekarang - $jumlah;

		// echo '<br>';
		// echo "selisih : ".$selisih;
		// exit;

		// Update tabel mutasi dengan data yang diperbarui
		$updateMutasi = mysqli_query($c, "UPDATE mutasi SET jumlah='$jumlah', status_mutasi='$status_mutasi', ruang='$ruang', tanggal_mutasi='$tanggal_mutasi' WHERE id_barang='$id_barang'");
		// Jika pembaruan mutasi berhasil, lakukan pembaruan stok barang
		$updateStock = mysqli_query($c, "UPDATE barang SET stock='$selisih' WHERE id_barang='$id_barang'");

		if ($updateMutasi && $updateStock ) {
			echo '<script>alert("Barang Mutasi berhasil diedit."); window.location.href="mutasi.php?id_mutasi=' . $id_mutasi . '"</script>';
			exit();
		} else {
			echo "Error updating mutasi: " . mysqli_error($c);
		}
	} else {
		echo "Stock tidak mencukupi";
	}
}


//hapus data barang masuk
if (isset($_POST['hapusmutasi'])) {
	if (
		isset($_POST['id_mutasi'])
	)
		$id_mutasi = $_POST['id_mutasi'];

	// echo "id_mutasi : ".$id_mutasi;
	// echo '<br>';
	// echo "id_barang : ".$id_barang;
	// echo '<br>';

	//cari tau jumlah nya sekarang berapa
	$caritahu = mysqli_query($c, "select * from mutasi where id_mutasi='$id_mutasi'");
	$caritahu2 = mysqli_fetch_array($caritahu);
	$jumlahsekarang = $caritahu2['jumlah'];

	// echo "jumlah : ".$jumlahsekarang;
	// echo '<br>';

	$query_mutasi = mysqli_query($c, "SELECT * FROM mutasi WHERE id_mutasi='$id_mutasi'");

	$result_mutasi = mysqli_fetch_array($query_mutasi);

	$id_barang = $result_mutasi['id_barang'];
	$status = $result_mutasi['status_mutasi'];

	//cari tau stock sekarang berapa
	$caristock = mysqli_query($c, "select * from barang where id_barang='$id_barang'");
	$caristock2 = mysqli_fetch_array($caristock);
	$stocksekarang = $caristock2['stock'];

	// echo "stok sekarang : ".$stocksekarang;
	// exit;

	//hitung selisih
	$newstock = $stocksekarang + $jumlahsekarang;

	$query1 = mysqli_query($c, "delete from mutasi where id_mutasi='$id_mutasi'");
	$query2 = mysqli_query($c, "update barang set stock='$newstock' where id_barang='$id_barang'");

	if ($query1 && $query2) {
		header('location:mutasi.php');
	} else {
		echo '
        <script>alert("Gagal");
        window.location.href="mutasi.php"
        </script>
		';
	}
}

// if (isset($_POST['cetak'])) {
// 	if (
// 		isset($_POST['bulan'])
// 	)
// 		$bulan = $_POST['bulan'];
		
// 		echo "bulan : ".$bulan;
// 		exit;
// 	}

?>