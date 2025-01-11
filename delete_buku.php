<?php
session_start();
include 'koneksi.php'; 

if(!$_SESSION['isLoggedIn'])
{
    header("Location: login.php");

}
if (isset($_GET['id'])) {
    $id_buku = $_GET['id'];

    $query = $koneksi->prepare("DELETE FROM buku WHERE id = ?");
    $query->execute([$id_buku]);

    header("Location: buku.php");
    exit();
} else {
    echo "ID buku tidak ditemukan!";
    exit();
}
?>
