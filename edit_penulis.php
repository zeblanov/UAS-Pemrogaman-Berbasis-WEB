<?php
include 'koneksi.php'; 

$id = $_GET['id'];

try {
    $dbh = $koneksi->prepare("SELECT * FROM penulis WHERE id = ?");
    $dbh->execute([$id]);
    $penulis = $dbh->fetch(PDO::FETCH_ASSOC);

    if (!$penulis) {
        echo "Penulis tidak ditemukan!";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama = $_POST['nama'];
        $email = $_POST['email'];

        $dbh = $koneksi->prepare("UPDATE penulis SET nama = ?, email = ? WHERE id = ?");
        $dbh->execute([$nama, $email, $id]);

        header("Location: penulis.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Penulis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin: auto;
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            color: #34495e;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #2980b9;
        }
        .btn-back {
            display: inline-block;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
        }
        .btn-back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Penulis</h1>
        <form method="POST">
            <label>Nama:</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($penulis['nama']); ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($penulis['email']); ?>">

            <button type="submit">Simpan</button>
        </form>
        <a href="penulis.php" class="btn-back">Kembali ke Daftar Penulis</a>
    </div>
</body>
</html>
