<?php
session_start();
include 'navbarHome.php'; 
if (!isset($_SESSION['user_id'])) {
    // Jika tidak, mengarahkan pengguna kembali ke halaman login
    header('Location: ../loginUser.php');
    exit();
}

// Ambil data produk dari API atau database
$url = 'http://localhost/JWT_PAA/api/Adminproductread.php';
$products = json_decode(file_get_contents($url), true);
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<body>
    <div class="card__container">
        <div class="card__grid">
            <?php foreach ($products as $product) : ?>
                <div class="card">
                    <img src="../api/upload/<?php echo $product['gambar']; ?>" alt="" class="card_img">
                    <div class="card_data">
                        <h1 class="card_title"><?php echo $product['nama']; ?></h1>
                        <span class="card_price">Rp.<?php echo $product['harga']; ?></span>
                        <p class="card_description"><?php echo $product['deskripsi']; ?>
                        <input class="card_number" type="number" id="quantity_<?php echo $product['id']; ?>" min="1" value="1"></p>
                        <a href="#" class="card_button" data-productid="<?php echo $product['id']; ?>" onclick="processPayment(<?php echo $product['id']; ?>)">Buy Now</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
    function processPayment(productID) {
        var userID = <?php echo $_SESSION['user_id']; ?>; // Mendapatkan user_id dari session PHP
        var quantity = $("#quantity_" + productID).val(); // Mendapatkan nilai jumlah barang yang ingin dibeli

        // Mengalikan harga dengan jumlah barang yang dibeli
        var totalPrice = <?php echo $product['harga']; ?> * quantity * 2;

        // Kirim permintaan POST ke Pembayaranproduct.php menggunakan AJAX
        $.ajax({
            url: "http://localhost/JWT_PAA/api/Pembayaranproduct.php",
            type: "POST",
            data: { product_id: productID, user_id: userID, quantity: quantity, total_price: totalPrice },
            success: function (response) {
                alert(response); 
            },
            error: function () {
                alert("Terjadi kesalahan saat memproses pembayaran.");
            }
        });
    }
    </script>

</body>
