@extends('admin.layouts.app')
@section('title', 'Home')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Fasilitas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Fasilitas</li>
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
                            <button type="button" class="btn btn-primary" onclick="tampil()">Tambah Data</button>
                        </div>
                        <div class="card-body">
                            <table class="table" id="table1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:2%">No</th>
                                        <th style="width:40%">Nama Fasilitas</th>
                                        <th style="width:38%">Icon Fasilitas</th>
                                        <th style="width:20%%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fasilitasAkomodasis as $i => $item)
                                        <tr>
                                            <td>{{ $i+1 }}</td>
                                            <td>{{ $item->nama_fasilitas_akomodasi }}</td>
                                            <td><img src="{{ asset('storage/fasilitas_akomodasi/'. $item->icon_fasilitas_akomodasi) }}" alt="{{ $item->nama_fasilitas_akomodasi }}" class="img-fluid" width="60px"> </td>
                                            <td>
                                                <button style="width:80px;color:white" type="button" class="btn btn-warning p-1"
                                                    onclick="edits({{ $item->id }})">Edit</button>
                                                <button style="width:80px" type="button" class="btn btn-danger p-1" onclick="deletes({{ $item->id }})">Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- Modal -->
    <div class="modal fade" id="tambah-fasilitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><div id="title"></div></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.fasilitas.form')
                </div>
                {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function tampil()
        {
            $('#tambah-fasilitas').modal()
            $('#title').html('Tambah Data')
            $('#btnNama').html('Tambah')
        }

        function simpan()
        {
            var icon_fasilitas = $('#icon_fasilitas').prop('files')[0];
            var nama_fasilitas = $('#nama_fasilitas').val();
            var id = $('#id').val();
            var form_data = new FormData();

            form_data.append("_token", "{{ csrf_token() }}");
            form_data.append("_method", "POST");
            form_data.append('icon_fasilitas', icon_fasilitas);
            form_data.append('nama_fasilitas', nama_fasilitas);
            form_data.append('id', id);

            $.ajax({
                type: "POST",
                url: "{{route('fasilitas.tambah')}}",
                contentType: 'multipart/form-data',
                data: form_data,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function(data) {
                    location.reload();
                    console.log(data);
                },
                error: function(e) {
                    console.log(e.responseText);
                }
            });
        }

        function edits(id)
        {
            $.ajax({
                url:'{{route("fasilitas.edit")}}',
                type:'post',
                data:{
                    'id':id,
                    '_token': "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    $('#nama_fasilitas').val(data.data.nama_fasilitas_akomodasi)
                    $('#tampilFoto').html(`<img src="{{ asset('storage/fasilitas_akomodasi/${data.data.icon_fasilitas_akomodasi}') }}" width="30%"/>`)
                    $('#id').val(data.data.id)
                    $('#label').html("Edit Data")
                    $('#btnNama').html("Edit")
                    $('#tambah-fasilitas').modal('show');
                }
            })
        }

        function deletes(id)
        {
            var ids = id;
            var pesan = confirm("Yakin Ingin Menghapus Data!");
            if(pesan){
                $.ajax({
                    url:"{{ route('fasilitas.delete') }}",
                    type:'POST',
                    data: {
                        id:id,
                        '_token': "{{ csrf_token() }}"
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        location.reload();
                    }
                })
            }
        }

        function tampilfoto()
        {
            var fileInput = document.getElementById('icon_kategori');
            var filePath = fileInput.value;
            var extensions = /(\.jpg|\.png)$/i;
            var ukuran = fileInput.files[0].size;
            if(ukuran > 100000)
            {
                alert('ukuran terlalu besar. Maksimal 100KB')
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
                            document.getElementById('tampilFoto').innerHTML = '<img src="'+e.target.result+'" width="30%"/>';
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                }
            }
        }
    </script>
@endpush
