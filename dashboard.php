<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File - Glassmorphism Style</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('wallpaper.png');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .upload-container {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        h2 {
            margin-bottom: 20px;
            color: #ffffff;
            font-size: 24px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #ffffff;
            font-size: 18px;
        }

        input[type="file"] {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border: none;
            outline: none;
            border-radius: 10px;
            box-shadow: inset 4px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin-bottom: 20px;
            font-size: 16px;
            color: #ffffff;
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 15px 30px;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            color: #ffffff;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        input[type="submit"]:active {
            box-shadow: inset 4px 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Tombol Logout */
        .logout-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 20px;
            color: #ffffff;
            font-size: 14px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .logout-btn:active {
            box-shadow: inset 4px 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Tombol Logout -->
    <button class="logout-btn" onclick="logout()">Logout</button>

    <div class="upload-container">
        <h2>Upload File</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="file">Select file to upload:</label>
            <input type="file" name="file" id="file" required>
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>

    <script>
        function logout() {
            // Arahkan ke halaman logout atau eksekusi logout
            window.location.href = 'logout.php';
        }
    </script>
</body>
</html>
