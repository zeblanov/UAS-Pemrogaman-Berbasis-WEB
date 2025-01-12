<?php
session_start();
include 'koneksi.php'; 

if(!$_SESSION['isLoggedIn']) {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_buku = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun']; 
    $updated_at = date('Y-m-d H:i:s');
    
    $dbh = $koneksi->prepare("UPDATE buku SET judul = ?,penulis = ? , tahun = ?,updated_at = ? WHERE id = ?");
    $dbh->execute([$judul, $penulis, $tahun, $updated_at, $id_buku]);
    
    header("Location: home2.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_buku = $_GET['id'];

    $dbh = $koneksi->prepare("SELECT id, judul, penulis, tahun FROM buku WHERE id = ?");
    $dbh->execute([$id_buku]);
    $book = $dbh->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        echo "<script>alert('Buku tidak ditemukan!');</script>";
        header("Location: buku2.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Buku</h1>
        <form method="POST">
            <input type="hidden" name="id_buku" value="<?php echo $book['id']; ?>">
            
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $book['judul']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" value="<?php echo $book['penulis']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun" name="tahun" value="<?php echo $book['tahun']; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="home.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
