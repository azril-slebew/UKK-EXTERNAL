<?php
include 'koneksi.php';
session_start();
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $status = $_POST['status'];
    $kategori_id = $_POST['kategori'];
    $petugas_id = $_POST['petugas'];
    $isi = $_POST['isi'];

    // Check if the post already exists
    $sql = "SELECT * FROM posts WHERE judul = '$judul'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Woops! judul Sudah Terdaftar.')</script>";
    } else {
        // Insert the post into the database
        $sql = "INSERT INTO posts (judul, status, kategori_id, petugas_id, isi) VALUES ('$judul', '$status', '$kategori_id', '$petugas_id', '$isi')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('Post Berhasil di Tambahkan')</script>";
            $judul = "";
            $status = "";
            $kategori_id = "";
            $petugas_id = "";
            $isi = "";
        } else {
            echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMK 1 TRIPLE J</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="shortcut icon" href="img/j.png">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php
    include 'sidebar.php'
    ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php
            include 'navbar.php'
            ?>
                <!-- Topbar -->
                
                <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 font-weight-bold mb-0 text-gray-800">Post</h1>
                    </div>
                </div>
                <!-- /.container-fluid -->
                <div class="col-lg-12">
                            <div class="card shadow mb-4">

    <div class="card-body">
    <button type="button" class="btn btn-primary btn-md mb-3" data-toggle="modal" data-target="#post">
    +Post
    </button>
    <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Petugas</th>
                            <th>Status</th>
                            <th>Dibuat pada</th>
                            <th>Aksi</th>
                    </tr>
                    </thead>
                    <?php
$hasil = mysqli_query($conn, "SELECT posts.id, posts.judul AS post_judul, kategori.judul AS kategori_judul, petugas.username, posts.status, 
                DATE_FORMAT(posts.created_at, '%Y-%m-%d') AS created_at
                FROM posts 
                INNER JOIN kategori ON posts.kategori_id = kategori.id 
                INNER JOIN petugas ON posts.petugas_id = petugas.id");

$no = 1;
while ($row = mysqli_fetch_assoc($hasil)) :
?>
<tbody>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $row['post_judul']?></td>
        <td><?php echo $row['kategori_judul']?></td>
        <td><?php echo $row['username']?></td> <!-- asumsi kolom username ada di tabel petugas -->
                        <td>
                <?php
                $status = $row['status'];
                if ($status == 'publish') {
                echo '<span class="badge bg-success text-white">Publish</span>';
                } elseif ($status == 'draft') {
                echo '<span class="badge bg-primary text-white">Draft</span>';
                }
                ?>
                </td>
        <td><?php echo $row['created_at']?></td> <!-- asumsi kolom created_at ada di tabel posts -->
        <td>
        <a href="post_hapus.php?id=<?php echo $row['id']; ?>&id2=<?php echo $row['kategori_judul']; ?>&id3=<?php echo $row['username']; ?>&post_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-md mb-3" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                <i class="fas fa-trash"></i>
            </a>
            <a href="edit_post.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-md mx-2 mb-3">
                <i class="fas fa-edit"></i>
            </a>
        </td>
    </tr>
</tbody>
<?php endwhile; ?>

        </table>
    </div>
    </div>
    <!-- /.container-fluid -->
    </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>SMK 1 TRIPLE J</span>
                    </div>
                </div>
            </footer>
            <!-- End of footer -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

<!-- The Modal -->
<div class="modal" id="post">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Post</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form method="post">
      <div class="modal-body">

      <h5 class="m-2 font-weight-bold text-primary">Judul</h5>
      <input type="text" class="form-control bg-light border-1 small"placeholder="Masukan data" name="judul" required>

      <label class="m-2 font-weight-bold text-primary">Kategori</label>
            <select class="form-control" name="kategori" id="kategori" required>
                <option value="">Pilih Kategori</option>
                <?php 
                include 'koneksi.php';
                $sql = mysqli_query($conn, "SELECT * FROM kategori") or die (mysqli_error($conn));
                while ($data = mysqli_fetch_array($sql)) {
                    echo '<option value="'.$data['id'].'">'.$data['judul'].'</option>';
                } 
                ?>
            </select>

            <label class="m-2 font-weight-bold text-primary" name = "isi">Isi</label>
                <textarea name="isi" class="form-control" required></textarea>

                <label class="m-2 font-weight-bold text-primary">Petugas</label>
                <select class="form-control" name="petugas" id="petugas">
                    <option value="">Pilih petugas</option>
                    <?php 
                    include 'koneksi.php';
                    $sql = mysqli_query($conn, "SELECT * FROM petugas") or die (mysqli_error($conn));
                    while ($data = mysqli_fetch_array($sql)) {
                        echo '<option value="'.$data['id'].'">'.$data['username'].'</option>';
                    } 
                    ?>
                </select>

                <div class="form-group mb-2">
                    <label class="m-2 font-weight-bold text-primary" for="status">status</label>
                    <select name="status" id="status" class="form-control" required>
                                        <option value="">Pilih status</option>
                                        <option value="publish">Publish</option>
                                        <option value="draft">draft</option>
                                    </select>
                </div>

                <button name="submit" id="submit" class="btn btn-primary btn-md mb-3 mt-3">Tambah data</button>
                <a href="post.php" class="btn btn-secondary">
                        <span class="text">Kembali</span>
                    </a>

      </div>
      </form>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

</html>