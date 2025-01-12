<?php
session_start();
if(!$_SESSION['isLoggedIn'])
{
    header("Location: login.php");

}
echo "Selamat datang, ",$_SESSION ['username'];

include 'koneksi.php'; 
$dbh = "SELECT * FROM buku WHERE isdel = 0";
$dbh = $koneksi->prepare($query);
$dbh->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar a {
            color: #fff;
        }
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 30px;
        }
        .table th, .table td {
            text-align: center;
        }
        .btn-custom {
            background-color: #007bff;
            color: white;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            color: white;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .card-body {
            padding: 15px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">Perpustakaan Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="penulis.php">Penulis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">Users</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link btn btn-danger" href="logout.php">Logout</a>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    <section id="hero" class="text-center p-5 bg-primary">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="fw-bold display-4 text-black">Welcome to the library website</h1>
                <h4 class="lead display-6 text-black">Temukan koleksi Buku kami</h4>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <img src="https://img2.storyblok.com/1200x600/filters:focal(603x501:604x502):quality(90)/f/60990/1200x666/34093b645f/perpustakaan.jpg" alt="Gambar Perpustakaan" class="img-fluid">
            </div>
        </div>
    </div>
</section>
<div class="container">
    <h1 class="my-4">Daftar Buku</h1>
    <a href="tambah_buku.php" class="btn btn-primary mb-3">Tambah Buku</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Tahun Terbit</th>
                <th colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $index = 1; // Initialize book number
            while ($row = $dbh->fetch(PDO::FETCH_ASSOC)): // Loop through each row
            ?>
            <tr>
                <td><?php echo $index++; ?></td>
                <td><?php echo $row['judul']; ?></td>
                <td><?php echo isset($row['penulis']) ? $row['penulis'] : 'Penulis tidak tersedia'; ?></td>
                <td><?php echo $row['tahun']; ?></td>
                <td>
                    <a href="edit_buku.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_buku.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>