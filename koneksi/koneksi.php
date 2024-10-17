<?php
 $host = "localhost";
 $username = "root";
 $password = "";
 $database = "inventori2";

 $db = new mysqli($host, $username, $password, $database);

 if ($db->connect_error){
    die("koneksi gagal " . $db->connect_error);
 }else {
   //  echo "d";
 }

