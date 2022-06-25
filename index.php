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

    <title>IPTEK</title>

</head>

<body class="">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <div class="row">
            <div class="col-4">
                <div class="card">
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
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>ALamat</th>
                                <th>Aksi</th>
                            </tr>
                            <?php
                            $no = 0;
                            $mahasiswa = mysqli_query($db, "SELECT * FROM `mahasiswa`");

                            while ($row = mysqli_fetch_assoc($mahasiswa)) {
                            ?>
                                <tr>
                                    <td><?= $no += 1; ?></td>
                                    <td>
                                        <img src="img/<?= $row['foto_profile']; ?>" alt="<?= $row['foto_profile']; ?>" width="100px">
                                    </td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['umur']; ?></td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td>
                                        <a href="proses.php?aksi=hapus&&id=<?= $row['id_mahasiswa']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus data?')">Hapus</a>
                                        <a href="index.php?edit=<?= $row['id_mahasiswa']; ?>" class="btn btn-warning">Edit</a>
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