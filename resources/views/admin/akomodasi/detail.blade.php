@extends('admin.layouts.app')
@section('title', 'Akomodasi')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Akomodasi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Akomodasi</a></li>
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
                        <a href="{{ route('admin.akomodasi.home') }}" class="btn btn-secondary"> <i class="fas fa-backward"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <table id="" class="table table-borderless">
                            <thead>
                                @foreach($akomodasi as $item)
                                <tr>
                                    <th style="width:35%">Kategori</th>
                                    <th>{{ $item->nama_kategori_akomodasi }}</th>
                                </tr>
                                <tr>
                                    <th style="width:35%">Nama Akomodasi</th>
                                    <th>{{ $item->nama_akomodasi }}</th>
                                </tr>
                                <tr>
                                    <th style="width:35%">Kelas</th>
                                    <th>{{ $item->kelas }}</th>
                                </tr>
                                <tr>
                                    <th style="width:35%">Harga</th>
                                    <th>Rp. {{ number_format($item->harga) }} </th>
                                </tr>
                                <tr>
                                    <th style="width:35%; vertical-align:middle;">Thumbnail</th>
                                    <th>
                                        <img src="{{ $item->thumbnail_akomodasi }}" alt="{{ $item->thumbnail_akomodasi }}" class="img-fluid" width="100px">
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width:35%; vertical-align:middle; ">lokasi</th>
                                    <th>
                                        <iframe width="300" height="170" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=<?= $item->lat; ?>,<?= $item->long; ?>&hl=in&z=14&amp;output=embed"></iframe>
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

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        Review Akomodasi
                    </div>
                    <div class="card-body">
                        <table id="" class="table table-border">
                            <thead>
                                <th style="width:35%">Nama Reviewer</th>
                                <th style="width:35%">Tingkat Kepuasan</th>
                                <th style="width:35%">Komentar</th>
                                <th style="width:35%">Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($review_a as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->tingkat_kepuasan }}</td>
                                    <td>{{ $item->komentar }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="pull-right">
                            {{ $review_a->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>





@endsection