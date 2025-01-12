<?php
session_start();
session_unset(); // Menghapus semua data sesi
session_destroy();
header("Location: login.php");
exit();
?>
