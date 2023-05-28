<?php

session_start();

if (isset($_SESSION['adminLoggedIn'])) {
    // Jika pengguna sudah login, arahkan ke halaman adminHome
    header("Location: home.php");
    exit();
} else {
    // Jika pengguna belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}
?>