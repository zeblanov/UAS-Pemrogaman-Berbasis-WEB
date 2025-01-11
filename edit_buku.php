<?php
session_start();
include 'koneksi.php'; 

if(!$_SESSION['isLoggedIn']) {
    header("Location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_buku = $_POST['id_buku'];
    $judul = $_POST['judul'];
    $tahun = $_POST['tahun'];
    $id_penulis = $_POST['id_penulis']; 
    $updated_at = date('Y-m-d H:i:s');
    
    $query = $koneksi->prepare("UPDATE buku SET judul = ?, tahun = ?, id_penulis = ?, updated_at = ? WHERE id = ?");
    $query->execute([$judul, $tahun, $id_penulis, $updated_at, $id_buku]);
    
    header("Location: buku.php");
    exit();
}

$id_buku = $_GET['id'];
$query = $koneksi->prepare("SELECT buku.id, buku.judul, buku.tahun, buku.id_penulis, penulis.nama FROM buku JOIN penulis ON buku.id_penulis = penulis.id WHERE buku.id = ?");
$query->execute([$id_buku]);
$book = $query->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    echo "Buku tidak ditemukan!";
    exit();
}

$penulisQuery = $koneksi->prepare("SELECT id, nama FROM penulis");
$penulisQuery->execute();
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
                <label for="tahun" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun" name="tahun" value="<?php echo $book['tahun']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="id_penulis" class="form-label">Penulis</label>
                <select class="form-select" id="id_penulis" name="id_penulis" required>
                    <option value="">Pilih Penulis</option>
                    <?php 

                    while ($penulis = $penulisQuery->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <option value="<?= $penulis['id']; ?>" <?php echo $penulis['id'] == $book['id_penulis'] ? 'selected' : ''; ?>>
                            <?= $penulis['nama']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="buku.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
