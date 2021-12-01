@extends('admin.layouts.app')
@section('title', 'Home')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0"> <marquee>SELAMAT DATANG DI MENU ADMIN SISFO AGAM . . . !</marquee></h1>
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
              <a href="{{ route('admin.akomodasi.home') }}" class="small-box-footer">Go <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="{{ route('admin.destinasi-wisata.index') }}" class="small-box-footer">Go <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="{{ route('admin.ekonomi-kreatif.index') }}" class="small-box-footer">Go <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="{{ route('admin.berita-parawisata.index') }}" class="small-box-footer">Go <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="{{ route('admin.fasilitas-umum.index') }}" class="small-box-footer">Go <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="{{ route('admin.event-parawisata.index') }}" class="small-box-footer">Go <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="{{ route('admin.admin.index') }}" class="small-box-footer">Go <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        

        </div>
    </div>
</div>



@endsection