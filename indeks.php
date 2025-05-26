<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="indeks.css">
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
                            <?php echo $nama?>
                        </h4>
                        <p>
                            <?php echo $jabatan?>
                        </p>
                        Testibng
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
                <span><a href="slipGaji.php">Slip Gaji</a>
                </span>
            </li>
            <li class="log-out-tombol">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span><a href="">Log Out</a></span>
            </li>
        </ul>
    </div>



    <div class="container">
        <h2>Add Employee</h2>
        <button>+ Add Employee</button>

        <form>
            <div class="sejajar">
                <label for="nama-lengkap">Nama Lengkap : </label>
                <input type="text" placeholder="Masukkan Nama Lengkap" required>

                <label for="id-karyawan">ID karyawan</label>
                <input type="text" id="id-karyawan" placeholder="Masukkan ID karyawan" required>

                <label for="jabatan">Jabatan</label>
                <select id="jabatan" required>
                    <option value="Permanent">Permanent</option>
                    <option value="Contract">SPV</option>
                    <option value="Contract">Manajer</option>
                    <option value="Contract">Kurir</option>
                    <option value="Contract">OB</option>
                </select>
            </div>

            <div class="sejajar">
                <label for="gaji">Upah Bulanan</label>
                <input type="number" id="gaji" placeholder="Nominal Upah" required>

                <label for="gaji">Upah Bulanan</label>
                <input type="number" id="gaji" placeholder="Nominal Upah" required>

                <label for="gaji">Upah Bulanan</label>
                <input type="number" id="gaji" placeholder="Nominal Upah" required>

            </div>


            <button type="button" class="cancel-btn">Cancel</button>
            <button type="submit" class="save-btn">Save</button>
        </form>

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
            include 'koneksi.php';
            
            $query = mysqli_query($konek, "select * from karyawan");

            // $array = [
            //     "nama" => "zaky",
            //     "email" => "zaky@gmail.com",
            //     "pesan" => "saya sigma",
            // ];
            
            //mengambil per baris data
            while($data = mysqli_fetch_array($query))
        ?>{
            <tr>
                <!-- menampilkan isi kolom nama -->
                <td><?=htmlspecialcha($data['id_karyawan'])?></td> 
                <!-- menampilkan isi kolom email -->
                <td><?=htmlspecialchar($data['nama'])?></td> 
                <!-- menampilkan isi kolom pesan -->
                <td><?=htmlspecialchar($data['jabatan'])?></td>
                <td>
                    <a href="edit.php?no_tamu=<?=$data['no_tamu']?>">Edit</a> | <a href="hapus.php?no_tamu=<?=$data['no_tamu']?>">Hapus</a>
                </td>
            </tr>
            }



    </div>
</body>

</html>