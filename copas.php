// koneksi database
// $db = mysqli_connect("localhost", "root", "", "db_mhs");

// // ambil data dari tabel mahasiswa query data

// $result = mysqli_query($db, "SELECT * FROM mahasiswa");

// var_dump($result) ;

// if (!$result){
//     echo mysqli_error($db);
// };

// ambik data dari objek result

// while($ambil_Data = mysqli_fetch_assoc($result)){
//     var_dump($ambil_Data) ;

// }



// mysqli_fetch_row() =  untuk mengembalikan fungsi array numerik
// mysqli_fetch_assoc() = untuk mengembalikan fungsi array associative / type data dictionary 
// mysqli_fetch_array() = untuk mengembalika fungsi array numerik dan associative
// kekurangan unutk fetch array akan menjadi berat kerena data yang ditampilkan dobel antara numerik dan associative

// mysqli_fetch_object() = untuk mengembalikan fungsi object
// untuk pemanggilan data fetch objek tidak perlu menggunakan indexing value cukup dipanggil parent variabel nya
// untuk memanggil field nya menggunakan (->) contoh->email





// kita bisa mengambil index dari array dan data dari database 
// berdasarkan index