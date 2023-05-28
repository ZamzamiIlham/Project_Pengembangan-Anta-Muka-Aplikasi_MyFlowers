<?php 
include 'sidenav.php'; 
$url = 'http://localhost/JWT_PAA/api/Usersign.php';
$customers = json_decode(file_get_contents($url), true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: black;" class="nav"  >☰ Product</span>
            </div>

            <div class="col-div-6">
                <div class="profile">
                    <img src="../asset/user.png" class="pro-img" />
                    <p>Ilham Zamzami <span>Admin</span></p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="table">
            <table class="table__produk">
                <thead class="table__head">
                    <tr>
                        <th>NOMER</th>
                        <th>USERNAME</th>
                        <th>EMAIL</th>
                        <th>PASSWORD</th>
                        <th>EDIT</th>
                        <th>HAPUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $nomer = 1;
                    foreach ($customers as $customer)
                    :?>
                    <tr>
                        <td class="td"><?php echo $nomer++; ?></td>
                        <td class="td"><?php echo $customer['nama']; ?></td>
                        <td class="td"><?php echo $customer['email']; ?></td>
                        <td class="td"><?php echo $customer['password']; ?></td>
                        <td class="td-1">Edit</a></td>
                        <td class="td-1">Hapus</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>