<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pengunjung | Pesona Agam Beragam</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('admin/assets') }}/dist/css/adminlte.min.css">
</head>
<body>
    <style>
        @page {
            padding: 10px;
        }
        table > * {
            font-size: .9em;
        }
    </style>
    <div class="container-fluid">
        <table class="table table-borderless">
            <tr>
                <th class="text-center" width="20%">
                    <img src="{{ url('admin/assets') }}/bg/kab-agam.png" alt="" width="50px">
                </th>
                <th class="text-center">
                    <h5>REKAP DATA PENGUNJUNG</h5>
                    <h5>DINAS PARIWISATA KAB. AGAM</h5>

                </th>
                <th class="text-center" width="20%"></th>
            </tr>
        </table>
        <hr style="margin-bottom: 3px;border:.5px solid rgb(143, 143, 143);">
        <h5 class="text-center"><u>Report Akomodasi</u> </h5>
        <h6 class="text-center">Tahun : {{ $periode }} </h6><br>
        {{-- @dd($data) --}}
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
</body>
</html>
