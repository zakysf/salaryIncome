<?php
session_start();
include 'koneksi.php'; // file koneksi ke database

$username = $_POST['username'];
$password = $_POST['password'];

// Ambil data dari database
$query = mysqli_query($konek, "SELECT * FROM admin WHERE username = '$username'");

if (mysqli_num_rows($query) === 1) {
    $user = mysqli_fetch_assoc($query);

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        // Set session
        $_SESSION['username'] = $user['username'];
        $_SESSION['jabatan'] = $user['jabatan'];
        header("Location: indeks.php");
        exit;
    } else {
        echo "Password salah";
    }
} 
// else {
//     echo "Username tidak ditemukan";
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login UI</title>
    <link rel="stylesheet" href="login.css">
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="login-container">
        <div class="form-box">
            <h2>Login</h2>
            <form method="POST">
                <div class="input-box">
                    <i class="fa fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-box">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="login-btn">Login</button>
            </form>
        </div>
        <div class="welcome-box">
            <h1>Selamat<br>Datang!</h1>
            <p>Aplikasi Sistem Penggajian PT. Razamaky</p>
        </div>
    </div>
</body>
</html>