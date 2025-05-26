<?php
$nama = "Zaky SuFa";
$jabatan = "Software Developer";
$bulan = date('F Y');
$gaji_pokok = 10000000;
$tunjangan = 2000000;
$bonus = 500000;
$potongan = 750000;
$total_gaji = $gaji_pokok + $tunjangan + $bonus - $potongan;
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
    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="isi-list">
            <div class="data-akun">
                <li>
                    <i class="fas fa-user"></i>
                    <span>
                        <h4>
                            <?php echo $nama; ?>
                        </h4>
                        <p>
                            <?php echo $jabatan; ?>
                        </p>
                    </span>
                </li>
            </div>
            <li>
                <i class="fa-solid fa-users-line"></i>
                <span><a href="indeks.php">Karyawan</a></span>
            </li>
            <li>
                <i class="fa-solid fa-money-bill-transfer"></i>
                <span><a href="gaji.php">Gaji</a></span>
            </li>
            <li>
                <i class="fa-solid fa-file-invoice"></i>
                <span><a href="slipGaji.php">Slip Gaji</a></span>
            </li>
            <li class="log-out-tombol">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span><a href="login.php">Log Out</a></span>
            </li>
        </ul>
    </div>

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
                                <?php echo $nama; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jabatan</td>
                            <td>:
                                <?php echo $jabatan; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Periode</td>
                            <td>:
                                <?php echo $bulan; ?>
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
                            <?php echo number_format($gaji_pokok, 0, ',', '.'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tunjangan</td>
                        <td>
                            <?php echo number_format($tunjangan, 0, ',', '.'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Bonus</td>
                        <td>
                            <?php echo number_format($bonus, 0, ',', '.'); ?>
                        </td>
                    </tr>
                    <tr class="deduction-row">
                        <td>Potongan</td>
                        <td>
                            <?php echo number_format($potongan, 0, ',', '.'); ?>
                        </td>
                    </tr>
                    <tr class="total-row">
                        <td><strong>TOTAL GAJI</strong></td>
                        <td><strong>
                                <?php echo number_format($total_gaji, 0, ',', '.'); ?>
                            </strong></td>
                    </tr>
                </table>
            </div>

            <div class="signature-section">
                <div class="employee-signature">
                    <p>Hormat Saya,</p>
                    <div class="signature-space"></div>
                    <p>(
                        <?php echo $nama; ?>)
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