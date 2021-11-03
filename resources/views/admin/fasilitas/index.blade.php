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
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#tambah-fasilitas">Tambah Data</button>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Fasilitas</th>
                                        <th>Icon Fasilitas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($fasilitasAkomodasis as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->nama_fasilitas_akomodasi }}</td>
                                            <td><img src="{{ str_replace("app/public", "/storage", $item->icon_fasilitas_akomodasi) }}" alt="{{ $item->nama_fasilitas_akomodasi }}" class="img-fluid" width="100px"> </td>
                                            <td>
                                                <button type="button" class="btn btn-warning p-1"
                                                    onclick="edit({{ $item->id }})">Edit</button>
                                                <button type="button" class="btn btn-danger p-1" onclick="hapus(this, {{ $item->id }})">Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $fasilitasAkomodasis->links() }}
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
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.fasilitas.form', ["url" => route("admin.fasilitas-akomodasi.store")])
                </div>
                {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit-fasilitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Fasilitas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('admin.fasilitas.form', ["type" => "edit"])
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
                var form = $('#tambah-fasilitas form');

                // Create an FormData object
                var data = new FormData(form[0]);
                    data.append('icon_fasilitas', $('#icon_fasilitas')[0].files);
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

            $("#edit-fasilitas #btnEdit").click(function(event) {
                //stop submit the form, we will post it manually.
                event.preventDefault();

                // Get form
                var form = $('#edit-fasilitas form');

                // Create an FormData object
                var data = new FormData(form[0]);
                    data.append('icon_fasilitas', $('#icon_fasilitas')[0].files);

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
            $.get("{{ route('admin.fasilitas-akomodasi.index') }}/" + id, (result) => {
                console.log(result);

                $('#edit-fasilitas .modal-body form').attr("action",
                    "{{ route('admin.fasilitas-akomodasi.index') }}/" + id);

                $('#edit-fasilitas .modal-body form input[name=_method]').val("PUT");
                $('#edit-fasilitas .modal-body form input[name=nama_fasilitas]').val(result
                    .nama_fasilitas_akomodasi);
                $('#edit-fasilitas').modal('show')
            })
        }

        function hapus(btn, id) {
            $(btn).prop("disabled", true);
            let con = confirm("Apakah anda yakin ingin menghapus fasilitas ini?");

            if(con) {

                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.fasilitas-akomodasi.index') }}/"+id,
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
