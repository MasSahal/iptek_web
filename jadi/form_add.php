<form action="proses.php?aksi=tambah" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control">
    </div>
    <div class="form-group">
        <label for="umur">Umur</label>
        <input type="number" name="umur" id="umur" class="form-control">
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="foto_profil">Foto Profile</label>
        <input type="file" class="form-control-file" name="foto_profil" id="foto_profil" placeholder="">
        <small>Ekstensi diperbolehkan - JPG, JPEG, PNG, GIF</small>
        <br>
        <img src="" alt="" id="img" width="200px">
    </div>
    <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tambah</button>
    <button type="reset" class="btn btn-warning"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
</form>