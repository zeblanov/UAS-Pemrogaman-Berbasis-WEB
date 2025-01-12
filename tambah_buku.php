<?php
session_start();
include 'koneksi.php';

if(!$_SESSION['isLoggedIn'])
{
    header("Location: login.php");

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis']; 
    $tahun = $_POST['tahun'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    $dbh = $koneksi->prepare("INSERT INTO buku (judul, penulis, tahun, created_at, updated_at) VALUES (?, ?, ?, ?, ?)");
   $executeResult= $dbh->execute([$judul, $penulis, $tahun, $created_at, $updated_at]);

    if ($executeResult) {
        header("Location: buku2.php");
        exit();
    } else {
        echo "Terjadi Kesalahan saat menambahkan buku.";   
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Buku</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <select id="penulis" name="penulis" class="form-control" required>
            </div>      
            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun" name="tahun" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="home2.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
