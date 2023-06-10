<?php
// Include file koneksi
include '../config/koneksi.php';

// Memeriksa apakah ada file yang diunggah
if (isset($_FILES['gambar'])) {
    $file = $_FILES['gambar'];

    // Mengambil informasi file
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Memeriksa apakah file berhasil diunggah
    if ($fileError === 0) {
        // Memindahkan file ke folder tujuan
        $uploadDir = 'upload/';
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($fileTmp, $targetFile)) {
            // Mengambil data lain dari form
            $nama = $_POST['nama'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $deskripsi = $_POST['deskripsi'];

            // Menyimpan data ke database
            $sql = "INSERT INTO produk (nama, harga, stok, deskripsi, gambar) VALUES ('$nama', '$harga', '$stok', '$deskripsi', '$fileName')";

            if ($conn->query($sql) === TRUE) {
                echo "Unggah gambar berhasil.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error saat mengunggah gambar.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }
} else {
    echo "Tidak ada file yang diunggah.";
}

// Menutup koneksi
$conn->close();
?>

