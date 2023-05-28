
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="user_style.css">
</head>
 <!---------------- HEADER ---------------->
 <form action="" method="post" id="my form">
        <header class="header" id="header">
            <nav class="nav container">
                <div class="nav__logo">
                    <img src="../asset/logo.png"  >
                </div>
                <div class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item">
                            <a href="userhome.php" class="nav__link">Home</a>
                        </li>
                        <li class="nav__item">
                            <a href="#" class="nav__link">Flowers</a>
                        </li>
                        <li class="nav__item">
                            <a href="#" class="nav__link">Payment</a>
                        </li>
                        <li class="nav__item">
                            <a href="#" class="nav__link">Contact</a>
                        </li>
                    </ul>
                </div>

                <div class="nav__icon">
                    <i class="ri-user-fill" onclick="toggleMenu()"></i>
                </div>
            </nav>
            <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            
                            <h2>Haloo </h2>
                        </div>
                        <hr>

                        <ul class="sub__list">
                            <li class="sub__item">
                                <a href="userProfile.php">
                                <div class="item">
                                    <i class="ri-user-line"></i>
                                    <p>Profile</p>
                                </div>
                                </a>
                            </li>
                            <li class="sub__item">
                                <a href="#">
                                <div class="item">
                                    <i class="ri-store-2-line"></i><p>Mitra</p>
                                </div>    
                                </a>
                            </li>
                            <li class="sub__item">
                                <a href="#">
                                <div class="item">
                                    <i class="ri-settings-3-line"></i><p>Setting</p>
                                </div>
                                </a>
                            </li>
                            <hr>
                            <li class="sub__item">
                                <a href="../logoutUser.php">
                                <div class="item_logout">
                                    <i class="ri-login-box-line"></i><p>Logout</p>
                                </div>
                                </a>
                            </li>   
                        </ul>
                    </div>
                </div>
        </header>

        <script>
            let subMenu = document.getElementById("subMenu");
            function toggleMenu(){
                subMenu.classList.toggle("open-menu")
            }
            // Mengambil data pengguna melalui API dengan menggunakan JavaScript (fetch)
            fetch('../api/userSign.php')
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Data pengguna tersedia dalam objek data
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        </script>
    </form>