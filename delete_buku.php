<?php
session_start();
include 'koneksi.php'; 

if(!$_SESSION['isLoggedIn'])
{
    header("Location: login.php");
    exit();
}
    $id_buku = $_GET['id'];

    $dbh = $koneksi->prepare("UPDATE buku SET isdel = ?, deleted_by = ?, deleted_at = ? WHERE id = ?");
    $dbh->execute([
        1,
        $_SESSION['username'],
        date("Y-m-d H:i:s"),
        $id]);

    header("Location: home.php");
    exit();

?>
