<form action="proses.php?aksi=tambah" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Nama</label>
        <input type="text" name="nama" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Umur</label>
        <input type="number" name="umur" id="" class="form-control">
    </div>
    <div class="form-group">
        <label for="">Alamat</label>
        <textarea name="alamat" id="" rows="3" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="foto_profil">Foto</label>
        <input type="file" name="foto_profile" id="foto_profil" class="form-control">
        <small>Ekstensi diperbolehkan - JPG, JPEG, PNG, GIF</small>
        <br>
        <img src="" id="img" width="150px">
    </div>

    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-warning">Reset</button>
</form>