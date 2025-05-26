<?php
include 'koneksi.php';

if (
    isset($_POST['id_karyawan']) &&
    isset($_POST['bulan']) &&
    isset($_POST['gaji_pokok']) &&
    isset($_POST['potongan']) &&
    isset($_POST['keterangan'])
) {
    $id_karyawan = $_POST['id_karyawan'];
    $bulan = $_POST['bulan'];
    $gaji_pokok = $_POST['gaji_pokok'];
    $potongan = $_POST['potongan'];
    $keterangan = $_POST['keterangan'];

    // Hitung total gaji
    $total_gaji = $gaji_pokok - $potongan;

    // Siapkan query dengan prepared statement
    $stmt = mysqli_prepare($konek, "UPDATE gaji SET gaji_pokok = ?, potongan = ?, total_gaji = ?, keterangan = ? WHERE id_karyawan = ? AND bulan = ?");
    if ($stmt) {
        // Bind parameter (4 integer/double, 2 string)
        mysqli_stmt_bind_param($stmt, "ddiiss", $gaji_pokok, $potongan, $total_gaji, $keterangan, $id_karyawan, $bulan);
        
        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            header("Location: gaji.php");
            exit;
        } else {
            echo "Gagal mengupdate data: " . mysqli_stmt_error($stmt);
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Gagal menyiapkan statement: " . mysqli_error($konek);
    }
} else {
    echo "Data tidak lengkap.";
}
?>