<?php
require "function.php";

// Tentukan jumlah data per halaman
$jumlahDataPerHalaman = 5;

// Halaman aktif (default halaman 1)
$halamanAktif = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;

// Filter pencarian berdasarkan keyword jika ada
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

// Query untuk menghitung jumlah data tanpa filter
$queryJumlahData = "SELECT COUNT(*) AS jumlah FROM mahasiswa";
// Query untuk mencari data dengan filter jika ada keyword
// if (!empty($keyword)) {
//     $queryJumlahData .= " WHERE 
//         nama_mhs LIKE '%$keyword%' OR 
//         npm LIKE '%$keyword%' OR
//         email LIKE '%$keyword%' OR
//         alamat LIKE '%$keyword%'";
// }

// Eksekusi query jumlah data
$resultJumlahData = query($queryJumlahData);
$jumlahData = $resultJumlahData[0]['jumlah'];

// Hitung jumlah halaman
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

// Offset data
$offset = ($halamanAktif - 1) * $jumlahDataPerHalaman;

// Query data mahasiswa dengan limit, offset, dan filter pencarian jika ada
if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $mahasiswa = search($keyword);
    // Reset halaman aktif ke 1 saat melakukan pencarian

    // $halamanAktif = 1;
    
} else {
    $queryMahasiswa = "SELECT * FROM mahasiswa LIMIT $offset, $jumlahDataPerHalaman";
    $mahasiswa = query($queryMahasiswa);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <!-- Tailwind CSS (daisyUI) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.6.0/dist/full.css" rel="stylesheet">

</head>

<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen">
    <div class="container mx-auto py-4" id="container">
        <h1 class="text-center text-2xl font-bold mb-4 me-2">Daftar Mahasiswa</h1>

        <div class="flex justify-between w-full mb-4">
            <form class="flex gap-2">
                <input type="text" class="input input-bordered w-64 sm:w-auto" placeholder="Cari data mahasiswa" name="keyword" autocomplete="off" id="keyword" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" autofocus>
                <!-- Hapus action dan method, ubah tipe tombol menjadi 'button' -->
                <button type="button" class="btn btn-primary" id="tombol-cari">Cari</button>
            </form>


            <div class="join text-center me-5">
                <a href="index.php" class="join-item btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </a>

                <?php if ($jumlahHalaman > 0) : ?>
                    <!-- Tombol kembali ke halaman utama (index.php) -->

                    <!-- Tombol sebelumnya (<) -->
                    <?php if ($halamanAktif > 1) : ?>
                        <a href="index.php?halaman=<?= $halamanAktif - 1 ?>&keyword=<?= $keyword ?>" class="join-item btn btn-primary">&lt;</a>
                    <?php endif; ?>

                    <!-- Tombol halaman -->
                    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                        <a href="index.php?halaman=<?= $i ?>&keyword=<?= $keyword ?>" class="join-item btn <?= ($i == $halamanAktif) ? 'btn-active btn-warning' : 'btn-primary' ?>"><?= $i ?></a>
                    <?php endfor; ?>

                    <!-- Tombol selanjutnya (>) -->
                    <?php if ($halamanAktif < $jumlahHalaman) : ?>
                        <a href="index.php?halaman=<?= $halamanAktif + 1 ?>&keyword=<?= $keyword ?>" class="join-item btn btn-primary">&gt;</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <a href="insert.php" class="btn btn-primary">Tambah Data Mahasiswa</a>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="table w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th scope="col" class="px-6 py-3">Aksi</th>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nama</th>
                        <th scope="col" class="px-6 py-3">NPM</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mahasiswa as $row) : ?>
                        <tr class="border-b border-gray-200">
                            <td class="px-6 py-4">
                                <a href="update.php?id=<?= $row['id_mhs'] ?>" class="btn btn-sm btn-primary">Ubah</a>
                                <a href="delete.php?id=<?= $row['id_mhs'] ?>" onclick="return confirm('Yakin?')" class="btn btn-sm btn-danger ml-2">Hapus</a>
                            </td>
                            <td class="px-6 py-4"><?= $row['id_mhs'] ?></td>
                            <td class="px-6 py-4"><?= $row['nama_mhs'] ?></td>
                            <td class="px-6 py-4"><?= $row['npm'] ?></td>
                            <td class="px-6 py-4"><?= $row['email'] ?></td>
                            <td class="px-6 py-4"><?= $row['alamat'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="javascript/ajax.js"></script>
    <!-- Optional: Add custom scripts or additional libraries here -->

</body>

</html>