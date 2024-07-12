// live-search.js

// Fungsi untuk melakukan pencarian live search menggunakan jQuery
$(document).ready(function() {
    $('#keyword').on('input', function() {
        var keyword = $(this).val().trim();

        // Kirim permintaan Ajax ke server
        $.ajax({
            url: 'ajax/live_search.php', // Lokasi file PHP untuk pemrosesan
            method: 'POST',
            dataType: 'json', // Tipe data yang diharapkan dari server
            data: {
                keyword: keyword
            },
            success: function(response) {
                if (response.status == 'success') {
                    // Panggil fungsi untuk memperbarui tabel dengan hasil pencarian
                    updateTable(response.data);
                } else {
                    // Tampilkan pesan error jika ada
                    console.error('Error:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error); // Log error jika terjadi kesalahan
            }
        });
    });

    // Fungsi untuk memperbarui tabel dengan hasil pencarian
    function updateTable(data) {
        var tableBody = $('tbody');

        // Kosongkan isi tabel
        tableBody.empty();

        // Jika ada hasil pencarian
        if (data.length > 0) {
            // Tambahkan baris-baris hasil pencarian ke tabel
            $.each(data, function(index, row) {
                var newRow = `
                    <tr class="border-b border-gray-200">
                        <td class="px-6 py-4">
                            <a href="update.php?id=${row.id_mhs}" class="btn btn-sm btn-primary">Ubah</a>
                            <a href="delete.php?id=${row.id_mhs}" onclick="return confirm('Yakin?')" class="btn btn-sm btn-danger ml-2">Hapus</a>
                        </td>
                        <td class="px-6 py-4">${row.id_mhs}</td>
                        <td class="px-6 py-4">${row.nama_mhs}</td>
                        <td class="px-6 py-4">${row.npm}</td>
                        <td class="px-6 py-4">${row.email}</td>
                        <td class="px-6 py-4">${row.alamat}</td>
                    </tr>
                `;
                tableBody.append(newRow);
            });
        } else {
            // Jika tidak ada hasil pencarian
            tableBody.html('<tr><td colspan="6" class="px-6 py-4 text-center">Tidak ada data ditemukan</td></tr>');
        }
    }
});
