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
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#tambah-kategori">Tambah Data</button>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Icon kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($kategoriAkomodasis as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->nama_kategori_akomodasi }}</td>
                                            <td><img src="{{ str_replace("public", "/storage", $item->icon_kategori_akomodasi) }}" alt="{{ $item->nama_kategori_akomodasi }}" class="img-fluid" width="100px"> </td>
                                            <td>
                                                <button type="button" class="btn btn-warning p-1"
                                                    onclick="edit({{ $item->id }})">Edit</button>
                                                <button type="button" class="btn btn-danger p-1" onclick="hapus(this, {{ $item->id }})">Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $kategoriAkomodasis->links() }}
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
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.kategori.form', ["url" => route("admin.kategori-akomodasi.store")])
                </div>
                {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-kategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.kategori.form', ["type" => "edit"])
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
        $(document).ready(function() {

            $("#btnCreate").click(function(event) {

                //stop submit the form, we will post it manually.
                event.preventDefault();

                // Get form
                var form = $('#tambah-kategori form');

                // Create an FormData object
                var data = new FormData(form[0]);
                    data.append('icon_kategori', $('#icon_kategori')[0].files);
                // console.log(data)

                // disabled the submit button
                $("#btnCreate").prop("disabled", true);

                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: form.attr("action"),
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 800000,
                    success: function(data) {
                        if(data.status) {
                            alert(data.msg);
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    },
                    error: function(e) {
                        alert(e.responseText);
                    }
                });
            });

            $("#edit-kategori #btnEdit").click(function(event) {
                //stop submit the form, we will post it manually.
                event.preventDefault();

                // Get form
                var form = $('#edit-kategori form');

                // Create an FormData object
                var data = new FormData(form[0]);
                    data.append('icon_kategori', $('#icon_kategori')[0].files);

                // disabled the submit button
                $("#btnEdit").prop("disabled", true);

                $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: form.attr("action"),
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 800000,
                    success: function(data) {

                        if(data.status) {
                            alert(data.msg);
                            location.reload();
                        } else {
                            alert(data.msg);
                        }

                    },
                    error: function(e) {

                        alert(e.responseText);

                    }
                });

            });

        });

        function edit(id) {
            $.get("{{ route('admin.kategori-akomodasi.index') }}/" + id, (result) => {
                console.log(result);

                $('#edit-kategori .modal-body form').attr("action",
                    "{{ route('admin.kategori-akomodasi.index') }}/" + id);

                $('#edit-kategori .modal-body form input[name=_method]').val("PUT");
                $('#edit-kategori .modal-body form input[name=nama_kategori]').val(result
                    .nama_kategori_akomodasi);
                $('#edit-kategori').modal('show')
            })
        }

        function hapus(btn, id) {
            $(btn).prop("disabled", true);
            let con = confirm("Apakah anda yakin ingin menghapus kategori ini?");

            if(con) {

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.kategori-akomodasi.index') }}/"+id,
                    data: '{_method:"DELETE", _token: "{{ csrf_token() }}"}',
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 800000,
                    success: function(data) {

                        if(data.status) {
                            alert(data.msg);
                            location.reload();
                        } else {
                            alert(data.msg);
                        }

                    },
                    error: function(e) {

                        alert(e.responseText);

                    }
                });
            } else {
                alert("Proses di batalkan")
            }
        }
    </script>
@endpush
