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

$query = "SELECT * FROM nama_tabel";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Query Error: ' . mysqli_error($koneksi));
}

// Generate CSV file
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    $filename = 'data_pengguna.csv';
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=' . $filename);

    $output = fopen('php://output', 'w');
    fputcsv($output, array('ID', 'Nama', 'Email'), ';'); // Menggunakan ';' sebagai pemisah kolom

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row, ';'); // Menggunakan ';' sebagai pemisah kolom
    }

    fclose($output);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Database Sederhana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 4px;
        }
        h2 {
            margin-top: 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .btn-container {
            margin-top: 20px;
            text-align: right;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-left: 10px;
        }
        .btn-primary {
            background-color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Pengguna</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="btn-container">
            <a href="tambah.php" class="btn">Tambah Data Pengguna</a>
            <a href="?export=csv" class="btn">Unduh CSV</a>
        </div>
    </div>
</body>
</html>