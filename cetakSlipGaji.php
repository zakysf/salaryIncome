<?php
include 'koneksi.php';

if (!isset($_GET['id_karyawan'])) {
    echo "ID karyawan tidak ditemukan.";
    exit;
}

$id_karyawan = $_GET['id_karyawan'];
$stmt = $konek->prepare("SELECT 
    k.nama, k.jabatan, 
    g.gaji_pokok, g.potongan, g.tunjangan, g.bonus
    FROM karyawan k 
    JOIN gaji g ON k.id_karyawan = g.id_karyawan 
    WHERE k.id_karyawan = ?");
$stmt->bind_param("s", $id_karyawan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Data tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();

$nama = $data['nama'];
$jabatan = $data['jabatan'];
$gaji_pokok = $data['gaji_pokok'];
$tunjangan = $data['tunjangan'];
$bonus = $data['bonus'];
$potongan = $data['potongan'];
$bulan = date('F Y');
$total_gaji = $gaji_pokok + $tunjangan + $bonus - $potongan;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Slip Gaji - <?= htmlspecialchars($nama) ?></title>
    <link rel="stylesheet" href="slipGaji.css">
</head>
<body>
    <div class="slip-container">
        <h1 class="slip-title">SLIP GAJI KARYAWAN</h1>
        <div class="slip-header">
            <div class="company-info">
                <h2>PT. Razamaky</h2>
                <p>Jl. Tambakbayan</p>
                <p>Telp: (021) 12345678</p>
            </div>
            <div class="employee-info">
                <table>
                    <tr><td>Nama</td><td>: <?= $nama ?></td></tr>
                    <tr><td>Jabatan</td><td>: <?= $jabatan ?></td></tr>
                    <tr><td>Periode</td><td>: <?= $bulan ?></td></tr>
                </table>
            </div>
        </div>

        <div class="salary-details">
            <table>
                <tr class="header-row"><th>Keterangan</th><th>Jumlah (Rp)</th></tr>
                <tr><td>Gaji Pokok</td><td><?= number_format($gaji_pokok, 0, ',', '.') ?></td></tr>
                <tr><td>Tunjangan</td><td><?= number_format($tunjangan, 0, ',', '.') ?></td></tr>
                <tr><td>Bonus</td><td><?= number_format($bonus, 0, ',', '.') ?></td></tr>
                <tr class="deduction-row"><td>Potongan</td><td><?= number_format($potongan, 0, ',', '.') ?></td></tr>
                <tr class="total-row"><td><strong>TOTAL GAJI</strong></td><td><strong><?= number_format($total_gaji, 0, ',', '.') ?></strong></td></tr>
            </table>
        </div>

        <div class="signature-section">
            <div class="employee-signature">
                <p>Hormat Saya,</p>
                <div class="signature-space"></div>
                <p>(<?= $nama ?>)</p>
            </div>
            <div class="company-signature">
                <p>Mengetahui,</p>
                <div class="signature-space"></div>
                <p>(Direktur PT. Razamaky)</p>
            </div>
        </div>

        <div class="print-section">
            <button onclick="window.print()" class="print-button"><i class="fas fa-print"></i> Cetak Slip Gaji</button>
        </div>
    </div>
</body>
</html>
