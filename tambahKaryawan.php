<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_karyawan = $_POST['id_karyawan'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $jabatan = $_POST['jabatan'] ?? '';
    $gaji_pokok = $_POST['gaji_pokok'] ?? 0;
    $potongan = $_POST['potongan'] ?? 0;

    // Validasi sederhana
    if (empty($id_karyawan) || empty($nama) || empty($jabatan) || !is_numeric($gaji_pokok) || !is_numeric($potongan)) {
        echo "Data tidak lengkap atau tidak valid.";
        exit;
    }

    // Cek apakah ID karyawan sudah ada di tabel karyawan
    $cek = $konek->prepare("SELECT id_karyawan FROM karyawan WHERE id_karyawan = ?");
    $cek->bind_param("s", $id_karyawan);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
        echo "ID Karyawan sudah terdaftar.";
        $cek->close();
        exit;
    }
    $cek->close();

    // Mulai transaksi agar data konsisten
    $konek->begin_transaction();

    try {
        // Insert ke tabel karyawan
        $stmt1 = $konek->prepare("INSERT INTO karyawan (id_karyawan, nama, jabatan) VALUES (?, ?, ?)");
        $stmt1->bind_param("sss", $id_karyawan, $nama, $jabatan);
        $stmt1->execute();
        $stmt1->close();

        // Insert ke tabel gaji
        $stmt2 = $konek->prepare("INSERT INTO gaji (id_karyawan, gaji_pokok, potongan) VALUES (?, ?, ?)");
        $stmt2->bind_param("sii", $id_karyawan, $gaji_pokok, $potongan);
        $stmt2->execute();
        $stmt2->close();

        // Commit jika semua berhasil
        $konek->commit();

        // Redirect ke halaman indeks
        header("Location: indeks.php?add=success");
        exit;
    } catch (Exception $e) {
        // Rollback jika error
        $konek->rollback();
        echo "Gagal menambahkan karyawan: " . $e->getMessage();
        exit;
    }
} else {
    echo "Akses tidak sah.";
}
