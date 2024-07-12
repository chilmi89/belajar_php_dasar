<?php
require "function.php"; // Include the function definitions

if(isset($_POST['submit'])) {
    if (tambah_data($_POST)) {
        // echo "<script>alert('Data Berhasil'); document.location.href = 'index.php';</script>";
        header("location: index.php");
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
    <title>Tambah Data Mahasiswa</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mt-5">
                    <div class="card-header bg-success text-white">
                        <h3>Tambah Data Mahasiswa</h3>
                    </div>
                    <div class="card-body">
                        <form action="insert.php" method="POST">
                            <div class="form-group">
                                <label for="nama_mhs">Nama Mahasiswa</label>
                                <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" required>
                            </div>
                            <div class="form-group">
                                <label for="npm">NPM</label>
                                <input type="text" class="form-control" id="npm" name="npm" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" required></textarea>
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
