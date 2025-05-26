<?php
include 'koneksi.php';

if (isset($_GET['id_karyawan']) && isset($_GET['bulan'])) {
    $id_karyawan = $_GET['id_karyawan'];
    $bulan = $_GET['bulan'];

    $query = mysqli_query($konek, "SELECT * FROM gaji WHERE id_karyawan='$id_karyawan' AND bulan='$bulan'");
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
</head>
<body>
    <h2>Edit Data Gaji</h2>
    <form method="POST" action="updateGaji.php">
        <input type="hidden" name="id_karyawan" value="<?= $data['id_karyawan']; ?>">
        <input type="hidden" name="bulan" value="<?= $data['bulan']; ?>">

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