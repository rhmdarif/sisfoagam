@extends('admin.layouts.app')
@section('title', 'Galeri Parawisata')
@push('css')
    <link rel="stylesheet" href="{{ url('/') }}/admin/assets/plugins/lightbox2/css/lightbox.css">
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Galeri Parawisata</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Galeri Parawisata</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <a onclick="showModal('{{ route('admin.galeri-parawisata.store') }}')" class="btn btn-primary" >Tambah Data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:2%">No</th>
                                            <th>Foto</th>
                                            <th style="width:20%">Kategori</th>
                                            <th>Keterangan</th>
                                            <th style="width:10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($galeries as $i => $d)
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td>
                                                @if ($d->kategori == "foto")
                                                    <a href="{{ $d->file }}" data-lightbox="galeri_parawisata" data-title="#{{ $d->id }} ({{ $d->kategori }})"><img src="{{ $d->file }}" alt="{{ $d->kategori }}" class="img-fluid" width="100px"></a>
                                                @else
                                                    <a href="https://www.youtube.com?v={{ $d->file }}" target="_blank"><img src="https://img.youtube.com/vi/{{ $d->file }}/default.jpg" width="100px" class="img-fluid"></a>
                                                @endif
                                            </td>
                                            <td>{{$d->kategori}}</td>
                                            <td>{{$d->keterangan}}</td>
                                            <td>
                                                <button style="width:40px; margin-top:5px" onclick="showModal('{{ route('admin.galeri-parawisata.show', $d->id) }}', {{ $d->id }})" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></button>
                                                <button onclick="hapus('<?= $d->id ?>')" style="width:40px; margin-top:5px" class="btn btn-info btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                            {{ $galeries->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- Modal Dertail -->
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="method"></div>

                        <div class="form-group">
                            <label for="keterangan">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control" onchange="changeKategori()">
                                <option value="" selected>Pilih Kategori</option>
                                <option value="foto">Foto</option>
                                <option value="video">Vidio</option>
                            </select>
                        </div>

                        <div id="data_edit"></div>
                        <div id="data_kategori"></div>


                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Unggah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    @include('layouts.toastr-notif')
    <script src="{{ url('/') }}/admin/assets/plugins/lightbox2/js/lightbox.js"></script>
    <script>
        function showModal(url, id=null) {
            if(id != null) {
                $.get("{{ route('admin.galeri-parawisata.index') }}/"+id, (result) => {
                    console.log(result)

                    $('#formModal .modal-title').text("Edit Galery");
                    $('#formModal form').attr("action", url);
                    $('#formModal form #method').html("<input type='hidden' name='_method' value='PUT'>");
                    $('#formModal #kategori').val(result.kategori);
                    changeKategori();

                    if(result.kategori == "foto") {
                        $('#formModal #data_edit').html(`<img src="${result.file}" alt="" class="img-fluid" width="100px">`);
                    } else {
                        $('#formModal #data_edit').html(`<iframe src="https://www.youtube.com/embed/${result.file}" width="100%" height="400px"></iframe>`);
                        $('#formModal #vidio_url').val(`${result.file}`);
                    }


                    $('#formModal').modal('show');
                });
            } else {
                $('#formModal .modal-title').text("Tambah Galery");
                $('#formModal form').attr("action", url);
                $('#formModal form #method').html('');
                $('#formModal').modal('show');
            }
        }


        function changeKategori() {
            let kategori = $('#kategori').val();

            if(kategori == "") {
                $('#formModal #data_kategori').html(``);
            } else if(kategori == "foto") {
                $('#formModal #data_kategori').html(`
                            <div class="text-center">
                                <div id="tampilFoto"></div>
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Foto</label>
                                <input type="file" name="thumbnail" id="thumbnail" onchange="tampilfoto()" class="form-control">
                            </div>
                        `);
            } else {
                $('#formModal #data_kategori').html(`
                            <div class="form-group">
                                <label for="vidio_url">Vidio</label>
                                <input type="text" id="vidio_url" class="form-control" onchange="getVideoIdYoutube($(this).val())" placeholder="Youtube Video Url">
                                <input type="hidden" name="vidio_url">
                            </div>
                        `);
            }
        }

        function getVideoIdYoutube(url) {
            let code = '';
            if(url.search("youtu.be") >= 0) {
                let url_split = url.split("/");
                code = url_split[url_split.length -1];
            } else {
                var url = new URL(url);
                code = url.searchParams.get("v") ?? null;
            }

            $('#formModal #data_edit iframe').attr('src', "https://youtube.com/embed/"+code)
            $('#formModal #data_kategori input[name=vidio_url]').val(code);
        }


        function tampilfoto()
        {
            var fileInput = document.getElementById('thumbnail');
            var filePath = fileInput.value;
            var extensions = /(\.jpg|\.jpeg|\.png)$/i;
            var ukuran = fileInput.files[0].size;
            if(ukuran > 1000000)
            {
                alert('ukuran terlalu besar. Maksimal 1MB')
                fileInput.value = '';
                document.getElementById('tampilFoto').innerHTML = '';
                    return false;
            }else{
                if(!extensions.exec(filePath)){
                    alert('Silakan unggah file yang memiliki ekstensi .jpg/.png.');
                    fileInput.value = '';
                    document.getElementById('tampilFoto').innerHTML = '';
                    return false;
                }else{
                    //Image preview
                    if (fileInput.files && fileInput.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('tampilFoto').innerHTML = '<img src="'+e.target.result+'" width="60%"/>';
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                }
            }
        }

        function hapus(id)
        {
            var pesan = confirm("Yakin Ingin Menghapus Data!");
            if(pesan){
                $.ajax({
                    url: "{{route('admin.galeri-parawisata.index')}}/"+id,
                    type:"DELETE",
                    dataType: "JSON",
                    data:{'id':id,"_token":"{{csrf_token()}}"},
                    success: function(data)
                    {
                        if(data.pesan == 'berhasil')
                        {
                            window.location.reload();
                        }
                    }
                })
            }
        }
    </script>
@endpush
