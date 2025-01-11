<?php
session_start();  
include 'koneksi.php'; 
if (!$_SESSION['isLoggedIn']) 
{
    header("Location: login.php");
}
$query = $koneksi->prepare("SELECT buku.*, penulis.nama FROM buku JOIN penulis ON buku.id_penulis = penulis.id");
$query->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Daftar Buku</h1>
        <a href="tambah_buku.php" class="btn btn-success mb-3">Tambah Buku</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tahun</th>
                    <th>Penulis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no =1;
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?= $no++;; ?></td>
                        <td><?= $row['judul']; ?></td>
                        <td><?= $row['tahun']; ?></td>
                        <td><?= $row['nama'] ?? 'Tidak diketahui'; ?></td> 
                        <td>
                            <a href="edit_buku.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_buku.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda ingin menghapus data ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
