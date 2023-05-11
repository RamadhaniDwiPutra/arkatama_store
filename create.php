<!DOCTYPE html>
<html>
<head>
    <title>Form Users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['avatar'])) {

        $name=input($_POST["name"]);
        $email=input($_POST["email"]);
        $phone=input($_POST["phone"]);
        $role=input($_POST["role"]);
        $address=input($_POST["address"]);
        $avatar=$_FILES["avatar"]["name"];
        $tmp=$_FILES["avatar"]["tmp_name"];

        // Set path folder tempat menyimpan gambarnya
        $path = "uploads/".$avatar;

        // Cek apakah tipe file yang diupload adalah JPEG / JPG / PNG
        $allowed = array('jpeg', 'jpg', 'png');
        $filename = $_FILES['avatar']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!in_array($ext, $allowed)) {
            echo "<div class='alert alert-danger'>Format file tidak didukung.</div>";
        } else {
            // Pindahkan file gambar ke folder uploads
            move_uploaded_file($tmp, $path);

            //Query input menginput data kedalam tabel anggota
            $sql="insert into users (name,email,phone,role,address,avatar) values
		('$name','$email','$phone','$role','$address','$avatar')";

            //Mengeksekusi/menjalankan query diatas
            $hasil=mysqli_query($kon,$sql);

            //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
            if ($hasil) {
                header("Location:index.php");
            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
            }
        }
    }
    ?>
    <h2>Tambah Pengguna</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" placeholder="Masukan Nama" required />
    </div>
    <div class="form-group">
        <label>Email:</label>
        <input type="text" name="email" class="form-control" placeholder="Masukan Email" required/>
    </div>
    <div class="form-group">
        <label>Phone:</label>
        <input type="text" name="phone" class="form-control" placeholder="Masukan Phone" required/>
    </div>
    <div class="form-group">
        <label>Role:</label>
        <select type="text" name="role" class="form-control" placeholder="Masukan Role" required>
            <option value="">Pilih Role Penggunaan</option>
            <option value="Admin">Admin</option>
            <option value="Staff">Staff</option>
        </select>
    </div>
    <div class="form-group">
        <label>Address:</label>
        <textarea name="address" class="form-control" rows="5" placeholder="Masukan Alamat" required></textarea>
    </div>
    <div class="form-group">
        <label>Avatar:</label>
        <input type="file" name="avatar" class="form-control" placeholder="Masukan Avatar" required/>
    </div>     
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>

</div>
</body>
</html>