<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
    header("Location: login.php");
    exit();
}

$query = "SELECT id, username, email, active FROM users";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .btn-primary {
            background-color: #007bff;
        }
        .table thead {
            background-color: #007bff;
            color: #ffffff;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        .table tbody tr:nth-child(even) {
            background-color: #ffffff;
        }
        .btn-sm {
            margin-right: 5px;
        }
    </style>
</head>
<body >

            
        

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Daftar Pengguna</h1>
            <a href="tambah_users.php" class="btn btn-primary">Tambah Pengguna</a>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while ($user = $result->fetch(PDO::FETCH_ASSOC)): 
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo ($user['username']); ?></td>
                    <td><?php echo ($user['email']); ?></td>
                    <td>
                        <span class="badge <?php echo $user['active'] ? 'bg-success' : 'bg-secondary'; ?>">
                            <?php echo $user['active'] ? 'Aktif' : 'Tidak Aktif'; ?>
                        </span>
                    </td>
                    <td>
                        <a href="edit_users.php?id=<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="delete_users.php?id=<?php echo $user['id']; ?>" class="btn btn-info btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>    
        </table>

        <a href="home.php" class="btn btn-secondary">Kembali</a>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
