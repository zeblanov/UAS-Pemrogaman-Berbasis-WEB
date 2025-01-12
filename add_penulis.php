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

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($nama && $email) {
        if (tambahPenulis($koneksi, $nama, $email)) {
            $success = "Penulis berhasil ditambahkan.";
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
            max-width: 600px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
            margin: auto;
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            color: #495057;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #f8f9fa;
        }
        input[type="text"]:focus, input[type="email"]:focus {
            border-color: #80bdff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
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
        .success {
            color: green;
            background: #e6ffed;
            padding: 10px;
            border: 1px solid #b7ffcd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .btn-back {
            display: inline-block;
            margin-top: 15px;
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
        <h1>Tambah Penulis</h1>
        <form method="POST">
            <?php if (!empty($error)): ?>
                <div class="error"> <?= $error ?> </div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="success"> <?= $success ?> </div>
            <?php endif; ?>
            <label>Nama:</label>
            <input type="text" name="nama" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <button type="submit">Simpan</button>
        </form>
        <a href="penulis.php" class="btn-back">Kembali ke Daftar Penulis</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
