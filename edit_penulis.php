<?php
include 'koneksi.php'; 

$id = $_GET['id'];
$error = '';
$success = '';

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

        $success = "Penulis berhasil diperbarui.";
    }
} catch (PDOException $e) {
    $error = "Error: " . $e->getMessage();
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
            color: #00bcd4; /* Primary cyan for heading */
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
            border-color: #00bcd4; /* Focus border in primary cyan */
            outline: none;
            box-shadow: 0 0 5px rgba(0, 188, 212, 0.5); /* Primary cyan focus shadow */
        }
        button {
            background-color: #00bcd4; /* Primary cyan button */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #008c99; /* Darker cyan on hover */
        }
        .error {
            color: #d32f2f; /* Dark red for error */
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
        .btn-back {
            display: inline-block;
            margin-top: 15px;
            color: #00bcd4; /* Primary cyan for back button */
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
            <?php if (!empty($error)): ?>
                <div class="error"> <?= $error ?> </div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="success"> <?= $success ?> </div>
            <?php endif; ?>
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
