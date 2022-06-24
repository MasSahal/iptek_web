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
    <div class="">
        <div class="row">
            <div class="col-6">
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
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>No</th>
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
</body>

</html>