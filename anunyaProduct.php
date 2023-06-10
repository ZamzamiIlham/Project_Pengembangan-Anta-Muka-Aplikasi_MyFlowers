<?php
// Include file koneksi
include '../config/koneksi.php';

// Mendapatkan data dari tabel "produk"
$sql = "SELECT * FROM produk";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Menampilkan data dalam bentuk tabel
    echo "<table class='table__produk'>
                <thead class='table__head'>
                    <tr>
                        <th>NOMER</th>
                        <th>NAMA</th>
                        <th>STOK</th>
                        <th>HARGA</th>
                        <th>DEKSRIPSI</th>
                        <th>GAMBAR</th>
                        <th>EDIT</th>
                        <th>HAPUS</th>
                    </tr>;
                </thead>";

    while ($row = $result->fetch_assoc()) {
        $nomer =1;
        echo "<tr>
                <td class='td'>" . $nomer++ . "</td>
                <td class='td'>" . $row['nama'] . "</td>
                <td>" . $row['harga'] . "</td>
                <td>" . $row['stok'] . "</td>
                <td>" . $row['deskripsi'] . "</td>
                <td><img src='../api/upload/" . $row['gambar'] . "' width='100'></td>
                <td class='td-1'>
                    <a href='edit.php?id=" . $row['id'] . "'>Edit</a>
                </td>
                <td class='td-1'>
                    <a href='delete.php?id=" . $row['id'] . "'>Hapus</a>
                </td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data.";
}

// Menutup koneksi
$conn->close();
?>



<!---------------------------------->
<div class="table">
            <table class="table__produk" id="produkTable">
                <thead class="table__head">
                    <tr>
                        <th>NOMER</th>
                        <th>NAMA</th>
                        <th>STOK</th>
                        <th>HARGA</th>
                        <th>DEKSRIPSI</th>
                        <th>GAMBAR</th>
                        <th>EDIT</th>
                        <th>HAPUS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomer= 1;
                    foreach ($products as $product)
                    :?>
                    <tr>
                        <td class="td"><?php echo $nomer++; ?></td>
                        <td class="td"><?php echo $product['nama']; ?></td>
                        <td class="td"><?php echo $product['stok']; ?></td>
                        <td class="td"><?php echo $product['harga']; ?></td>
                        <td class="td"><?php echo $product['deskripsi']; ?></td>
                        <td class="td"><?php echo '<img src="../api/upload/"' . $product['gambar'] . '" width="100" height="100">'; ?></td>
                        <td class="td-1"><a href="productEdit.php?id=<?php echo $product['id']; ?>">Edit</a></td>
                        <td class="td-1"><a href="productDelete.php?id=<?php echo $product['id']; ?>">Hapus</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>