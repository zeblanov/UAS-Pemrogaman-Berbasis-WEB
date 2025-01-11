<?php
session_start();
include 'koneksi.php';

if(!$_SESSION['isLoggedIn'])
{
    header("Location: login.php");

}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $active = $_POST['active'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    try {
 
        $dbh = $koneksi->prepare("
            INSERT INTO users (username, email, password, active, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?)
        ");


        $dbh->execute([$username, $email, $password, $active, $created_at, $updated_at]);

        header("Location: users.php");
        exit();
    } catch (PDOException $e) {
        echo "Gagal menambahkan pengguna: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Tambah Pengguna</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="active" class="form-label">Status</label>
                <select class="form-control" id="active" name="active" required>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="users.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
