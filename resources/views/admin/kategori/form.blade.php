<form action="{{ $url ?? route('admin.kategori-akomodasi.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method("POST")
    <div class="form-group">
        <label for="nama_kategori">Nama kategori</label>
        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="{{ $kategori_akomodasi->nama_kategori_akomodasi ?? "" }}">
    </div>
    <div class="form-group">
        <label for="nama_kategori">Icon kategori</label>
        <input type="file" name="icon_kategori" id="icon_kategori" class="form-control" value="{{ $kategori_akomodasi->icon_kategori_akomodasi ?? "" }}">
    </div>

    <button type="button" id="{{ isset($type)? "btnEdit" : "btnCreate" }}" class="btn btn-primary float-right">
        {{ isset($type)? "Ubah" : "Tambah" }}
    </button>
</form>
