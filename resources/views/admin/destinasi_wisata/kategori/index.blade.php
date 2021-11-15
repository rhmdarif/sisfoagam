@extends('admin.layouts.app')
@section('title', 'Home')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kategori</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kategori</li>
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
                                        <th style="width:40%">Nama Kategori</th>
                                        <th style="width:40%">Icon kategori</th>
                                        <th style="width:18%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategoriAkomodasis as $i => $item)
                                        <tr>
                                            <td>{{ $i+1 }}</td>
                                            <td>{{ $item->nama_kategori_akomodasi }}</td>
                                            <td><img src="{{ asset('storage/kategori_akomodasi/'.$item->icon_kategori_akomodasi) }}" alt="{{ $item->nama_kategori_akomodasi }}" class="img-fluid" width="60px"> </td>
                                            <td>
                                                <button style="width:80px; color:white" type="button" class="btn btn-warning p-1"
                                                    onclick="edits('{{ $item->id }}')">Edit</button>
                                                <button style="width:80px" type="button" class="btn btn-danger p-1" onclick="deletes( {{ $item->id }} )">Hapus</button>
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
    <div class="modal fade" id="tambah-kategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <div id="label"></div>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.akomodasi.kategori.form')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>

        function tampil()
        {
            $('#label').html("Tambah Data")
            $('#btnNama').html("Tambah")
            $('#tambah-kategori').modal('show');
        }

        $('#tambah').click(function(){
            var icon_kategori = $('#icon_kategori').prop('files')[0];
            var nama_kategori = $('#nama_kategori').val();
            var id = $('#id').val();
            let form_data = new FormData();

            form_data.append("_token", "{{ csrf_token() }}");
            form_data.append('id', id);
            form_data.append('icon_kategori', icon_kategori);
            form_data.append('nama_kategori', nama_kategori);

            $.ajax({
                type: "POST",
                url: "{{route('master-data.kategori.tambah')}}",
                contentType: 'multipart/form-data',
                data: form_data,
                processData: false,
                dataType: 'JSON',
                success: function(data) {
                    location.reload();
                    console.log(data);
                },
                error: function(e) {
                    console.log(e.responseText);
                }
            });
        })

        function edits(id)
        {
            $.ajax({
                url:'{{route("master-data.kategori.edit")}}',
                type:'post',
                data:{
                    'id':id,
                    '_token': "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    $('#nama_kategori').val(data.data.nama_kategori_akomodasi)
                    $('#tampilFoto').html(`<img src="{{ asset('storage/kategori_akomodasi/${data.data.icon_kategori_akomodasi}') }}" width="30%"/>`)
                    $('#id').val(data.data.id)
                    $('#label').html("Edit Data")
                    $('#btnNama').html("Edit")
                    $('#tambah-kategori').modal('show');
                }
            })
        }

        function deletes(id)
        {
            var ids = id;
            var pesan = confirm("Yakin Ingin Menghapus Data!");
            if(pesan){
                $.ajax({
                    url:"{{ route('master-data.kategori.delete') }}",
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
