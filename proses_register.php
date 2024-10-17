<?php
include 'koneksi/koneksi.php';
if ($_GET['proses'] == 'insert') {
        // query insert
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama = $_POST['nama'];
            $jenis_kelamin = ($_POST['jenis_kelamin']);
            $email = ($_POST['email']);
            $password= md5($_POST['password']);
            $no_hp = ($_POST['no_hp']);
            $level = ($_POST['level']);
        
            $cek_user = "SELECT * FROM user WHERE nama='$nama'";
            $hasil_cek = $db->query($cek_user);
        
            if($hasil_cek->num_rows == 1){
                echo "Data gagal Disimpan! Duplicate ".$nama;
            }else{
        
            $query = "INSERT INTO user (nama, jenis_kelamin, email, password, no_hp, level) VALUES ('$nama', '$jenis_kelamin', '$email', '$password', '$no_hp', '$level')";
            if ($db->query($query) === TRUE) {
                header("Location: index.php?page=user"); //redirect
                exit;
            } else {
                echo "Error: " . $query . "<br>" . $db->error;
            }
        }  
        }
        
}