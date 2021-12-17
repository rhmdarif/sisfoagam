@extends('admin.layouts.app')
@section('title', 'Home')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">
                        <marquee>SELAMAT DATANG DI MENU ADMIN AGAM PESONA BERAGAM . . . !</marquee>
                    </h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>1</h3>

                            <p>Akomodasi</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-hotel"></i>
                        </div>
                        <a href="{{ route('admin.akomodasi.home') }}" class="small-box-footer">Go <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>2<sup style="font-size: 20px"></sup></h3>

                            <p>Destinasi Wisata</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-umbrella-beach"></i>
                        </div>
                        <a href="{{ route('admin.destinasi-wisata.index') }}" class="small-box-footer">Go <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>3</h3>

                            <p>Ekonomi Kreatif</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-store"></i>
                        </div>
                        <a href="{{ route('admin.ekonomi-kreatif.index') }}" class="small-box-footer">Go <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>4</h3>

                            <p>Berita Pariwisata</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-newspaper"></i>
                        </div>
                        <a href="{{ route('admin.berita-parawisata.index') }}" class="small-box-footer">Go <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>


                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>5</h3>

                            <p>Fasilitas Umum</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-box-open"></i>
                        </div>
                        <a href="{{ route('admin.fasilitas-umum.index') }}" class="small-box-footer">Go <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>6<sup style="font-size: 20px"></sup></h3>

                            <p>Event Pariwisata</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-calendar-day"></i>
                        </div>
                        <a href="{{ route('admin.event-parawisata.index') }}" class="small-box-footer">Go <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>7</h3>

                            <p>User Admin</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-users"></i>
                        </div>
                        <a href="{{ route('admin.admin.index') }}" class="small-box-footer">Go <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>



            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4>Statistik Pengunjung</h4>
                            <div class="chart">
                                <canvas id="areaChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4>Statistik Perangkat</h4>
                            <canvas id="donutChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('js')

    <!-- ChartJS -->
    <script src="{{ url('/') }}/admin/assets/plugins/chart.js/Chart.min.js"></script>

    <script>
        //--------------
        //- AREA CHART -
        //--------------

        var areaChartData;
        $(document).ready(async () => {
            await $.get("{{ route('admin.chart') }}", (result) => {
                lineDataset = [];


                let legends = ['mobile', 'tablet', 'desktop'];
                let options = {
                    "mobile": {
                        backgroundColor: '#2E4C6D',
                        borderColor: '#396EB0',
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                    },
                    "tablet": {
                        backgroundColor: '#D0CAB2',
                        borderColor: '#96C7C1',
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                    },
                    "desktop": {
                        backgroundColor: '#FFE699',
                        borderColor: '#F1CA89',
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                    },
                };

                let labels = [];
                result.line.forEach((d) => {
                    labels.push(d['periode_format'])
                });

                legends.forEach((l, i) => {
                    let data = [];
                    console.log(data);

                    result.line.forEach((d) => {
                        data.push(d[l])
                    });
                    lineDataset.push({
                            label: l,
                            backgroundColor: options[l].borderColor,
                            borderColor: options[l].borderColor,
                            fill: false,
                            data: data,
                        }
                    );
                });

                areaChartData = {
                    labels: labels,
                    datasets: lineDataset
                }
                console.log(areaChartData);


                // Get context with jQuery - using jQuery's .get() method.
                var areaChartCanvas = $('#areaChart').get(0).getContext('2d')


                var areaChartOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: true
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false,
                            }
                        }],
                        yAxes: [{
                            gridLines: {
                                display: false,
                            }
                        }]
                    }
                }

                // This will get the first returned node in the jQuery collection.
                new Chart(areaChartCanvas, {
                    type: 'line',
                    data: areaChartData,
                    options: areaChartOptions
                });

                //-------------
                //- DONUT CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var donutChartCanvas = $('#donutChart').get(0).getContext('2d')

                var pie_label = Object.keys(result.pie);
                var pie_data = Object.values(result.pie);

                var donutData = {
                    labels: pie_label,
                    datasets: [{
                        data: pie_data,
                        backgroundColor: ['#00a65a', '#f39c12', '#f56954', '#d2d6de',
                            '#3c8dbc', '#00c0ef', '#000'
                        ],
                    }]
                }
                var donutOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                new Chart(donutChartCanvas, {
                    type: 'doughnut',
                    data: donutData,
                    options: donutOptions
                });
            })
        })
    </script>
@endpush
