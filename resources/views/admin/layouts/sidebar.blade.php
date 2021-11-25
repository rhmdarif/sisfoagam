<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ url('admin/assets') }}/dist/img/AdminLTELogo.png" alt="{{ auth()->user()->name ?? '' }}"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ auth()->user()->name ?? '' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('admin/assets') }}/dist/img/avatar2.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"></a>
        </div>
      </div> -->

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Akomodasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.master-data.akomodasi.fasilitas.index') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Fasilitas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.master-data.akomodasi.kategori.index') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Kategori</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Destinasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.master-data.destinasi-wisata.fasilitas.index') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Fasilitas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.master-data.destinasi-wisata.kategori.index') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Kategori</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Ekonomi Kreatif
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.master-data.ekonomi-kreatif.kategori.index') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Kategori</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.akomodasi.home') }}" class="nav-link">
                        <i class="nav-icon fas fa-hotel"></i>
                        <p>
                            Akomodasi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.destinasi-wisata.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-umbrella-beach"></i>
                        <p>
                            Destinasi Wisata
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.ekonomi-kreatif.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Ekonomi Kreatif
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.berita-parawisata.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Berita Parawisata
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.galeri-parawisata.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-photo-video"></i>
                        <p>
                            Galeri Parawisata
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.fasilitas-umum.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Fasilitas Umum
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.event-parawisata.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-day"></i>
                        <p>
                            Event Parawisata
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
