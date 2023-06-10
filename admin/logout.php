<?php
// Menghapus cookie dengan nama SET_COOKIES
setcookie('SET_COOKIES', '', time() - 3600, '/');
// Redirect ke halaman login atau halaman lain yang sesuai setelah logout
header('Location: login.php'); // Ubah "login.php" dengan halaman yang sesuai
?>
