<?php
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "iptek_web";

$db = mysqli_connect($host, $user, $pass, $dbname);

// var_dump($db);
if (mysqli_connect_errno()) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">

    <title>IPTEK</title>

</head>

<body class="">
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <a class="navbar-brand" href="#">Data Mahasiswa</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" type="get">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" name="cari">
                    <button class="btn btn-outline-success my-2 my-sm-0" name="pencarian" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <div class="row">
            <div class="col-4">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">Form Data
                            <a name="" id="" class="btn btn-primary btn-sm float-right" href="index.php" role="button">
                                <i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
                            </a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_GET['edit'])) {
                            include('form_edit.php');
                        } else {
                            include('form_add.php');
                        } ?>
                    </div>
                </div>
                <hr>
            </div>
            <div class="col-8">
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title">View Data
                            <a name="" id="" class="btn btn-info btn-sm float-right" href="index.php<?= isset($_GET['edit']) ? "?edit=$_GET[edit]" : ""; ?>" role="button">
                                <i class="fa fa-recycle" aria-hidden="true"></i> Refresh
                            </a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php

                        if (isset($_GET['pencarian'])) {
                            $cari = $_GET['cari'];
                            $judul = "Menampilkan Hasil Pencarian " . $cari;
                            $mahasiswa = (mysqli_query($db, "SELECT * FROM mahasiswa WHERE nama LIKE '%$cari%' OR alamat LIKE '%$cari%' OR umur LIKE '%$cari%'"));
                        } else {
                            $judul = "Menampilkan Data Mahasiswa";
                            $mahasiswa = (mysqli_query($db, "SELECT * FROM mahasiswa"));
                        };
                        ?>
                        <h5 class="text-center"><?= $judul; ?></h5>
                        <table class="table align-content-center">
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 0;
                            while ($row = mysqli_fetch_assoc($mahasiswa)) {
                            ?>
                                <tr>
                                    <td><?= $no += 1; ?></td>
                                    <td><img src="img/<?= $row['foto_profile']; ?>" class="img-fluid" width="100px" alt="<?= $row['foto_profile']; ?>"></td> <!-- beda pakai alt dan ngga -->
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['umur']; ?></td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td>
                                        <a href="proses.php?aksi=hapus&&id=<?= $row['id_mahasiswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus data?')">Hapus</a>
                                        <a href="index.php?edit=<?= $row['id_mahasiswa']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            <?php }; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>

    <script>
        $('#foto_profil').change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#img').attr('src', e.target.result)
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
</body>

</html>