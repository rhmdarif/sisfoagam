@extends('admin.layouts.app')
@section('title', 'Akomodasi')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('admin/assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ url('admin/assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <link type="text/css" rel="stylesheet" href="{{ url('/') }}/admin/assets/plugins/image-uploader/image-uploader.min.css">
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Akomodasi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Akomodasi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    {{-- @dd($data) --}}
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline card-primary">
                        <div class="card-body">
                            <form action="{{ route('admin.akomodasi.tambah') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $data->id }}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Kategori</label>
                                            <select name="kategori" id="kategori" class="form-control">
                                                <option value="">-PILIH KATEGORI-</option>
                                                @foreach ($kategori as $a)
                                                    <option value="{{ $a->id }}" {{ ($data->kategori_akomodasi_id == $a->id)? "selected" : "" }}>{{ $a->nama_kategori_akomodasi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Akomodasi</label>
                                            <input type="text" name="akomodasi" id="akomodasi" class="form-control" value="{{ $data->nama_akomodasi }}"
                                                placeholder="Akomodasi">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Kelas</label>
                                            <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Kelas" value="{{ $data->kelas }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Tipe</label>
                                            <input type="text" name="tipe" id="tipe" class="form-control" placeholder="Tipe" value="{{ $data->tipe }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Harga</label>
                                            <input type="text" name="harga" id="harga" class="form-control" placeholder="Harga" value="{{ $data->harga ?? 0 }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Thumbnail</label>
                                            <input type="file" name="thumbnail" id="thumbnail"
                                                onchange="return tampilfoto()" class="form-control">
                                            <input type="hidden" id="lat" class="form-control" value="{{ $data->lat }}">
                                            <input type="hidden" id="lng" class="form-control" value="{{ $data->long }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div style="margin-top:30px" id="tampilFoto">
                                            <img src="{{ storage_url($data->thumbnail_akomodasi) }}" width="60%"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Fasilitas</label>
                                            <button type="button" class="btn btn-sm btn-primary float-right mb-2" onclick="tampil_fasilitas()">Tambah</button>
                                            <select name="fasilitas[]" id="fasilitas" class="form-control sl2multi" multiple style="width: 100% !important"></select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" class="note">{{ $data->keterangan }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Lokasi</label>
                                            <div style="height: 337px;" id="map"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input-images"></div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
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
                    @include('admin.master_data.akomodasi.fasilitas.form')
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
    <!-- Select2 -->
    <script src="{{ url('admin/assets') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ url('/') }}/admin/assets/plugins/image-uploader/image-uploader.min.js"></script>
    <script>


        function loadMedia() {
                // $.get("{{ route('admin.akomodasi.media', $data->id) }}", (result) => {
                //     console.log(result);
                    let json = {!! json_encode($data->fotovideo) !!}
                    let preloaded = [];

                    json.forEach((e, i) => {
                        preloaded.push({id: e.id, src: "{{ url('/') }}/storage/foto_video_akomodasi/"+e.file});
                    });

                    $('.input-images').imageUploader({
                        preloaded: preloaded,
                        imagesInputName: 'photos',
                        preloadedInputName: 'old'
                    });

                //     console.log(preloaded);
                // })
            }

        $(document).ready(() => {
            // $('.input-images').imageUploader({ imagesInputName: 'photos' });

            loadMedia();
            // let preloaded = [
            //     {id: 1, src: 'https://picsum.photos/500/500?random=1'},
            //     {id: 2, src: 'https://picsum.photos/500/500?random=2'},
            //     {id: 3, src: 'https://picsum.photos/500/500?random=3'},
            //     {id: 4, src: 'https://picsum.photos/500/500?random=4'},
            //     {id: 5, src: 'https://picsum.photos/500/500?random=5'},
            //     {id: 6, src: 'https://picsum.photos/500/500?random=6'},
            // ];

            // $('.input-images-2').imageUploader({
            //     preloaded: preloaded,
            //     imagesInputName: 'photos',
            //     preloadedInputName: 'old'
            // });

            //Initialize Select2 Elements
            // $('.select2bs4').select2({
            //     theme: 'bootstrap4'
            // })

            $('select.sl2multi').select2({
                ajax: {
                    url: "{{ route('admin.select2.fasilitas-akomodasi') }}",
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            search: params.term,
                            type: 'public'
                        }

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;

                        return {
                            results: data.result,
                            pagination: {
                                more: (params.page * 10) < data.count_filtered
                            }
                        };
                    }
                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                }
            });

            fasilitas_selected();
        });

        function fasilitas_selected() {

            // Fetch the preselected item, and add to the control
            var fasilitasSelect = $('select.sl2multi');
            $.ajax({
                type: 'GET',
                url: '{{ route("admin.akomodasi.fasilitas_select2", $data->id) }}'
            }).then(function (data) {
                console.log(data)
                // create the option and append to Select2
                data.forEach(e => {
                    let option = new Option(e.text, e.id, true, true);
                    fasilitasSelect.append(option).trigger('change');
                });
            });
        }

        var harga = new AutoNumeric('#harga', {
            currencySymbol: 'Rp.',
            decimalCharacter: ',',
            digitGroupSeparator: '.',
        });

        function tampil() {
            $('#tampilFoto').html(`<img src="../img/noimages.png" width="60%"/>`)
            $('#addAkomoadasi').modal('show')
            $('#title').html('Tambah Akomodasi')
        }

        function tampil_fasilitas()
        {
            $('#tambah-fasilitas').modal()
            $('#tambah-fasilitas #title').html('Tambah Data')
            $('#tambah-fasilitas #btnNama').html('Tambah')
        }

        function simpan_fasilitas()
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
                url: "{{route('admin.master-data.akomodasi.fasilitas.store')}}",
                contentType: 'multipart/form-data',
                data: form_data,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function(data) {
                    // location.reload();
                    alert("Fasilitas berhasil ditambahkan")
                    $('#tambah-fasilitas').modal('hide')
                    console.log(data);
                },
                error: function(e) {
                    console.log(e.responseText);
                }
            });
        }

        function fasilitas(id) {
            $.ajax({
                url: "{{ route('admin.akomodasi.fasilitas') }}",
                type: "POST",
                dataType: "HTML",
                data: {
                    'id': id,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(res) {
                    $('#isiTabel').html(res)
                    $('#addFasilitas').modal('show');
                }
            })
        }

        function tambahFasilitas() {
            $('#tambahfasilitas').modal('show')
        }

        var map = L.map('map').setView([0, 0], 13);
        var marker = L.marker([0, 0]).addTo(map);
        var popup = L.popup();
        var markersLayer = new L.LayerGroup();
        map.addLayer(markersLayer);

        var controlSearch = new L.Control.Search({
            position: 'topright',
            layer: markersLayer,
            initial: false,
            zoom: 18,
            marker: false
        });



        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            // tileSize: 512,
            // zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZ2VtYWZhamFyMDkiLCJhIjoiY2t2cTZuNWN6MGVkNzJwcXBzdnlta2Q1aSJ9.6KTCVYzFPCs6Qwn6WyVazw'
        }).addTo(map);

        function klik(e) {
            // alert("kordiant" + e.latlng.lat);
            popup
                .setLatLng(e.latlng)
                .setContent(e.latlng.toString())
                .openOn(map);
            if (marker) {
                map.removeLayer(marker);
            }
            $('#lat').val(e.latlng.lat)
            $('#lng').val(e.latlng.lng)
            // marker.setLatLng(e.latlng);
            marker = new L.Marker(e.latlng).addTo(map);
        }

        function showLocation() {

            // pas lokasi basobok, jalankan kode yg ado didalam function ko
            var geolocation = navigator.geolocation.getCurrentPosition(function(pos) {
                // kode dibawah ko dijalankan pas posisi gps basobok
                var lat = pos.coords.latitude; // ambiak lat gps
                var lng = pos.coords.longitude; // ambiak lng gps
                map.addControl(controlSearch);
                map.setView([lat, lng]); // ubah tampilan posisi peta ke posisi gps
                marker.setLatLng([lat, lng]); // pindahkan posisi marker ke posisi gps
            });

        }

        map.on('click', klik);

        showLocation()

        function tampilfoto() {
            var fileInput = document.getElementById('thumbnail');
            var filePath = fileInput.value;
            var extensions = /(\.jpg|\.png)$/i;
            var ukuran = fileInput.files[0].size;
            if (ukuran > 1000000) {
                alert('ukuran terlalu besar. Maksimal 1MB')
                fileInput.value = '';
                document.getElementById('tampilFoto').innerHTML = '';
                return false;
            } else {
                if (!extensions.exec(filePath)) {
                    alert('Silakan unggah file yang memiliki ekstensi .jpg/.png.');
                    fileInput.value = '';
                    document.getElementById('tampilFoto').innerHTML = '';
                    return false;
                } else {
                    //Image preview
                    if (fileInput.files && fileInput.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('tampilFoto').innerHTML = '<img src="' + e.target.result +
                                '" width="60%"/>';
                        };
                        reader.readAsDataURL(fileInput.files[0]);
                    }
                }
            }
        }
    </script>
@endpush
