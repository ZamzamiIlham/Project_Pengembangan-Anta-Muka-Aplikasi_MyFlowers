<?php
session_start(); // Memulai session

// Menghapus semua data session
session_unset();
session_destroy();
header('Cache-Control: no-store, no-cache, must-revalidate');

// Mengarahkan pengguna ke halaman login atau halaman utama setelah logout
header('Location: loginUser.php'); // Ganti dengan halaman yang sesuai
exit();
?>
