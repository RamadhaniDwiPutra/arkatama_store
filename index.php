<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<title>
    Ramadhani</title>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Ramadhani Dwi Putra</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>DATA PENGGUNA</center></h4>
        <?php
        include "koneksi.php";

        //Cek apakah ada kiriman form dari method post
        if (isset($_GET['id_users'])) {
            $id_users=htmlspecialchars($_GET["id_users"]);

            $sql="delete from users where id_users='$id_users' ";
            $hasil=mysqli_query($kon,$sql);

            //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:index.php");
            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
            }
        }
        ?>

        <table class="my-3 table table-bordered">
            <thead>
                <tr class="table-primary">           
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Address</th>
                    <th>Aksi</th>
                    <th>Avatar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql="select * from users order by id_users desc";
                $hasil=mysqli_query($kon,$sql);
                $no=0;
                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
                ?>
                    <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $data["name"]; ?></td>
                        <td><?php echo $data["email"]; ?></td>
                        <td><?php echo $data["phone"]; ?></td>
                        <td><?php echo $data["role"]; ?></td>
                        <td><?php echo $data["address"]; ?></td>
                        <td>
                            <a href="update.php?id_users=<?php echo htmlspecialchars($data['id_users']); ?>" class="btn btn-warning" role="button">Update</a>
                            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_users=<?php echo $data['id_users']; ?>" class="btn btn-danger" role="button">Delete</a>
                        </td>
                        <td><img style="width: 120px;" src="uploads/<?php echo $data["avatar"]; ?>"></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
    </table>
    <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
</div>
</body>
</html>