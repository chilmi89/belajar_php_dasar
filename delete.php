<?php

require "function.php";
$id = $_GET["id"];


if(hapus_Data($id) > 0) {
    echo "<script>alert('Data Berhasil dihapus'); document.location.href = 'index.php';</script>";
}else{
    echo "Data gagal dihapus";
}
?>