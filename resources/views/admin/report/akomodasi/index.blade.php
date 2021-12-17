@extends('admin.layouts.app')
@section('title', 'Admin')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Report Akomodasi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Report Akomodasi</li>
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
                            <a href="{{ route('admin.report.akomodasi.download') }}" class="btn btn-primary float-right">Download</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="15%" class="text-center">
                                        <img src="{{ url('admin/assets') }}/bg/kab-agam.png" alt="" width="50px">
                                    </td>
                                    <td class="text-center">
                                        <h5>REKAP DATA PENGUNJUNG AKOMODASI</h5>
                                        <h5>DINAS PARIWISATA KAB. AGAM</h5>
                                    </td>
                                    <td width="15%"></td>
                                </tr>
                            </table>
                            <hr><br>
                            <h6><b>TAHUN : {{ $data['periode'] }}</b> </h6><br>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:25%">Nama Akomodasi</th>
                                        @for ($i = 0; $i < 12; $i++)
                                            <th style="width:5%">{{ date('M', strtotime(date('Y-'. (($i < 9)? '0'.($i+1) : ($i+1))))) }}</th>
                                        @endfor
                                        <th class="text-right" style="width:15%">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach($data['data'] as $i => $d)
                                        @php
                                            $item_total = 0;
                                        @endphp
                                        <tr>
                                            <td>{{$d['nama_akomodasi']}}</td>

                                            @foreach ($d['data'] as $item)
                                                @php
                                                    $item_total += $item;
                                                    $total += $item;
                                                @endphp

                                                <td>{{ $item }}</td>
                                            @endforeach

                                            <td class="text-right">{{ $item_total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="13">Total</th>
                                        <th class="text-right">{{ $total }}</th>
                                    </tr>
                                </tfoot>
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
