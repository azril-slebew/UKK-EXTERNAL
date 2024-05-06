<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="shortcut icon" href="../galeri/img/J.png" type="icon">
    <title>Beranda | SMK 1 TRIPLE 'J'</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand d-flex align-align-item" href="#">
                <img src="../galeri/img/j.png" height="50" width="50" alt="logo"
                    class="d-inline-block align-text-top me-3">
                <div class="profile">
                    <h4 class="my-0">SMK DIGITAL INDNESIA</h4>
                    <P class="my-0">Maju seiring perkembangan digital</P>
                </div>
            </a>
        </div>
    </nav>
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../galeri/uploads/j.png" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../galeri/uploads/triple.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="../galeri/uploads/brosur.jpg" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <!-- Columns are always 50% wide, on mobile and desktop -->
      <div class="card mb-3" style="max-width: 100%;">
  <div class="row no-gutters">
    <div class="col-md-6">
      <img src="../galeri/uploads/rpl.jpg" class="card-img" alt="Gambar">
    </div>
    <div class="col-md-6">
      <div class="card-body">
        <h5 class="card-title">JUDUL</h5>
        <p class="card-text">Smk Indonesia Digital maju seiring perkembangan digital</p>
        <p class="card-text"><small class="text-muted">Terakhir diperbarui 3 menit yang lalu</small></p>
      </div>
    </div>
  </div>
</div>
<div class="card mb-3" style="max-width: 100%;">
  <div class="row no-gutters">
    <div class="col-md-6">
    <div class="card-body">
        <h5 class="card-title">AGENDA SEKOLAH</h5>
        <p class="card-text">ujian hidup</p>
        <p class="card-text"><small class="text-muted">Terakhir diperbarui 3 menit yang lalu</small></p>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card-body">
        <center>
      <h5 class="card-title">INFORMASI TERKINI</h5>
      <p class="card-text">Prestasi juara 2 konten kreator di universitas pakuan</p>
    <div class="col-md-10">
    <img src="../galeri/uploads/kejuaraan.jpg" class="card-img" alt="Gambar">
    
      
    </div>
      </div>
    </div>

    <?php
// Membuat koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "galeri");

// Memeriksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Mengambil data dari tabel "foto"
$query_foto = "SELECT * FROM foto";
$result_foto = mysqli_query($koneksi, $query_foto);

// Memeriksa apakah query foto berhasil dieksekusi
if (!$result_foto) {
    echo "Error: " . mysqli_error($koneksi);
    exit();
}

// Menampilkan data foto di dalam halaman web
echo "<h1>Data Foto</h1>";
echo "<ul>";
$displayed_ids = array(); // Array untuk menyimpan ID yang sudah ditampilkan
while ($row_foto = mysqli_fetch_assoc($result_foto)) {
    // Memeriksa apakah ID sudah ditampilkan sebelumnya
    if (!in_array($row_foto['id'], $displayed_ids)) {
        echo "<li>Nama File: " . $row_foto['file'] . "</li>";
        echo "<img src='../galeri/uploads/" . $row_foto['file'] . "' alt='Gambar' width='100' height='100'>";
        // Tambahkan informasi lain yang ingin ditampilkan dari tabel "foto"
       
        // Menambahkan ID ke array displayed_ids
        $displayed_ids[] = $row_foto['id'];
    }
}
echo "</ul>";

// Mengambil data dari tabel "posts"
$query_posts = "SELECT * FROM posts";
$result_posts = mysqli_query($koneksi, $query_posts);

// Memeriksa apakah query posts berhasil dieksekusi
if (!$result_posts) {
    echo "Error: " . mysqli_error($koneksi);
    exit();
}

// Menampilkan data posts di dalam halaman web
echo "<h1>Data Posts</h1>";
echo "<ul>";
$displayed_ids = array(); // Mengosongkan kembali array displayed_ids
while ($row_posts = mysqli_fetch_assoc($result_posts)) {
    // Memeriksa apakah ID sudah ditampilkan sebelumnya
    if (!in_array($row_posts['id'], $displayed_ids)) {
        echo "<p>Isi: " . $row_posts['isi'] . "</p>";
        // Tambahkan informasi lain yang ingin ditampilkan dari tabel "posts"
       
        // Menambahkan ID ke array displayed_ids
        $displayed_ids[] = $row_posts['id'];
    }
}
echo "</ul>";

// Menutup koneksi ke database
mysqli_close($koneksi);
?>

  </div>
</div>
<!-- footer -->
<div class="container-custom">
  <div class="footer">
    <div class="col-md-6"></div>
    <div class="maps">
            <iframe src="https://maps.google.com/maps?q=smks 1 triple j&amp;t=&amp;z=10&amp;ie=UTF8&amp;iwloc=&amp;output=embed" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="alamat">
              <center>
                <h4 class="mb-3">SMK 1 Triple "J"</h4>
                <h6>Jl. Landbow No.01, Karang Asem Barat, Kec. Citeureup, Kabupaten Bogor, Jawa Barat 16810</h6>
                </center>
                <div class="wrapper-contact">
                    <div class="item"><i class="fa fa-phone"></i>(021) 8757384 </div>
                    <div class="item"><i class="fa fa-envelope"></i> <a href="mailto:smktj1@gmail.com">smktj1@gmail.com</a> </div>
                    <div class="item"><i class="fab fa-facebook-square"></i> <a href="">SMK 1 Triple &quot;J&quot; Citereup</a> </div>
                    <div class="item"><i class="fab fa-instagram"></i> <a href="">@smk_1_triple_j</a> </div>
                    
                </div>  
            </div>
        </div>
        <div class="text-center mt-3"><h6>Copyright 2024 SMK 1 Triple J</h6></div>
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>