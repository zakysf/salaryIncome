<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>    
    <link rel="stylesheet" href="gaji.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
 
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
                            <?php echo $nama?>
                        </h4>
                        <p>
                            <?php echo $jabatan?>
                        </p>
                        testdsiagdlcwygdq;as
                    </span>
                </li>
            </div>
            <li>
                <i class="fa-solid fa-users-line"></i>
                <span><a href="#">Karyawan</a></span>
            </li>
            <li>
                <i class="fa-solid fa-money-bill-transfer"></i>
                <span><a href="gaji.php">Gaji</a></span>
            </li>
            <li>
                <i class="fa-solid fa-file-invoice"></i>
                <span><a href="slipGaji.php">Slip Gaji</a>
                </span>
            </li>
            <li class="log-out-tombol">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span><a href="#">Log Out</a></span>
            </li>
        </ul>
    </div>




        <table border='1'>
            <tr>
                <th>Nama</th>
                <th>Id karyawan</th>
                <th>Jabatan</th>
                <th>Gaji</th>
                <th>Lainnya</th>
            </tr>
            <tr>
                <?php
            while ($row = $hasildata->fetch_array()) {
            ?>
                <td>
                    <?=$row['nama']?>
                </td>
                <td>
                    <?=$row['id_karyawan']?>
                </td>
                <td>
                    <?=$row['jabatan']?>
                </td>
                <td>
                    <?=$row['gaji']?>
                </td>
                <td>
                    <?=$row['blablabla']?>
                </td>
            </tr>
            <?php } ?>
</body>
</html>