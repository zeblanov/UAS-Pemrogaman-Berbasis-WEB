<?php
session_start();
include 'koneksi.php';

if(!$_SESSION['isLoggedIn'])
{
    header("Location: login.php");

}
if (isset($_GET['id'])) {
    $id_user = $_GET['id'];

    try {

        $dbh = $koneksi->prepare("DELETE FROM users WHERE id = ?");
        $dbh->execute([$id_user]);


        header("Location: users.php");
        exit();
    } catch (PDOException $e) {
        echo "Gagal menghapus pengguna: " . $e->getMessage();
        exit();
    }
}

echo "Pengguna tidak ditemukan!";
exit();
