<?php

session_start();
include 'navbarHome.php'; 
if (!isset($_SESSION['user_id'])) {
    // Jika tidak, mengarahkan pengguna kembali ke halaman login
    header('Location: ../loginUser.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="user_style.css">
    <!--AJAX-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Mengambil data pengguna melalui API
            $.ajax({
                url: '../api/UserAccount.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Mengisi konten dengan data pengguna
                        var user = response.user;
                        $('#username').text(user.nama);
                        $('#alamat').text(user.alamat);
                        $('#email').text(user.email);
                        $('#password').text(user.password);
                    } else {
                        // Menampilkan pesan error jika terjadi masalah
                        alert(response.message);
                    }
                },
                error: function() {
                    // Menampilkan pesan error jika terjadi kesalahan AJAX
                    alert('Terjadi kesalahan saat memuat data pengguna.');
                }
                
            });
            
        });
    </script>
</head>
<body>
    <div class="account flex container">
        <i class="ri-shield-user-line"></i>
        <div class="account__info grid">
            <div class="account__left">
                <p>nama</p>
                <p>alamat</p>
                <p>Email</p>
                <p>Password</p>
            </div>
        
            <div class="account__right">
                <p id="username"></p>
                <p id="alamat"></p>
                <p id="email"></p>
                <p id="password"></p>
            </div>
        </div>
        <button  onclick="location.href = 'userProfileEdit.php';" class="home__in button" type="submit" name="submit">
            Edit
        </button>
       
    </div>
</body>
</html>

