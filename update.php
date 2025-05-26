<?php
  include 'koneksi.php';

  $id_karyawan = $_POST['id_karyawan'];
  $nama = $_POST['nama'];
  $jabatan = $_POST['jabatan'];

  $query = mysqli_query($konek, "update tamu set nama='$nama', jabatan='$jabatan' where id_karyawan=$id_karyawan") or die(mysqli_error($konek));

  if($query){
    echo "Proses update berhasil. Lihat hasil <a href='tampil_tamu.php'>di sini</a>";
  } else {
    echo "Proses update gagal";
  }
?>