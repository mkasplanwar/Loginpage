<?php
// Sertakan file koneksi database
include 'db.php';

session_start();

// Periksa apakah form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form login dengan sanitasi
    $nim = mysqli_real_escape_string($conn, trim($_POST['nim']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));

    // Validasi input form
    if (empty($nim) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'NIM dan Password harus diisi.']);
        exit();
    }

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
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-image: url('wallpaper.png');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: center;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        h2 {
            margin-bottom: 10px;
            color: #ffffff;
            font-weight: bold;
        }

        .input-group {
            margin-bottom: 20px;
            text-align: left;
            position: relative;
        }

        label {
            font-size: 14px;
            color: #ffffff;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 15px;
            margin-top: 10px;
            border: none;
            border-radius: 15px;
            background: #ffffff;
            color: #333;
            font-size: 14px;
            box-shadow: inset 4px 4px 10px rgba(0, 0, 0, 0.1);
        }

        input::placeholder {
            color: #999;
        }

        .toggle-password {
            position: absolute;
            top: 45px;
            right: 20px;
            cursor: pointer;
            color: #999;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
        }

        .button-group button {
            width: 48%;
            padding: 15px;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .button-group button:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .button-group button:active {
            box-shadow: inset 4px 4px 10px rgba(0, 0, 0, 0.1);
        }

        #error-message {
            display: none;
            color: white;
            background-color: red;
            padding: 15px;
            margin-top: 10px;
            border-radius: 10px;
            font-size: 14px;
            transition: opacity 0.5s ease-in-out;
            margin-bottom: 10px;
        }

        #error-message.show {
            display: block;
            opacity: 1;
        }
        /* Gaya pesan sukses */
        #success-message {
            display: none;
            color: #ffffff;
            font-size: 14px;
            margin-top: 10px;
            background-color: green;
            padding: 15px;
            border-radius: 10px;
            transition: opacity 0.5s ease-in-out;
            margin-bottom: 10px;

        }

        #success-message.show {
            display: block;
            opacity: 1;
        }

    </style>
</head>
<body>
<div class="login-container">
<h2>Login</h2>
<div id="error-message" class="message"></div>
<div id="success-message" class="message"></div>

    <form id="loginForm" method="POST" action="">
            <div class="input-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
                <span class="toggle-password" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye" id="toggleIcon"></i>
                </span>
            </div>
            <div class="button-group">
                <button type="submit">Login</button>
                <button type="button" onclick="window.location.href='register.html'">Daftar</button>
            </div>
    </form>
        </div>
    <div id="responseMessage" style="color: red; margin-top: 10px;"></div>

    <script>
        function togglePasswordVisibility() {
    var passwordField = document.getElementById("password");
    var toggleIcon = document.getElementById("toggleIcon");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}

document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();

    var nim = document.getElementById("nim").value;
    var password = document.getElementById("password").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function() {
        console.log(xhr.responseText); // Lihat respons server
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
                showSuccessMessage("Login berhasil!");
                setTimeout(function() {
                    window.location.href = "dashboard.php"; // Arahkan ke dashboard setelah 3 detik
                }, 2000);
            } else {
                showErrorMessage(response.message);
            }
        }
    };

    xhr.send("nim=" + nim + "&password=" + password);
});

function showErrorMessage(message) {
    var errorMessage = document.getElementById("error-message");
    errorMessage.textContent = message;
    errorMessage.style.display = "block";
    errorMessage.classList.add("show");

    // Hilangkan pesan setelah 3 detik
    setTimeout(function() {
        errorMessage.classList.remove("show");
        errorMessage.style.display = "none"; // Sembunyikan pesan
    }, 2000);
}

function showSuccessMessage(message) {
    var successMessage = document.getElementById("success-message");
    successMessage.textContent = message;
    successMessage.style.display = "block";
    successMessage.classList.add("show");

    // Hilangkan pesan setelah 3 detik
    setTimeout(function() {
        successMessage.classList.remove("show");
        successMessage.style.display = "none"; // Sembunyikan pesan
    }, 2000);
}

        // $(document).ready(function () {
        //     $('#loginForm').on('submit', function (e) {
        //         e.preventDefault(); // Mencegah reload halaman
        //         const formData = $(this).serialize();

        //         $.ajax({
        //             url: '',
        //             type: 'POST',
        //             data: formData,
        //             dataType: 'json',
        //             success: function (response) {
        //                 if (response.status === 'success') {
        //                     alert('Login berhasil!');
        //                     window.location.href = 'dashboard.php'; // Redirect ke dashboard
        //                 } else {
        //                     $('#responseMessage').text(response.message);
        //                 }
        //             },
        //             error: function () {
        //                 $('#responseMessage').text('Terjadi kesalahan. Coba lagi nanti.');
        //             }
        //         });
        //     });
        // });
    </script>
</body>
</html>
