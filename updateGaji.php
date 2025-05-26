<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_karyawan = $_POST['id_karyawan'];
    $gaji_pokok = $_POST['gaji_pokok'];
    $potongan = $_POST['potongan'];
    $keterangan = $_POST['keterangan'];

    // Prepare query update (tanpa total_gaji)
    $sql = "UPDATE gaji SET gaji_pokok=?, potongan=?, keterangan=? WHERE id_karyawan=?";
    $stmt = $konek->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($konek->error));
    }

    // Bind parameter: i = integer, s = string
    $stmt->bind_param("iiss", $gaji_pokok, $potongan, $keterangan, $id_karyawan);

    // Execute statement
    if ($stmt->execute()) {
        header("Location: gaji.php?update=success");
        exit;
    } else {
        echo "Error update data: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $konek->close();
} else {
    echo "Invalid request method.";
}