<?php
// Panggil file koneksi.php untuk melakukan koneksi ke database
include 'koneksi.php';

// Cek apakah parameter ID tersedia dalam URL
if(isset($_GET['id']) && !empty($_GET['id']) &&
    isset($_GET['id2']) && !empty($_GET['id2']) &&
    isset($_GET['id3']) && !empty($_GET['id3'])) {
    
    // Bersihkan dan simpan nilai parameter ID yang diterima
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $kategori_judul = mysqli_real_escape_string($conn, $_GET['id2']);
    $username = mysqli_real_escape_string($conn, $_GET['id3']);

    // Query untuk menghapus data dari tabel "posts" dengan kondisi INNER JOIN
    $sql = "DELETE posts FROM posts 
            INNER JOIN kategori ON posts.kategori_id = kategori.id 
            INNER JOIN petugas ON posts.petugas_id = petugas.id
            WHERE posts.id = '$id' AND kategori.judul = '$kategori_judul' AND petugas.username = '$username'";


    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman sebelumnya setelah penghapusan berhasil
        header("Location: post.php");
        exit(); // Hentikan eksekusi skrip setelah melakukan redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Parameter ID tidak ditemukan atau tidak lengkap";
}

// Tutup koneksi
$conn->close();
?>