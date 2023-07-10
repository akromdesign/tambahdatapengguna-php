<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $query = "INSERT INTO nama_tabel (nama, email) VALUES ('$nama', '$email')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header('Location: index.php');
        exit;
    } else {
        echo 'Gagal menambahkan data pengguna.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
        }
        h2 {
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #4CAF50;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .btn-container {
            margin-top: 20px;
            text-align: right;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ccc;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
            margin-left: 10px;
        }
        .btn-primary {
            background-color: #4CAF50;
        }
        .btn-primary:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Data Pengguna</h2>
        <form method="POST" action="tambah.php">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <input type="submit" value="Simpan">

            <div class="btn-container">
                <a href="index.php" class="btn btn-primary">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>