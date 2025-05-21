<?php
    $hostname = "localhost"; //alamat server database
    $username = "root"; //username default
    $password = ""; //password kosong
    $database = "projekWeb"; //nama database

    //membuat koneksi ke database
    $konek = new mysqli($hostname, $username, $password, $database);

    //cek apakah berhasil atau tidak
    if($konek->connect_error){
        die('Maaf koneksi gagal: ' . $konek->connect_error);
    }
?>