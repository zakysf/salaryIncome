<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Payroll - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>
    
        <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h4><i class="bi bi-currency-exchange"></i> Payroll System</h4>
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="#karyawan" class="menu-link active" id="karyawanTab">
                    <i class="bi bi-people-fill menu-icon"></i>
                    <span>Karyawan</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#gaji" class="menu-link" id="gajiTab">
                    <i class="bi bi-cash-stack menu-icon"></i>
                    <span>Gaji</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="#pengaturan" class="menu-link" id="pengaturanTab">
                    <i class="bi bi-gear-fill menu-icon"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
            <li class="menu-item" style="margin-top: 20px;">
                <a href="#logout" class="menu-link" id="logoutTab">
                    <i class="bi bi-box-arrow-right menu-icon"></i>
                    <span>Log Out</span>
                </a>
            </li>
        </ul>
    </div>
    
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <h2 id="contentTitle">Manajemen Karyawan</h2>
        <div id="contentArea">
            <!-- Konten akan berubah di sini -->
            <p>Selamat datang di sistem payroll. Silakan pilih menu dari sidebar.</p>
        </div>
    </div>
     <table class="table table-dark table-striped-columns">
        <tr>
            <td>Nama</td>
            <td>Email</td>
            <td>Pesan</td>
            <td>Opsi</td>
        </tr>
        <?php
            include 'koneksi.php';
            
            $query = mysqli_query($konek, "select * from karyawan");            
            //mengambil per baris data
            while($data = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><?=htmlspecialchars($data['id_karyawan'])?></td> 
                <td><?=htmlspecialchars($data['nama'])?></td> 
                <td><?=htmlspecialchars($data['jabatan'])?></td>
                <td>
                    <a href="edit.php?id_karyawan=<?=$data['id_karyawan']?>">Edit</a> | <a href="hapus.php?id_karyawan=<?=$data['id_karyawan']?>">Hapus</a>
                </td>
            </tr>
        <?php
            }
        ?>
    </table>

    <!-- Simple JavaScript for interactivity -->
    <!-- <script>
        // Toggle sidebar for mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });
        
        // Tab switching functionality
        const tabs = ['karyawanTab', 'gajiTab', 'pengaturanTab', 'logoutTab'];
        const contentTitles = {
            'karyawanTab': 'Manajemen Karyawan',
            'gajiTab': 'Manajemen Gaji',
            'pengaturanTab': 'Pengaturan Sistem',
            'logoutTab': 'Keluar dari Sistem'
        };
        
        tabs.forEach(tabId => {
            document.getElementById(tabId).addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all tabs
                tabs.forEach(id => {
                    document.getElementById(id).classList.remove('active');
                });
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Update content title
                document.getElementById('contentTitle').textContent = contentTitles[tabId];
                
                // Simple content change (in a real app, you would load actual content)
                document.getElementById('contentArea').innerHTML = `
                    <p>Anda sedang melihat: <strong>${contentTitles[tabId]}</strong></p>
                    ${tabId === 'logoutTab' ? '<div class="alert alert-warning">Anda akan keluar dari sistem</div>' : ''}
                `;
            });
        });
    </script> -->
</body>
</html>