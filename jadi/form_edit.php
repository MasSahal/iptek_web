<?php
$id = $_GET['edit']; //ini dari url edit= id dari mhs
$mahasiswa = mysqli_query($db, "SELECT * FROM mahasiswa WHERE id_mahasiswa='$id'");
if (mysqli_num_rows($mahasiswa) == 0) {
  echo "<script>alert('Data tidak ditemukan!')</script>";
  echo "<script>location='index.php'</script>";
}
$data = mysqli_fetch_assoc($mahasiswa);
?>

<form action="proses.php?aksi=edit" method="post" enctype="multipart/form-data">

  <!-- //ini id mahasiswa -->
  <input type="hidden" value="<?= $data['id_mahasiswa']; ?>" name="id">
  <div class="form-group">
    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama" value=" <?= $data['nama']; ?>" class="form-control">
  </div>
  <div class="form-group">
    <label for="umur">Umur</label>
    <input type="number" name="umur" id="umur" value="<?= $data['umur']; ?>" class="form-control">
  </div>
  <div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea name="alamat" id="alamat" rows="3" class="form-control"><?= $data['alamat']; ?></textarea>
  </div>
  <div class="form-group">
    <label for="foto_profil">Foto Profile</label>
    <input type="file" class="form-control-file" name="foto_profil" id="foto_profil" placeholder="">
    <small>Masukan gambar jika ingin mengganti foto. - JPG, JPEG, PNG, GIF</small>
    <br>
    <img src="img/<?= $data['foto_profile']; ?>" alt="<?= $data['foto_profile']; ?>" id="img" width="200px">

  </div>
  <button type="submit" name="submit" class="btn btn-success"><i class="fas fa-save"></i> Update Data</button>
  <button type="reset" class="btn btn-warning"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
</form>