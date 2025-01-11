<?php 
include 'koneksi.php'; 

function tambahPenulis($koneksi, $nama, $email) {
    try {
        $dbh = $koneksi->prepare("INSERT INTO penulis (nama, email) VALUES (:nama, :email)");
        
        $dbh->execute([
            ':nama' => htmlspecialchars($nama),
            ':email' => htmlspecialchars($email),
        ]);

        return true; 
    } catch (PDOException $e) {
        error_log("Gagal menambah penulis: " . $e->getMessage());
        return false; 
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = filter_input(INPUT_POST, 'nama');
    $email = filter_input(INPUT_POST, 'email');

    if ($nama && $email) {
        if (tambahPenulis($koneksi, $nama, $email)) {
        
            header("Location: penulis.php");
            exit();
        } else {
            $error = "Gagal menambah penulis. Silakan coba lagi.";
        }
    } else {
        $error = "Input tidak valid. Periksa kembali data Anda.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penulis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
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
        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            background: #ffe5e5;
            padding: 10px;
            border: 1px solid #ffcccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .btn-back {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
        .btn-back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><bold>Tambah Penulis</bold></h1>
        <form method="POST">
            <?php if (!empty($error)): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <button type="submit">Simpan</button>
        </form>
        <a href="penulis.php" class="btn-back">Kembali ke Daftar Penulis</a>
    </div>
</body>
</html>
