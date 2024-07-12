<?php
// Set header untuk mengindikasikan bahwa respons adalah JSON
header('Content-Type: application/json');

try {
    // Import function.php, pastikan path-nya benar
    require "../function.php";

    // Tentukan jumlah data per halaman
    $jumlahDataPerHalaman = 5;

    // Tangkap keyword dari request POST, pastikan menggunakan filter_input untuk keamanan
    $keyword = filter_input(INPUT_POST, 'keyword', FILTER_SANITIZE_STRING);

    // Validasi keyword
    // Query pencarian data mahasiswa
    $query = "SELECT * FROM mahasiswa WHERE 
    nama_mhs LIKE '%$keyword%' OR 
    npm LIKE '%$keyword%' OR
    email LIKE '%$keyword%' OR
    alamat LIKE '%$keyword%'";

    // Bind parameter
    $params = array("%$keyword%", "%$keyword%", "%$keyword%", "%$keyword%");
    $mahasiswa = query($query, $params);

    // Menghitung jumlah data hasil pencarian
    $jumlahData = count($mahasiswa);

    // Hitung jumlah halaman
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

    // Ambil halaman aktif dari request POST, default ke halaman 1
    $halamanAktif = filter_input(INPUT_POST, 'halaman', FILTER_VALIDATE_INT, array('options' => array('default' => 1)));

    // Offset data
    $offset = ($halamanAktif - 1) * $jumlahDataPerHalaman;

    // Ambil data sesuai halaman
    $mahasiswa = array_slice($mahasiswa, $offset, $jumlahDataPerHalaman);

    // Mengembalikan data dalam format JSON
    $response = array(
        'status' => 'success',
        'data' => $mahasiswa,
        'jumlahHalaman' => $jumlahHalaman,
        'halamanAktif' => $halamanAktif
    );
} catch (Exception $e) {
    // Jika terjadi error, tangkap pesan error
    $response = array(
        'status' => 'error',
        'message' => $e->getMessage()
    );
}

// Mengeluarkan respons dalam format JSON
echo json_encode($response);
?>
