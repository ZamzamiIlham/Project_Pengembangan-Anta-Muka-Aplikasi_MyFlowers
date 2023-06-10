<?php

include 'sidenav.php'; 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan data dari form
    $id = $_POST['id'];
    $namaBank = $data['namaBank'];
    $nomerRekening = $data ['nomerRekening'];

    // Mengirim permintaan PUT ke API untuk memperbarui data produk
    $url = 'http://localhost/JWT_PAA/api/Adminrekening.php';
    $data = [
        'id' => $id,
        'namaBank' => $namaBank,
        'nomerRekening' => $nomerRekening
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
    header('Location: rekening.php');
    exit();
} else {
    // Mendapatkan ID produk dari parameter URL
    $id = $_GET['id'];

    echo "ID Produk: " . $id;

    // Mendapatkan data produk dari API berdasarkan ID
    $url = 'http://localhost/JWT_PAA/api/Adminrekening.php?id='.$id; 
    $rekening = json_decode(file_get_contents($url), true);

    // Jika produk tidak ditemukan, kembalikan ke halaman utama
    if (empty($rekening)) {
        header('Location: rekening.php');
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
        <input type="hidden" name="id" value="<?php echo isset($rekening['id']) ? $rekening['id'] : ''; ?>">
            <div class="formAdd">
            <label for="namaBank">Nama Rekening:</label>
            <input type="text" name="namaBank" id="namaBank" value="<?php echo isset($rekening['namaBank']) ? $rekening['namaBank'] : ''; ?>"><br><br>
            </div>
            <div class="formAdd">
            <label for="nomerRekening">Nomer Rekening:</label>
            <input type="text" name="nomerRekening" id="nomerRekening" value="<?php echo isset($rekening['nomerRekening']) ? $rekening['nomerRekening'] : ''; ?>"><br><br>
            </div>
            <div class="formAdd2">
            <input class="log__in button" type="submit" value="Simpan">
            </div>
        </form>
    </div>
</body>
</html>