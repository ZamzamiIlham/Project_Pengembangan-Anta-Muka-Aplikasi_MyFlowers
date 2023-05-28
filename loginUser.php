<?php
session_start();

// Include file koneksi.php
require_once './config/koneksi.php';

// Fungsi untuk membersihkan input dari karakter khusus
function cleanInput($input)
{
    $search = array(
        '@<script[^>]*?>.*?</script>@si',   // Menghapus tag <script>
        '@<[\/\!]*?[^<>]*?>@si',            // Menghapus tag HTML
        '@<style[^>]*?>.*?</style>@siU',    // Menghapus tag <style>
        '@<![\s\S]*?--[ \t\n\r]*>@'         // Menghapus komentar multi-baris
    );

    $output = preg_replace($search, '', $input);
    return $output;
}

// Memeriksa apakah form login telah disubmit
if (isset($_POST['submit'])) {
    // Mendapatkan email dan password dari form login
    $email = cleanInput($_POST['email']);
    $password = cleanInput($_POST['password']);

    // Mengecek keberadaan email dan password dalam database
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Login berhasil, menyimpan data pengguna dalam sesi
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_email'] = $row['email'];

        // Mengarahkan pengguna ke halaman homeUser.php
        header('Location: ./user/userHome.php');
        exit();
    } else {
        // Login gagal, menampilkan pesan kesalahan
        $error = "Email atau password salah.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- CSS-->
    <link rel="stylesheet" href="sign_style.css">
    <!-- REMIX ICON -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
<div class="login__container container">
    <div class="login__left flex">
        <img src="./asset/logo.png" alt="">
        <h1>Flowers Shop</h1>
    </div>
    <div class="login__right flex">
        <div class="lr__header flex">
            <h1>Login</h1>
            <p>Toko bunga terbaik di indonesia</p>
        </div>
        <?php if (isset($error)) { ?>
            <div class="lr__error">
                <p><?php echo $error; ?></p>
            </div>
        <?php } ?>
        <form action="" method="POST">
        <div class="lr__input flex">
            <div class="input__box">
                <i class="ri-mail-line"></i>
                <input type="email" name="email" placeholder="enter your email" required class="box">
            </div>
            <div class="input__box">
                <i class="ri-lock-2-line"></i>
                <input type="password" name="password" placeholder="enter your password" required class="box">
            </div>
            <a href="#" class="forgot">Forgot Password? </a>
            <button  class="log__in button" type="submit" name="submit" >
               Login Now
            </button>
            <div class="text__sign-up">Don't have an account? <a href="registerUser.php" class="reg__now">register now</a></div>
        </div>
        </form>
    </div>
</div> 
</body>
</html>