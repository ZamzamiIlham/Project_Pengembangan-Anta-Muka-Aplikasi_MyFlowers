<?php
// Include file koneksi
include '../config/koneksi.php';

// Mendapatkan data produk dari database
$sql = "SELECT * FROM produk";
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
