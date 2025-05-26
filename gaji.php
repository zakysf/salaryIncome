<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gaji Karyawan</title>    
    <link rel="stylesheet" href="gaji.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <?php include "koneksi.php";
     $query = "SELECT k.nama, k.id_karyawan, k.jabatan, g.gaji_pokok, g.potongan, (g.gaji_pokok - g.potongan) AS total_gaji, g.keterangan
                  FROM gaji g
                  JOIN karyawan k ON g.id_karyawan = k.id_karyawan
                  ORDER BY k.id_karyawan ASC";
        
        $result = $konek->query($query);
    ?>
    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="isi-list">
            <div class="data-akun">
                <li>
                    <i class="fas fa-user"></i>
                    <span>
                        <h4><?php echo isset($nama) ? $nama : 'Admin'; ?></h4>
                        <p><?php echo isset($jabatan) ? $jabatan : 'Administrator'; ?></p>
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
                <span><a href="#">Log Out</a></span>
            </li>
        </ul>
    </div>

    <div class="container">
        <h2>Data Gaji Karyawan</h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>ID</th>
                    <th>Jabatan</th>
                    <th>Gaji Pokok</th>
                    <th>Potongan</th>
                    <th>Total Gaji</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
               <?php
if ($result->num_rows > 0) {
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        $total_gaji = $row['gaji_pokok'] - $row['potongan'];
        
        // Tentukan class CSS berdasarkan status (case sensitive)
        $status_class = '';
        $status_text = trim($row['keterangan']);
        
        if ($status_text == 'TERBAYAR') {
            $status_class = 'status-TERBAYAR';
        } else if ($status_text == 'BELUM TERBAYAR') {
            $status_class = 'status-BELUM-TERBAYAR';
        }
        
        echo "<tr>
        <td>{$no}</td>
        <td>{$row['nama']}</td>
        <td>{$row['id_karyawan']}</td>
        <td>{$row['jabatan']}</td>
        <td>Rp " . number_format($row['gaji_pokok'], 0, ',', '.') . "</td>
        <td>Rp " . number_format($row['potongan'], 0, ',', '.') . "</td>
        <td>Rp " . number_format($total_gaji, 0, ',', '.') . "</td>
        <td><span class='{$status_class}'>{$row['keterangan']}</span></td>
        <td><a href='editGaji.php?id_karyawan=" . $row['id_karyawan'] . "'><button>Edit</button></a></td>
      </tr>";
        $no++;
    }
} else {
    echo "<tr><td colspan='9'>Tidak ada data gaji</td></tr>";
}
?>
            </tbody>
        </table>
        
        <?php
        $konek->close();
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

</body>
</html>