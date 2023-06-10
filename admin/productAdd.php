<?php
include 'sidenav.php'; 

?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
            <form id="uploadForm" enctype="multipart/form-data">
                <div class="formAdd">
                    <label for="name">Nama:</label>
                    <input type="text" name="nama" id="name"><br><br>
                </div>
                <div class="formAdd">
                    <label for="stock">Stok:</label>
                    <input type="number" name="stok" id="stok"><br><br>
                </div>
                <div class="formAdd">
                    <label for="price">Harga:</label>
                    <input type="number" name="harga" id="harga"><br><br>
                </div>
                <div class="formAdd">
                    <label for="desk">Deskripsi:</label>
                    <input type="text" name="deskripsi" id="deskripsi"><br><br>
                </div>
                <div class="formAdd">
                    <input type="file" name="gambar" required>
                </div>
                <div class="formAdd2">
                    <input class="log__in button"type="submit" value="Simpan">
                </div>
            </form>

            <div id="message"></div>
        </div>
    </div>

    <script>
         $(document).ready(function() {
            $("#uploadForm").on("submit", function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "http://localhost/JWT_PAA/api/Adminproductupload.php",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Menampilkan pesan hasil operasi CRUD
                    $("#message").html(response);

                    // Mengosongkan form setelah unggah berhasil
                    $("#uploadForm")[0].reset();

                    // Menampilkan data terbaru setelah unggah berhasil
                    showData();
                }
            });
        });

         });
    </script>
    
</body>
</html>