<?php
session_start();
include 'koneksi.php';

if(!$_SESSION['isLoggedIn'])
{
    header("Location: login.php");

}

$query = $koneksi->prepare("SELECT * FROM penulis");
$query->execute();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $tahun = $_POST['tahun'];
    $id_penulis = $_POST['id_penulis']; 
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    if ($id_penulis === '') {
        echo "<script>alert('Penulis harus dipilih!');</script>";
    } else {
        $query = $koneksi->prepare("INSERT INTO buku (judul, tahun, id_penulis, created_at, updated_at) VALUES (?, ?, ?, ?, ?)");
        $query->execute([$judul, $tahun, $id_penulis, $created_at, $updated_at]);
        
        header("Location: buku.php");
        exit();
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
                <label for="id_penulis" class="form-label">Penulis</label>
                <select id="id_penulis" name="id_penulis" class="form-control" required>
                    <option value="">Pilih Penulis</option>
                    <?php 
                    
                    while ($p = $query->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <option value="<?= $p['id']; ?>"><?= $p['nama']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun" name="tahun" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="buku.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
