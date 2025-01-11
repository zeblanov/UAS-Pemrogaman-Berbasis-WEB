<?php
include 'koneksi.php'; 
$id = $_GET['id'];

try {
    $dbh = $koneksi->prepare("DELETE FROM penulis WHERE id = ?");
    $dbh->execute([$id]);

    header("Location: penulis.php");
    exit();
} catch (PDOException $e) {
    echo "Gagal menghapus penulis: " . $e->getMessage();
}
?>
