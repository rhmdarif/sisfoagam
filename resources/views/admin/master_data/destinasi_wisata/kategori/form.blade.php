<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nama_kategori">Nama Kategori</label>
        <input type="hidden" readonly id="id">
        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="">
    </div>
    <div class="form-group">
        <label for="nama_kategori">Icon Kategori</label>
        <input type="file" name="icon_kategori" id="icon_kategori" class="form-control" value="">
    </div>
    <div class="form-group text-center">
        <div id="tampilFoto"></div>
    </div>
    <button type="submit" style="width:80px" id="btnNama" class="btn btn-primary float-right">Submit</button>
</form>
