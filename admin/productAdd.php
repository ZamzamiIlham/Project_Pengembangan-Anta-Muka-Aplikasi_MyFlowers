<?php
include 'sidenav.php'; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari form
    $nama = $_POST['nama'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    // Mengirim permintaan POST ke API untuk menambahkan produk baru
    $url = 'http://localhost/JWT_PAA/api/productAdmin.php';
    $data = [
        'nama' => $nama,
        'stok' => $stok,
        'harga' => $harga
    ];

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    // Redirect kembali ke halaman utama setelah berhasil menambahkan produk
    header('Location: product.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: black;" class="nav"  >☰ Tambah Product</span>
            </div>

            <div class="col-div-6">
                <div class="profile">
                    <img src="../asset/user.png" class="pro-img" />
                    <p>Ilham Zamzami <span>Admin</span></p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="addProduct flex">
            <form method="POST" action="">
                <div class="formAdd">
                    <label for="name">Nama:</label>
                    <input type="text" name="nama" id="name"><br><br>
                </div>
                <div class="formAdd">
                    <label for="stock">Stok:</label>
                    <input type="number" name="stok" id="stok"><br><br>
                </div>
                <div class="formAdd">
                    <label for="price">Harga:</label>
                    <input type="number" name="harga" id="harga"><br><br>
                </div>
                <div class="formAdd2">
                    <input class="log__in button"type="submit" value="Simpan">
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>