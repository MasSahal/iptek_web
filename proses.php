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

        $foto_profile = $_FILES['foto_profile']['name']; // nama default
        $tmp = $_FILES['foto_profile']['tmp_name']; // nama temporary

        //ambil ekstensi file
        $ekstensi = pathinfo($foto_profile, PATHINFO_EXTENSION);

        // ambil size
        $size = $_FILES['foto_profile']['size'];

        $allowed_extension = ['jpg', 'jpeg', 'png', 'gif'];

        // jika ekstensi sesuai 
        if (in_array($ekstensi, $allowed_extension)) {

            //cek ukuran file
            if ($size <= 1_000_000) {  // 1_000_000 bytes = 1mb

                // bikin nama foto baru
                $foto_profile_baru = uniqid(strtolower($nama)) . '.' . $ekstensi;

                //pindahkan foto ke direktori img
                move_uploaded_file($tmp, 'img/' . $foto_profile_baru);

                $query = "INSERT INTO mahasiswa (nama, umur, alamat, foto_profile) VALUES ('$nama', '$umur', '$alamat', '$foto_profile_baru')";
                $add = mysqli_query($db, $query);

                if ($add) {
                    echo "<script>alert('Data berhasil ditambahkan!')</script>";
                    echo "<script>location='index.php'</script>";
                } else {
                    echo "<script>alert('Data gagal ditambahkan!')</script>";
                    echo "<script>location='index.php'</script>";
                }
            } else {
                echo "<script>alert('File terlalu besar!')</script>";
                echo "<script>location='index.php'</script>";
            }
        } else {
            echo "<script>alert('Format file tidak sesuai! - JPG, JPEG, PNG, GIF')</script>";
            echo "<script>location='index.php'</script>";
        }

        #
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

        $query = "SELECT * FROM mahasiswa WHERE id_mahasiswa = '$id'";
        $old_data = mysqli_fetch_assoc(mysqli_query($db, $query));

        //cek apakah ada file lama di direktori img
        if (file_exists('img/' . $old_data['foto_profile'])) {

            // jika ada hapus file tersebut
            unlink('img/' . $old_data['foto_profile']);
        }


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
