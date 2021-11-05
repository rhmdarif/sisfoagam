
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nama_kategori">Nama kategori</label>
        <input type="hidden" id="id" readonly>
        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control">
    </div>
    <div class="form-group">
        <label for="nama_kategori">Icon kategori</label>
        <input type="file" name="icon_kategori" id="icon_kategori" onchange="return tampilfoto()" class="form-control">
    </div>
    <div class="form-group text-center">
        <div id="tampilFoto"></div>
    </div>

    <button type="button" id="tambah" class="btn btn-primary float-right">
        <div id="btnNama"></div>
    </button>
</form>
