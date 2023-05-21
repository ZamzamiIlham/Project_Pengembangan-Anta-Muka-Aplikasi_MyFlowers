<?php

include 'sidenav.php'; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari form
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $stok = $_POST['stok'];
    $harga = $_POST['price'];

    // Mengirim permintaan PUT ke API untuk memperbarui data produk
    $url = 'http://localhost/JWT_PAA/api/productAdmin.php';
    $data = [
        'id' => $id,
        'nama' => $nama,
        'stok' => $stok,
        'harga' => $harga
    ];

    $options = [
        'http' => [
            'method' => 'PUT',
            'header' => 'Content-Type: application/json',
            'content' => json_encode($data)
        ]
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    // Redirect kembali ke halaman utama setelah berhasil memperbarui produk
    header('Location: product.php');
    exit();
} else {
    // Mendapatkan ID produk dari parameter URL
    $id = $_GET['id'];

    // Mendapatkan data produk dari API berdasarkan ID
    $url = 'http://localhost/JWT_PAA/api/productAdmin.php?id='. $id; 
    $product = json_decode(file_get_contents($url), true);

    // Jika produk tidak ditemukan, kembalikan ke halaman utama
    if (empty($product)) {
        header('Location: product.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>
    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: black;" class="nav"  >☰ Edit Product</span>
            </div>

            <div class="col-div-6">
                <div class="profile">
                    <img src="../asset/user.png" class="pro-img" />
                    <p>Ilham Zamzami <span>Admin</span></p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="addProduct flex">
        <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo isset($product['id']) ? $product['id'] : ''; ?>">
            <div class="formAdd">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" value="<?php echo isset($product['nama']) ? $product['nama'] : ''; ?>"><br><br>
            </div>
            <div class="formAdd">
            <label for="stok">Stok:</label>
            <input type="number" name="stok" id="stok" value="<?php echo isset($product['stok']) ? $product['stok'] : ''; ?>"><br><br>
            </div>
            <div class="formAdd">
            <label for="harga">Harga:</label>
            <input type="number" name="harga" id="harga" value="<?php echo isset($product['harga']) ? $product['harga'] : ''; ?>"><br><br>
            </div>
            <div class="formAdd2">
            <input class="log__in button" type="submit" value="Simpan">
            </div>
        </form>
    </div>
</body>
</html>
