<?php
include "koneksi.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Siapkan query dengan placeholder
    $dbh = $koneksi->prepare("SELECT * FROM users WHERE email = :email");
    $dbh->execute(['email' => $email]);

    // Periksa apakah pengguna ditemukan
    if ($dbh->rowCount() === 1) {
        $user = $dbh->fetch(PDO::FETCH_ASSOC);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['email'] = $user['email']; 
            header("Location: home.php");
            exit();
        } else {
            echo "Email atau password salah.";
        }
    } else {
        echo "User tidak ditemukan.";
    }
} else {
    echo "Invalid request.";
}
?>