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
            background-color: aliceblue; /* Abu-abu muda */
        }

        h1 {
            color: #3498db; /* Biru */
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
            background-color: #3498db;
            color: white;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }

        .table {
            background-color: white;
        }

        .table th {
            background-color: #3498db; /* Header biru */
            color: white;
        }

        .table td {
            background-color: #e9ecef; /* Baris abu-abu terang */
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
    </style>
</head>
<body>
    <div class="container mt-5">
       

        <div class="form-container mb-4">
            <table class="table table-bordered">
                <thead>
                <h1>Daftar Penulis</h1>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)): 
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td>
                                <a href="edit_penulis.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete_penulis.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
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
