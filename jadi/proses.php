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

        // tambah gambar profile
        $foto_profil = $_FILES['foto_profil']['name'];
        $tmp = $_FILES['foto_profil']['tmp_name'];

        // ambilekstensi 
        $ekstensi = pathinfo($foto_profil, PATHINFO_EXTENSION);

        //ambil size file
        $size = $_FILES['foto_profil']['size']; // bytes

        // cek ekstensi
        $ekstensi_boleh = array('jpg', 'jpeg', 'png', 'gif');

        // validasi ekstensi
        if (in_array(strtolower($ekstensi), $ekstensi_boleh)) {

            //validasi size
            if ($size <= 1_000_000) {

                // buat nama baru
                $foto_baru = uniqid(strtolower($nama) . "_") . "." . $ekstensi;

                //pindahkan foto ke folder
                move_uploaded_file($tmp, 'img/' . $foto_baru);

                $query = "INSERT INTO mahasiswa (nama, umur, alamat, foto_profile) VALUES ('$nama', '$umur', '$alamat', '$foto_baru')";
                $add = mysqli_query($db, $query);

                if ($add) {
                    echo "<script>alert('Data berhasil ditambahkan!')</script>";
                    echo "<script>location='index.php'</script>";
                } else {
                    echo "<script>alert('Data gagal ditambahkan!')</script>";
                    echo "<script>location='index.php'</script>";
                }
            } else {
                echo "<script>alert('File terlalu besar! - Max 1mb')</script>";
                echo "<script>location='index.php'</script>";
            }
        } else {
            echo "<script>alert('Ekstensi file tidak sesuai! - Gunakan JPG, JPEG, PNG, GIF')</script>";
            echo "<script>location='index.php'</script>";
        }
    } elseif ($aksi == "edit") {

        $id = $_POST['id']; // tangkap id dari form

        $nama = $_POST['nama'];
        $umur = $_POST['umur'];
        $alamat = $_POST['alamat'];

        if (is_uploaded_file($_FILES['foto_profil']['tmp_name'])) {

            $foto_profil = $_FILES['foto_profil']['name'];
            $tmp = $_FILES['foto_profil']['tmp_name'];


            //ambil size file
            $size = $_FILES['foto_profil']['size']; // bytes

            // ambil ekstensi 
            $ekstensi = pathinfo($foto_profil, PATHINFO_EXTENSION);

            // ekstensi diperblehkan
            $ekstensi_boleh = array('jpg', 'jpeg', 'png', 'gif');

            // validasi ekstensi
            if (in_array(strtolower($ekstensi), $ekstensi_boleh)) {

                //validasi size
                if ($size <= 1_000_000) {

                    // buat nama baru
                    $foto_baru = uniqid(strtolower($nama) . "_") . "." . $ekstensi;

                    //ambil data sebelumnya buat di hapus
                    $old_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT foto_profile FROM mahasiswa WHERE id_mahasiswa = $id"));

                    //cek data apakah foto ada di folder img
                    if (file_exists('img/' . $old_data['foto_profile'])) {

                        //jika ada maka di hapus
                        unlink('img/' . $old_data['foto_profile']);
                    }

                    //pindahkan foto baru ke folder img
                    move_uploaded_file($tmp, 'img/' . $foto_baru);

                    //update query
                    $query = "UPDATE mahasiswa SET nama='$nama', umur='$umur', alamat='$alamat', foto_profile='$foto_baru' WHERE id_mahasiswa='$id'";
                } else {
                    echo "<script>alert('File terlalu besar! - Max 1mb')</script>";
                    echo "<script>location='index.php?edit=" . $id . "'</script>";
                }
            } else {
                echo "<script>alert('Ekstensi file tidak sesuai! - Gunakan JPG, JPEG, PNG, GIF')</script>";
                echo "<script>location='index.php?edit=" . $id . "'</script>";
            }
        } else {

            //klo gada foto berarti query nya gaperlu update foto
            $query = "UPDATE mahasiswa SET nama='$nama', umur='$umur', alamat='$alamat' WHERE id_mahasiswa='$id'";
        }

        //eksekusi query
        $edit = mysqli_query($db, $query);

        if ($edit) {
            echo "<script>alert('Data berhasil diubah!')</script>";
            echo "<script>location='index.php'</script>";
            exit;
        } else {
            echo "<script>alert('Data gagal diubah!')</script>";
            echo "<script>location='index.php?edit=" . $id . "'</script>";
            exit;
        }
    } elseif ($aksi == "hapus") {

        $id = $_GET['id']; // tangkap id dari url

        //ambil data sebelumnya buat di hapus
        $old_data = mysqli_fetch_assoc(mysqli_query($db, "SELECT foto_profile FROM mahasiswa WHERE id_mahasiswa = $id"));

        //cek data apakah foto ada di folder img
        if (file_exists('img/' . $old_data['foto_profile'])) {

            //jika ada maka di hapus
            unlink('img/' . $old_data['foto_profile']);
        }

        $hapus = mysqli_query($db, "DELETE FROM mahasiswa WHERE id_mahasiswa = '$id'");
        if ($hapus) {
            echo "<script>alert('Data berhasil dihapus!')</script>";
            echo "<script>location='index.php'</script>";
        } else {
            echo "<script>alert('Data gagal dihapus!')</script>";
            echo "<script>location='index.php'</script>";
        }
    }
} else {
    echo "Oops! Halaman yang Anda tuju tidak tersedia!";
}
