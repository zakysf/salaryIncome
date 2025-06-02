<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

if (isset($_GET['id_karyawan'])) {
    $id_karyawan = $_GET['id_karyawan'];

    $query = mysqli_query($konek, "SELECT * FROM gaji g JOIN karyawan k ON k.id_karyawan = g.id_karyawan WHERE g.id_karyawan='$id_karyawan'");
    $data = mysqli_fetch_assoc($query);
} else {
    echo "ID karyawan dan bulan tidak ditemukan.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Gaji</title>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>
    <form method="POST" action="css/updateGaji.php" class="container">
        <div class="sejajar">
        <h2>Edit Data Gaji</h2>
        <p><?= $data['nama']; ?></p>  
        </div>
        <input type="hidden" name="id_karyawan" value="<?= $data['id_karyawan']; ?>">

        <label>Gaji Pokok</label>
        <input type="number" name="gaji_pokok" value="<?= $data['gaji_pokok']; ?>"><br>

        <label>Potongan</label>
        <input type="number" name="potongan" value="<?= $data['potongan']; ?>"><br>

        <label>Keterangan</label>
        <select name="keterangan">
            <option value="TERBAYAR" <?= $data['keterangan'] == 'TERBAYAR' ? 'selected' : '' ?>>TERBAYAR</option>
            <option value="BELUM TERBAYAR" <?= $data['keterangan'] == 'BELUM TERBAYAR' ? 'selected' : '' ?>>BELUM TERBAYAR</option>
        </select><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>