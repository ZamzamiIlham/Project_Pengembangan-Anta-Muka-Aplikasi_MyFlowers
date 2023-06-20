<?php
// Include file koneksi
include '../config/koneksi.php';

// Memeriksa apakah ada file yang diunggah dan ID pembayaran diberikan
if (isset($_FILES['gambar']) && isset($_POST['payment_id']) && isset($_POST['payment_method'])) {
    $file = $_FILES['gambar'];
    $payment_id = $_POST['payment_id'];
    $payment_method = $_POST['payment_method'];

    // Mengambil informasi file
    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Memeriksa apakah file berhasil diunggah
    if ($fileError === 0) {
        // Memindahkan file ke folder tujuan
        $uploadDir = 'bukti/';
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($fileTmp, $targetFile)) {
            // Menyimpan data ke database
            $sql = "INSERT INTO bukti (pembayaran_id, gambar, payment_method) VALUES ('$payment_id', '$fileName', '$payment_method')";

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
    echo "Tidak ada file yang diunggah atau ID pembayaran tidak diberikan.";
}

// Menutup koneksi
$conn->close();
?>
