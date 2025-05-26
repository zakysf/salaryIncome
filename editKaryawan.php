<?php
include 'koneksi.php';

// Cek apakah id_karyawan ada di URL
if (!isset($_GET['id_karyawan'])) {
    echo "ID Karyawan tidak ditemukan.";
    exit;
}

$id_karyawan = $_GET['id_karyawan'];

// Ambil data karyawan berdasarkan id_karyawan
$stmt = $konek->prepare("SELECT * FROM karyawan WHERE id_karyawan = ?");
$stmt->bind_param("s", $id_karyawan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Data karyawan tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangkap data dari form
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $gaji_pokok = $_POST['gaji_pokok'];

    // Update data
    $update = $konek->prepare("UPDATE karyawan SET nama = ?, jabatan = ?, gaji_pokok = ? WHERE id_karyawan = ?");
    $update->bind_param("ssis", $nama, $jabatan, $gaji_pokok, $id_karyawan);

    if ($update->execute()) {
        header("Location: indeks.php?update=success");
        exit;
    } else {
        echo "Gagal mengupdate data: " . $update->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Karyawan</title>
</head>
<body>
    <h2>Edit Data Karyawan</h2>
    <form method="POST" action="">
        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required><br><br>

        <label>Jabatan:</label><br>
        <select name="jabatan" required>
            <option value="Permanent" <?= $data['jabatan'] == 'Permanent' ? 'selected' : '' ?>>Permanent</option>
            <option value="SPV" <?= $data['jabatan'] == 'SPV' ? 'selected' : '' ?>>SPV</option>
            <option value="Manajer" <?= $data['jabatan'] == 'Manajer' ? 'selected' : '' ?>>Manajer</option>
            <option value="Kurir" <?= $data['jabatan'] == 'Kurir' ? 'selected' : '' ?>>Kurir</option>
            <option value="OB" <?= $data['jabatan'] == 'OB' ? 'selected' : '' ?>>OB</option>
        </select><br><br>

        <label>Gaji Pokok:</label><br>
        <input type="number" name="gaji_pokok" value="<?= htmlspecialchars($data['gaji_pokok']) ?>" required><br><br>

        <button type="submit">Simpan</button>
        <a href="indeks.php">Batal</a>
    </form>
</body>
</html>