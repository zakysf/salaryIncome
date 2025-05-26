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
    $gaji = $data['gaji_pokok']-$data['potongan'];
    $periode = date('F Y');

} else {
    echo "ID karyawan dan bulan tidak ditemukan.";
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji Karyawan</title>
    <link rel="stylesheet" href="slipGaji.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <div class="main-content">
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
                        <tr>
                            <td>Nama Karyawan</td>
                            <td>:
                                <?php echo $data['nama']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:
                                <?php echo $data['jabatan']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Periode</td>
                            <td>:
                                <?php echo $periode; ?>
                            </td>
                        </tr>
                    </table>
                </div> 
            </div>

            <div class="salary-details">
                <table>
                    <tr class="header-row">
                        <th>Keterangan</th>
                        <th>Jumlah (Rp)</th>
                    </tr>
                    <tr>
                        <td>Gaji Pokok</td>
                        <td>
                            <?php echo number_format($data['gaji_pokok'], 0, ',', '.'); ?>
                        </td>
                    </tr>
                    <tr class="deduction-row">
                        <td>Potongan</td>
                        <td>
                            <?php echo number_format($data['potongan'], 0, ',', '.'); ?>
                        </td>
                    </tr>
                    <tr class="total-row">
                        <td><strong>TOTAL GAJI</strong></td>
                        <td><strong>
                                <?php echo number_format($gaji, 0, ',', '.'); ?>
                            </strong></td>
                    </tr>
                </table>
            </div>

            <div class="signature-section">
                <div class="employee-signature">
                    <p>Hormat Saya,</p>
                    <div class="signature-space"></div>
                    <p>(
                        <?php echo $data['nama']; ?>)
                    </p>
                </div>
                <div class="company-signature">
                    <p>Mengetahui,</p>
                    <div class="signature-space"></div>
                    <p>(Direktur PT. Razamaky)</p>
                </div>
            </div>

            <div class="print-section">
                <button onclick="window.print()" class="print-button">
                    <i class="fas fa-print"></i> Cetak Slip Gaji
                </button>
            </div>
        </div>
    </div>
</body>

</html>