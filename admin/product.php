<?php 
include 'sidenav.php'; 
$url = 'http://localhost/JWT_PAA/api/productAdmin.php';
$products = json_decode(file_get_contents($url), true);
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

        <div class="tambah">
            <a href="productAdd.php" class="tambah__button flex">
                <i class="ri-add-box-fill"></i>
                <p>Tambahkan Produk</p>
            </a>
        </div>

        <div class="table">
            <table class="table__produk">
                <thead class="table__head">
                    <tr>
                        <th>KODE</th>
                        <th>NAMA</th>
                        <th>STOK</th>
                        <th>HARGA</th>
                        <th>EDIT</th>
                        <th>HAPUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product):?>
                    <tr>
                        <td class="td"><?php echo $product['id']; ?></td>
                        <td class="td"><?php echo $product['nama']; ?></td>
                        <td class="td"><?php echo $product['stok']; ?></td>
                        <td class="td"><?php echo $product['harga']; ?></td>
                        <td class="td-1"><a href="productEdit.php?id=<?php echo $product['id']; ?>">Edit</a></td>
                        <td class="td-1"><a href="productDelete.php?id=<?php echo $product['id']; ?>">Hapus</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>