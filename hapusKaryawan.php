<?php
include 'koneksi.php';

if (!isset($_GET['id_karyawan'])) {
    echo "ID Karyawan tidak ditemukan.";
    exit;
}

$id_karyawan = $_GET['id_karyawan'];

// Hapus data karyawan berdasarkan id_karyawan
$stmt = $konek->prepare("DELETE FROM karyawan WHERE id_karyawan = ?");
$stmt->bind_param("s", $id_karyawan);

if ($stmt->execute()) {
    header("Location: indeks.php?hapus=success");
    exit;
} else {
    echo "Gagal menghapus data: " . $stmt->error;
}