<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_karyawan = $_POST['id_karyawan'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $jabatan = $_POST['jabatan'] ?? '';

    if (empty($id_karyawan) || empty($nama) || empty($jabatan)) {
        echo "Data tidak lengkap atau tidak valid.";
        exit;
    }

    $stmt = $konek->prepare("UPDATE karyawan SET nama = ?, jabatan = ? WHERE id_karyawan = ?");
    $stmt->bind_param("sss", $nama, $jabatan, $id_karyawan);

    if ($stmt->execute()) {
        header("Location: indeks.php?update=success");
        exit;
    } else {
        echo "Gagal mengupdate data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Akses tidak sah.";
}
?>