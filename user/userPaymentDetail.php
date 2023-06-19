<?php
session_start();
include 'navbarHome.php';
include '../config/koneksi.php';

if (!isset($_SESSION['user_id'])){
    header('Location: ../loginUser.php');
    exit();
}

if (isset($_GET['id'])) {
    $payment_id = $_GET['id'];

    // Ambil data pembayaran berdasarkan ID pembayaran
    $query = "SELECT pembayaran.id, pembayaran.total_price, pembayaran.quantity, produk.gambar, produk.deskripsi, produk.nama
            FROM pembayaran INNER JOIN produk ON 
            pembayaran.product_id = produk.id 
            WHERE pembayaran.id = $payment_id";
    $result = mysqli_query($conn, $query);
    $payment = mysqli_fetch_assoc($result);

    // Cek apakah data pembayaran ditemukan
    if (!$payment) {
        header('Location: userPayment.php');
        exit();
    }
} else {
    // Jika tidak ada ID pembayaran yang diberikan, alihkan kembali ke halaman pembayaran
    header('Location: userPayment.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="paymentDetail flex container">
        <div class="paymentDetail__box">
            <div class="paymentAtas flex">
                <div class="paymentDetail__left">
                    <img src="../api/upload/<?php echo $payment['gambar']; ?>" alt="">
                </div>
                <div class="paymentDetail__rigth">
                    <div class="pay1">
                        <h2><?php echo $payment['nama']; ?></h2>
                        <p><?php echo $payment['deskripsi']; ?></p>
                    </div>
                    <div class="pay2">
                        <div class="pay2jumlah flex">
                            <h4>Jumlah :  </h4>
                            <p> <?php echo $payment['quantity']; ?></p>
                        </div>
                        <div class="pay2harga flex">
                            <h4>Total Harga :  </h4>
                            <p> Rp <?php echo $payment['total_price']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <form action="" method="post">
            <div class="paymentBawah flex">
                <h2>Formulir Pengiriman</h2>
                <div class="input__box">
                    <i class="ri-user-3-line"></i>
                    <input type="text" name="name" placeholder="Nama Lengkap" id="name" required>
                </div>
                <div class="input__box">
                    <i class="ri-map-pin-line"></i>
                    <input type="text" name="address" id="address"  placeholder="Alamat" rows="4" required>
                </div>
                <div class="inputPayMethod">
                    <label for="payment_method">Metode Pembayaran</label>
                    <select name="payment_method" id="payment_method" required>
                        <option value ="COD">COD</option>
                        <option value="BCA">Bank BCA</option>
                        <option value="BRI">Bank BRI</option>
                    </select>
                </div>
                <button  class="home__in button" type="submit" name="submit" >
                    Bayar
                </button>
            </div>
            </form>
        </div>
    </div>
</body>
</html>