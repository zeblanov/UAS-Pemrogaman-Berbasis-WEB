<?php
include 'koneksi.php';

// Ambil semua data penulis
$query = $koneksi->prepare("SELECT * FROM penulis ORDER BY id ASC");
$query->execute();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penulis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e1f5fe; /* Light cyan background */
        }

        h1 {
            color: #00bcd4; /* Primary cyan */
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #00bcd4; /* Primary cyan button */
            color: white;
            border: none;
        }
        .btn-primary:hover {
            background-color: #008c99; /* Darker cyan on hover */
        }

        .table {
            background-color: white;
        }

        .table th {
            background-color: #00bcd4; /* Header primary cyan */
            color: white;
        }

        .table td {
            background-color: #e9ecef; /* Light gray background for rows */
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-warning {
            background-color: #ffc107;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .card-columns {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .card-body {
            background-color: #ffffff;
        }

        .card-title {
            color: #00bcd4;
            font-size: 1.25rem;
        }

        .card-text {
            color: #555;
        }

        .card-footer {
            background-color: transparent;
            border-top: 1px solid #e1e1e1;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container mb-4">
            <h1>Daftar Penulis</h1>
            <div class="card-columns">
                <?php 
                while ($row = $query->fetch(PDO::FETCH_ASSOC)): 
                ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($row['nama']); ?></h5>
                            <p class="card-text"><?= htmlspecialchars($row['email']); ?></p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="edit_penulis.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_penulis.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Tombol di bawah untuk tambah penulis dan kembali ke home -->
        <div class="btn-group mt-3">
            <a href="add_penulis.php" class="btn btn-primary">Tambah Penulis</a>
            <a href="home.php" class="btn btn-primary">Kembali ke Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
