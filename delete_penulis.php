<?php
include 'koneksi.php'; 
$id = $_GET['id'];

$error = '';
$success = '';

try {
    $dbh = $koneksi->prepare("DELETE FROM penulis WHERE id = ?");
    $dbh->execute([$id]);

    $success = "Penulis berhasil dihapus.";
} catch (PDOException $e) {
    $error = "Gagal menghapus penulis: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Penulis</title>
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
            text-align: center;
        }
        h1 {
            color: #00bcd4; /* Primary cyan for heading */
            margin-bottom: 20px;
        }
        .error {
            color: #d32f2f; /* Darker red for error */
            background: #ffe5e5;
            padding: 10px;
            border: 1px solid #ffcccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .success {
            color: #388e3c; /* Dark green for success */
            background: #e6ffed;
            padding: 10px;
            border: 1px solid #b7ffcd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #00bcd4; /* Primary cyan for link */
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hapus Penulis</h1>
        <?php if (!empty($error)): ?>
            <div class="error"> <?= $error ?> </div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="success"> <?= $success ?> </div>
        <?php endif; ?>
        <a href="penulis.php">Kembali ke Daftar Penulis</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
