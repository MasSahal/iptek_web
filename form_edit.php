<?php
$id = $_GET['edit']; //ini dari url edit= id dari mhs
$mahasiswa = mysqli_query($db, "SELECT * FROM mahasiswa WHERE id_mahasiswa='$id'");
$data = mysqli_fetch_assoc($mahasiswa);
?>

<form action="proses.php?aksi=edit" method="post">

  <!-- //ini id mahasiswa -->
  <input type="hidden" value="<?= $data['id_mahasiswa']; ?>" name="id">
  <div class="form-group">
    <label for="">Nama</label>
    <input type="text" name="nama" value="<?= $data['nama']; ?>" class="form-control">
  </div>
  <div class="form-group">
    <label for="">Umur</label>
    <input type="number" name="umur" value="<?= $data['umur']; ?>" class="form-control">
  </div>
  <div class="form-group">
    <label for="">Alamat</label>
    <textarea name="alamat" id="" rows="3" class="form-control"><?= $data['alamat']; ?></textarea>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Update</button>
</form>