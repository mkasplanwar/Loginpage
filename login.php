<?php
// Sertakan file koneksi database
include 'db.php';

session_start();

// Cek apakah form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form login
    $nim = mysqli_real_escape_string($conn, $_POST['nim']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query untuk mengambil user berdasarkan NIM
    $sql = "SELECT * FROM users WHERE nim = '$nim'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ambil data user
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Password cocok, buat sesi
            $_SESSION['nim'] = $user['nim'];
            $_SESSION['nama'] = $user['nama'];

            // Kirim response sukses
            echo json_encode(['status' => 'success']);
        } else {
            // Password salah
            echo json_encode(['status' => 'error', 'message' => 'Password salah.']);
        }
    } else {
        // NIM tidak ditemukan
        echo json_encode(['status' => 'error', 'message' => 'NIM tidak ditemukan.']);
    }

    // Tutup koneksi
    $conn->close();
}
?>
