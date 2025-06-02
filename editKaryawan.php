<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

if (!isset($_GET['id_karyawan'])) {
    echo "ID Karyawan tidak ditemukan.";
    exit;
}

$id_karyawan = $_GET['id_karyawan'];

$stmt = $konek->prepare("SELECT * FROM karyawan WHERE id_karyawan = ?");
$stmt->bind_param("s", $id_karyawan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Data karyawan tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();

$stmt->close();
$konek->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Karyawan</title>
    <link rel="stylesheet" href="css/editKaryawan.css">
</head>
<body>
    <form method="POST" action="updateKaryawan.php">
        <h2>Edit Data Karyawan</h2>
        <input type="hidden" name="id_karyawan" value="<?= htmlspecialchars($data['id_karyawan']) ?>">

        <label>Nama Lengkap:   <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required></label>
        <label>Jabatan:          <select name="jabatan" required>
            <option value="Permanent" <?= $data['jabatan'] == 'Permanent' ? 'selected' : '' ?>>Permanent</option>
            <option value="SPV" <?= $data['jabatan'] == 'SPV' ? 'selected' : '' ?>>SPV</option>
            <option value="Manajer" <?= $data['jabatan'] == 'Manajer' ? 'selected' : '' ?>>Manajer</option>
            <option value="Kurir" <?= $data['jabatan'] == 'Kurir' ? 'selected' : '' ?>>Kurir</option>
            <option value="OB" <?= $data['jabatan'] == 'OB' ? 'selected' : '' ?>>OB</option>
        </select></label>


        <button type="submit" class="simpan">Simpan</button>
         <a href="indeks.php"><button class="batal">Batal</button></a>
       
    </form>
</body>
</html>