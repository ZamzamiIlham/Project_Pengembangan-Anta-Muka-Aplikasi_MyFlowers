<?php
include 'sidenav.php'; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari form
    $namaBank = $_POST['namaBank'];
    $nomerRekening = $_POST['nomerRekening'];

    // Mengirim permintaan POST ke API untuk menambahkan produk baru
    $url = 'http://localhost/JWT_PAA/api/adminRekening.php';
    $data = [
        'namaBank' => $namaBank,
        'nomerRekening' => $nomerRekening
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
    header('Location: rekening.php');
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
                    <input type="text" name="namaBank" id="name"><br><br>
                </div>
                <div class="formAdd">
                    <label for="stock">No Rekening:</label>
                    <input type="text" name="nomerRekening" id="noRekening"><br><br>
                </div>
                <div class="formAdd2">
                    <input class="log__in button"type="submit" value="Simpan">
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>