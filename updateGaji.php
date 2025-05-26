<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_karyawan = $_POST['id_karyawan'];
    $bulan = $_POST['bulan'];
    $gaji_pokok = $_POST['gaji_pokok'];
    $potongan = $_POST['potongan'];
    $keterangan = $_POST['keterangan'];

    // Hitung total gaji
    $total_gaji = $gaji_pokok - $potongan;

    // Prepare query update
    $sql = "UPDATE gaji SET gaji_pokok=?, potongan=?, total_gaji=?, keterangan=? WHERE id_karyawan=? AND bulan=?";
    $stmt = $konek->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($konek->error));
    }

    // Bind parameter: i = integer, s = string
    $stmt->bind_param("iiissi", $gaji_pokok, $potongan, $total_gaji, $keterangan, $id_karyawan, $bulan);

    // Execute statement
    if ($stmt->execute()) {
        // Redirect ke halaman gaji.php setelah berhasil update
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
?>