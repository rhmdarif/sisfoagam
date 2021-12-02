@extends('admin.layouts.app')
@section('title', 'Akomodasi')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Berita Pariwisata</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Berita Pariwisata</a></li>
                    <li class="breadcrumb-item active">Detail</li>
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
                        <!-- <a href="{{ route('admin.akomodasi.home') }}" class="btn btn-secondary"> <i class="fas fa-backward"></i> Kembali</a> -->
                    </div>
                    <div class="card-body">
                        <table id="" class="table table-borderless">
                            <thead>
                                @foreach($berita_parawisata as $item)
                                <tr>
                                    <th style="width:35%">Judul</th>
                                    <th>{{ $item->judul }}</th>
                                </tr>
                                <tr>
                                    <th style="width:35%">Sort Narasi</th>
                                    <th>{{ substr(strip_tags($item->narasi), 0, 100) }}{{ strlen($item->narasi) > 100? "..." : "" }}</th>
                                </tr>
                                <tr>
                                    <th style="width:35%">Posting By</th>
                                    <th>{{ $item->posting_by }}</th>
                                </tr>
                                <tr>
                                    <th style="width:35%">Posted At</th>
                                    <th>{{ $item->created_at}}</th>
                                </tr>
                                <tr>
                                    <th style="width:35%; vertical-align:middle;">Thumbnail</th>
                                    <th>
                                    <img src="{{ $item->foto }}" alt="{{ $item->judul }}" class="img-fluid" width="100px">
                                    </th>
                                </tr>

                                @endforeach
                            </thead>
                            <tbody>

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


@endsection
