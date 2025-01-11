<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $active = $_POST['active'];
    $updated_at = date('Y-m-d H:i:s');

    try {

        $dbh = $koneksi->prepare("UPDATE users SET username = ?, email = ?, active = ?, updated_at = ? WHERE id = ?");
        $dbh->execute([$username, $email, $active, $updated_at, $id_user]);


        header("Location: users.php");
        exit();
    } catch (PDOException $e) {
        echo "Gagal mengupdate pengguna: " . $e->getMessage();
    }
}


$id_user = $_GET['id'];

try {
    $dbh = $koneksi->prepare("SELECT id, username, email, active FROM users WHERE id = ?");
    $dbh->execute([$id_user]);
    $user = $dbh->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "Pengguna tidak ditemukan!";
        exit();
    }
} catch (PDOException $e) {
    echo "Gagal mengambil data pengguna: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Pengguna</h1>
        <form method="POST">
            <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($user['id']); ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="active" class="form-label">Status</label>
                <select class="form-control" id="active" name="active" required>
                    <option value="1" <?php echo ($user['active'] == 1) ? 'selected' : ''; ?>>Aktif</option>
                    <option value="0" <?php echo ($user['active'] == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="users.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
