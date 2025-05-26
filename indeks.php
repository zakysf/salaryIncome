<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <link rel="stylesheet" href="indeks.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                <span><a href="login.php">Log Out</a></span>
            </li>
        </ul>
    </div>

    <div class="container">
        <h2>Data Karyawan</h2>
        <button onclick="toggleForm()">+ Add Employee</button>

        <form method="POST" action="tambahKaryawan.php" style="display: none;" id="employeeForm">
            <div class="sejajar">
                <div>
                    <label for="nama-lengkap">Nama Lengkap:</label>
                    <input type="text" name="nama" id="nama-lengkap" placeholder="Masukkan Nama Lengkap" required>
                </div>

                <div>
                    <label for="id-karyawan">ID Karyawan:</label>
                    <input type="text" name="id_karyawan" id="id-karyawan" placeholder="Masukkan ID Karyawan" required>
                </div>

                <div>
                    <label for="jabatan">Jabatan:</label>
                    <select name="jabatan" id="jabatan" required>
                        <option value="">Pilih Jabatan</option>
                        <option value="Permanent">Permanent</option>
                        <option value="SPV">SPV</option>
                        <option value="Manajer">Manajer</option>
                        <option value="Kurir">Kurir</option>
                        <option value="OB">OB</option>
                    </select>
                </div>
            </div>

            <div class="sejajar">
                <div>
                    <label for="gaji">Gaji Pokok:</label>
                    <input type="number" name="gaji_pokok" id="gaji" placeholder="Masukkan Gaji Pokok" required>
                </div>

                <div>
                    <label for="potongan">Potongan:</label>
                    <input type="number" name="potongan" id="potongan" placeholder="Masukkan Potongan" value="0">
                </div>
            </div>

            <button type="button" class="cancel-btn" onclick="toggleForm()">Cancel</button>
            <button type="submit" class="save-btn">Save</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>ID Karyawan</th>
                    <th>Jabatan</th>
                    <th>Gaji Bersih</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'koneksi.php';

                $query = mysqli_query($konek, "SELECT 
                    k.nama, 
                    k.id_karyawan, 
                    k.jabatan, 
                    g.gaji_pokok, 
                    g.potongan, 
                    (g.gaji_pokok - g.potongan) AS gaji_total
                FROM gaji g
                JOIN karyawan k ON g.id_karyawan = k.id_karyawan
                ORDER BY k.nama ASC");

                if (mysqli_num_rows($query) > 0) {
                    $no = 1;
                    while($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= htmlspecialchars($data['nama']) ?></td>
                    <td><?= htmlspecialchars($data['id_karyawan']) ?></td>
                    <td><?= htmlspecialchars($data['jabatan']) ?></td>
                    <td>Rp <?= number_format($data['gaji_total'], 0, ',', '.') ?></td>
                    <td>
                        <a href="editKaryawan.php?id_karyawan=<?= $data['id_karyawan'] ?>">Edit</a> | 
                        <a href="hapusKaryawan.php?id_karyawan=<?= $data['id_karyawan'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data karyawan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function toggleForm() {
            const form = document.getElementById('employeeForm');
            form.style.display = (form.style.display === 'none' || form.style.display === '') ? 'block' : 'none';
        }
    </script>
</body>
</html>