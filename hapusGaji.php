<?php
include 'koneksi.php';

if (isset($_GET['id_karyawan']) && isset($_GET['bulan'])) {
    $id_karyawan = $_GET['id_karyawan'];
    $bulan = $_GET['bulan'];

    // Prepare statement hapus
    $sql = "DELETE FROM gaji WHERE id_karyawan = ? AND bulan = ?";
    $stmt = $konek->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($konek->error));
    }

    $stmt->bind_param("is", $id_karyawan, $bulan);

    if ($stmt->execute()) {
        // Redirect ke gaji.php setelah berhasil hapus
        header("Location: gaji.php?hapus=success");
        exit;
    } else {
        echo "Error menghapus data: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $konek->close();
} else {
    echo "Parameter id_karyawan dan bulan tidak ditemukan.";
}
?>