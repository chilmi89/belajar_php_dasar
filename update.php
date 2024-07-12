<?php
require "function.php"; // Include the function definitions

$id = $_GET["id"];

$mhs = query("SELECT * FROM mahasiswa WHERE id_mhs =$id")[0];
if(isset($_POST['submit'])) {
    if (update_Data($_POST)) {
        echo "<script>alert('Data Berhasil'); document.location.href = 'index.php';</script>";
    } else {
        echo "Data gagal ditambahkan";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>update Data Mahasiswa</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mt-5">
                    <div class="card-header bg-danger text-white">
                        <h3>Update Data Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                        <form action="update.php" method="POST">
                            <div class="form-group">
                                <label for="id">id</label>
                                <input type="text" class="form-control" id="id" name="id" required value="<?= $mhs['id_mhs'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="nama_mhs">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" required value="<?= $mhs['nama_mhs'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="npm">NPM</label>
                                <input type="text" class="form-control" id="npm" name="npm" required value="<?= $mhs['npm'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required value="<?= $mhs['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" required><?= $mhs['alamat'] ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
