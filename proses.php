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


if (isset($_GET['aksi'])) {

    // tangkap mau ngapain
    $aksi = $_GET['aksi'];

    if ($aksi == "tambah") {
        $nama = $_POST['nama'];
        $umur = $_POST['umur'];
        $alamat = $_POST['alamat'];

        $query = "INSERT INTO mahasiswa (nama, umur, alamat) VALUES ('$nama', '$umur', '$alamat')";
        $add = mysqli_query($db, $query);

        if ($add) {
            echo "<script>alert('Data berhasil ditambahkan!')</script>";
            header("location: index.php");
        } else {
            echo "<script>alert('Data gagal ditambahkan!')</script>";
            header("location: index.php");
        }
    } elseif ($aksi == "edit") {

        $id = $_POST['id']; // tangkap id dari form

        $nama = $_POST['nama'];
        $umur = $_POST['umur'];
        $alamat = $_POST['alamat'];

        $query = "UPDATE mahasiswa SET nama = '$nama', umur = '$umur', alamat = '$alamat' WHERE id_mahasiswa = '$id'";
        $update = mysqli_query($db, $query);

        if ($update) {
            echo "<script>alert('Data berhasil diperbarui!')</script>";
            header("location: index.php");
        } else {
            echo "<script>alert('Data gagal diperbarui!')</script>";
            header("location: index.php");
        }
    } elseif ($aksi == "hapus") {

        $id = $_GET['id']; // tangkap id dari url

        $hapus = mysqli_query($db, "DELETE FROM mahasiswa WHERE id_mahasiswa = '$id'");
        if ($hapus) {
            echo "<script>alert('Data berhasil dihapus!')</script>";
            header("location: index.php");
        } else {
            echo "<script>alert('Data gagal dihapus!')</script>";
            header("location: index.php");
        }
    }
} else {
    echo "Oops! Halaman yang Anda tuju tidak tersedia!";
}
