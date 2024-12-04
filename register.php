<?php
// Sertakan file koneksi database
include 'db.php';

// Cek apakah form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash password sebelum disimpan
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menyimpan data
    $sql = "INSERT INTO users (nim, nama, password) VALUES ('$nim', '$nama', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        // Kirim response sukses
        echo json_encode(['status' => 'success']);
    } else {
        // Kirim response error
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data: ' . $conn->error]);
    }

    // Tutup koneksi
    $conn->close();
}
?>
