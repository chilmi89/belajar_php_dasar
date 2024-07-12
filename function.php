<?php
// koneksi ke db
$db = mysqli_connect("localhost", "root", "", "db_mhs");

// cek koneksi
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);

    if (!$result) {
        // Query failed, handle the error
        echo "Error executing query: " . mysqli_error($db);
        return []; // Return empty array or handle differently based on your application
    }

    // Fetch all rows into an associative array
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    // Free result set
    mysqli_free_result($result);

    return $rows;
}

function tambah_data($data)
{
    global $db;
    $nama_mhs = htmlspecialchars($data['nama_mhs']);
    $npm = htmlspecialchars($data['npm']);
    $email = htmlspecialchars($data['email']);
    $alamat = htmlspecialchars($data['alamat']);
    $query = "INSERT INTO mahasiswa (nama_mhs, npm, email, alamat) 
              VALUES ('$nama_mhs', '$npm', '$email', '$alamat')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function hapus_Data($id)
{
    global $db;
    mysqli_query($db, "DELETE FROM mahasiswa WHERE id_mhs = $id");
    return mysqli_affected_rows($db);
}


function update_Data($data)
{

    global $db;
    $id = $data["id"];
    $nama_mhs = htmlspecialchars($data['nama_mhs']);
    $npm = htmlspecialchars($data['npm']);
    $email = htmlspecialchars($data['email']);
    $alamat = htmlspecialchars($data['alamat']);
    $query = "UPDATE mahasiswa SET 
    nama_mhs = '$nama_mhs',
     npm = '$npm', 
     email = '$email', 
     alamat = '$alamat' 
     WHERE 
     id_mhs = $id";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function search($keyword) {
    global $db;
    $keyword = mysqli_real_escape_string($db, $keyword);
    $query = "SELECT * FROM mahasiswa WHERE 
              nama_mhs LIKE '%$keyword%' OR 
              npm LIKE '%$keyword%' OR
              email LIKE '%$keyword%' OR
              alamat LIKE '%$keyword%'";
    return query($query);
}