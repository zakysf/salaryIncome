<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gaji Karyawan</title>    
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="gaji.css">
</head>
<body>
    <?php 
    include "koneksi.php";
    
    // Handle search
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $where_clause = '';
    if (!empty($search)) {
        $search = $konek->real_escape_string($search);
        $where_clause = "WHERE k.nama LIKE '%$search%' OR k.id_karyawan LIKE '%$search%' OR k.jabatan LIKE '%$search%'";
    }
    
    $query = "SELECT k.nama, k.id_karyawan, k.jabatan, g.gaji_pokok, g.potongan, g.total_gaji, g.bulan, g.id_gaji
              FROM gaji g
              JOIN karyawan k ON g.id_karyawan = k.id_karyawan
              $where_clause
              ORDER BY g.bulan DESC";
    
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
                <span><a href="#">Karyawan</a></span>
            </li>
            <li class="active">
                <i class="fa-solid fa-money-bill-transfer"></i>
                <span><a href="gaji.php">Gaji</a></span>
            </li>
            <li>
                <i class="fa-solid fa-file-invoice"></i>
                <span><a href="slipGaji.php">Slip Gaji</a></span>
            </li>
            <li>
                <i class="fa-solid fa-chart-line"></i>
                <span><a href="#">Laporan</a></span>
            </li>
            <li>
                <i class="fa-solid fa-cog"></i>
                <span><a href="#">Pengaturan</a></span>
            </li>
            <li class="log-out-tombol">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span><a href="#">Log Out</a></span>
            </li>
        </ul>
    </div>

    <div class="container">
        <!-- Page Header -->
        <div class="page-header">
            <h2>
                <i class="fa-solid fa-money-bill-transfer"></i>
                Data Gaji Karyawan
            </h2>
            <p>Kelola dan pantau data gaji seluruh karyawan dengan mudah</p>
        </div>
        
        <!-- Action Buttons -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="add_gaji.php" class="btn btn-success btn-lg">
                    <i class="fas fa-plus"></i> Tambah Data Gaji
                </a>
                <a href="export_gaji.php" class="btn btn-outline-primary btn-lg ms-2">
                    <i class="fas fa-download"></i> Export Excel
                </a>
            </div>
            <form method="GET" action="" class="d-flex">
                <div class="input-group" style="width: 300px;">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Cari karyawan..." name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>
        </div>
        
        <!-- Table Container -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table salary-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>ID Karyawan</th>
                            <th>Jabatan</th>
                            <th>Bulan</th>
                            <th>Gaji Pokok</th>
                            <th>Potongan</th>
                            <th>Total Gaji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                $total_gaji = $row['gaji_pokok'] - $row['potongan'];
                                echo "<tr>
                                        <td>{$no}</td>
                                        <td class='employee-name'>{$row['nama']}</td>
                                        <td><span class='employee-id'>{$row['id_karyawan']}</span></td>
                                        <td><span class='position-badge'>{$row['jabatan']}</span></td>
                                        <td><span class='month-badge'>{$row['bulan']}</span></td>
                                        <td class='salary-amount'>Rp " . number_format($row['gaji_pokok'], 0, ',', '.') . "</td>
                                        <td class='deduction-amount'>Rp " . number_format($row['potongan'], 0, ',', '.') . "</td>
                                        <td class='total-amount'>Rp " . number_format($total_gaji, 0, ',', '.') . "</td>
                                        <td>
                                            <div class='action-buttons'>
                                                <a href='edit_gaji.php?id={$row['id_gaji']}' class='btn-action btn-edit' title='Edit'>
                                                    <i class='fas fa-edit'></i>
                                                </a>
                                                <a href='view_gaji.php?id={$row['id_gaji']}' class='btn-action btn-view' title='Lihat Detail'>
                                                    <i class='fas fa-eye'></i>
                                                </a>
                                                <a href='delete_gaji.php?id={$row['id_gaji']}' class='btn-action btn-delete' title='Hapus' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>
                                                    <i class='fas fa-trash'></i>
                                                </a>
                                            </div>
                                        </td>
                                      </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr>
                                    <td colspan='9' class='no-data'>
                                        <i class='fas fa-inbox'></i><br>
                                        Tidak ada data gaji yang tersedia
                                    </td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Statistics Cards -->
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x text-primary mb-2"></i>
                        <h5 class="card-title">Total Karyawan</h5>
                        <h3 class="text-primary"><?php echo $result->num_rows; ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-money-bill-wave fa-2x text-success mb-2"></i>
                        <h5 class="card-title">Total Gaji</h5>
                        <?php
                        $total_query = "SELECT SUM(gaji_pokok - potongan) as total FROM gaji";
                        $total_result = $konek->query($total_query);
                        $total_row = $total_result->fetch_assoc();
                        ?>
                        <h3 class="text-success">Rp <?php echo number_format($total_row['total'], 0, ',', '.'); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-line fa-2x text-info mb-2"></i>
                        <h5 class="card-title">Rata-rata Gaji</h5>
                        <?php
                        $avg_query = "SELECT AVG(gaji_pokok - potongan) as average FROM gaji";
                        $avg_result = $konek->query($avg_query);
                        $avg_row = $avg_result->fetch_assoc();
                        ?>
                        <h3 class="text-info">Rp <?php echo number_format($avg_row['average'], 0, ',', '.'); ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar fa-2x text-warning mb-2"></i>
                        <h5 class="card-title">Bulan Aktif</h5>
                        <?php
                        $month_query = "SELECT COUNT(DISTINCT bulan) as months FROM gaji";
                        $month_result = $konek->query($month_query);
                        $month_row = $month_result->fetch_assoc();
                        ?>
                        <h3 class="text-warning"><?php echo $month_row['months']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php
    $konek->close();
    ?>
</body>
</html>