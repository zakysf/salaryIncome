<?php
include 'koneksi.php';

if (!isset($_GET['id_karyawan'])) {
    echo "ID Karyawan tidak ditemukan.";
    exit;
}

$id_karyawan = $_GET['id_karyawan'];

// Hapus data dari tabel gaji terlebih dahulu
$stmtGaji = $konek->prepare("DELETE FROM gaji WHERE id_karyawan = ?");
$stmtGaji->bind_param("s", $id_karyawan);
$stmtGaji->execute();
$stmtGaji->close();

// Setelah itu baru hapus data dari tabel karyawan
$stmtKaryawan = $konek->prepare("DELETE FROM karyawan WHERE id_karyawan = ?");
$stmtKaryawan->bind_param("s", $id_karyawan);

if ($stmtKaryawan->execute()) {
    $stmtKaryawan->close();
    $konek->close();
    header("Location: indeks.php?hapus=success");
    exit;
} else {
    echo "Gagal menghapus data: " . $stmtKaryawan->error;
    $stmtKaryawan->close();
    $konek->close();
}
?>