<?php
include "koneksi.php";

$username = "zakyjaki";
$password = "admin456";

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $konek->prepare("INSERT INTO admin (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hash);

if ($stmt->execute()) {
    echo "Admin berhasil ditambahkan.";
} else {
    echo "Gagal: " . $stmt->error;
}

$konek->close();