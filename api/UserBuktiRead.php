<?php
// Include file koneksi
include '../config/koneksi.php';

// Mendapatkan data produk dari database
$sql = "SELECT bukti.id, bukti.gambar, bukti.payment_method,
        pembayaran.quantity, pembayaran.total_price,
        produk.nama, users.nama AS nama_user
        FROM bukti
        INNER JOIN pembayaran ON bukti.pembayaran_id = pembayaran.id
        INNER JOIN produk ON pembayaran.product_id = produk.id
        INNER JOIN users ON pembayaran.user_id = users.id
        ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Mengirim data sebagai respons
    echo json_encode($data);
} else {
    echo "Tidak ada data produk.";
}

// Menutup koneksi
$conn->close();
?>
