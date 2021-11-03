<form action="{{ $url ?? route('admin.fasilitas-akomodasi.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method("POST")
    <div class="form-group">
        <label for="nama_fasilitas">Nama Fasilitas</label>
        <input type="text" name="nama_fasilitas" id="nama_fasilitas" class="form-control" value="{{ $fasilitas_akomodasi->nama_fasilitas_akomodasi ?? "" }}">
    </div>
    <div class="form-group">
        <label for="nama_fasilitas">Icon Fasilitas</label>
        <input type="file" name="icon_fasilitas" id="icon_fasilitas" class="form-control" value="{{ $fasilitas_akomodasi->icon_fasilitas_akomodasi ?? "" }}">
    </div>

    <button type="button" id="{{ isset($type)? "btnEdit" : "btnCreate" }}" class="btn btn-primary float-right">
        {{ isset($type)? "Ubah" : "Tambah" }}
    </button>
</form>
