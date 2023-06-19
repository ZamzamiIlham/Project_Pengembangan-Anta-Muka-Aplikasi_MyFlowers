<?php
session_start();
include 'navbarHome.php'; 
include '../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    // Jika tidak, mengarahkan pengguna kembali ke halaman login
    header('Location: ../loginUser.php');
    exit();
}

// Ambil ID pengguna yang login
$user_id = $_SESSION['user_id'];

// Ambil data pembayaran berdasarkan ID pengguna
$query = "SELECT pembayaran.id, pembayaran.total_price, produk.gambar, produk.deskripsi, produk.nama FROM pembayaran INNER JOIN produk ON pembayaran.product_id = produk.id WHERE pembayaran.user_id = $user_id";
$result = mysqli_query($conn, $query);

// Menghapus data pembayaran
if (isset($_GET['id'])) {
    $payment_id = $_GET['id'];

    $delete_query = "DELETE FROM pembayaran WHERE id = $payment_id";
    $delete_result = mysqli_query($conn, $delete_query);

    if ($delete_result) {
        // Data berhasil dihapus, lakukan pengalihan halaman kembali ke halaman pembayaran
        header('Location: userProduct.php');
        exit();
    }
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
    <div class="payment container">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <a href="userPaymentDetail.php?id=<?php echo $row['id']; ?>">
                <div class="payment__box flex">
                    <div class="payment__left">
                        <div class="payment__img">
                            <img src="../api/upload/<?php echo $row['gambar']; ?>" alt="">
                        </div>
                        <div class="payment__desc">
                            <h4><?php echo $row['nama']; ?></h4>
                            <p><?php echo $row['deskripsi']; ?></p>
                        </div>
                    </div>
                    <div class="payment__right">
                        <h4>Total</h4>
                        <p>Rp <?php echo $row['total_price']; ?></p>
                        <a href="userPayment.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data pembayaran ini?')">Hapus</a>
                    </div>
                </div>
            </a>
        <?php endwhile; ?>
    </div>
</body>
</html>
