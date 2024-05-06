<?php
// Panggil file koneksi.php untuk melakukan koneksi ke database
include 'koneksi.php';

// Cek apakah parameter ID tersedia dalam POST
if(isset($_POST['id'])) {
    // Ambil ID yang dikirimkan melalui parameter POST
    $id = $_POST['id'];
    
    // Query untuk menghapus data dari tabel "foto"
    $sql = "DELETE FROM foto WHERE id = $id";
    
    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman sebelumnya setelah penghapusan berhasil
        header("Location: detail_galeri.php");
        exit(); // Hentikan eksekusi skrip setelah melakukan redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID tidak ditemukan";
}

// Tutup koneksi
$conn->close();
?>