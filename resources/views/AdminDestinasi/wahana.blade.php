<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard {{ Auth::user()->name }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ url('AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ url('AdminLTE/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('AdminLTE/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('AdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ url('AdminLTE/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('admin-destinasi') }}" class="brand-link">
                <img src="{{ url('img/favicon.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-1"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Pesona Desa</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ url('admin-destinasi') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin-destinasi/konfirmasi-tiket') }}" class="nav-link">
                                <i class="nav-icon fas fa-ticket-alt"></i>
                                <p>
                                    Konfirmasi Tiket
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin-destinasi/wahana') }}" class="nav-link bg-primary">
                                <i class="nav-icon fas fa-map-marker"></i>
                                <p>
                                    Wahana
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin-destinasi/paket-wahana') }}" class="nav-link">
                                <i class="nav-icon fas fa-box"></i>
                                <p>
                                    Paket Wahana
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('logout') }}" class="nav-link bg-danger">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Log Out
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <a data-toggle="modal" data-target="#myModal" class="btn btn-primary">Tambah Wahana</a>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section id="blog" class="blog">
                <div class="container" data-aos="fade-up">
                    <div class="wahanaDestinasi align-items-center">
                        <div class="row">
                            @foreach ($wahana as $w)
                                <div class="col-sm-6">
                                    <div class="detailWahana">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div id="carouselExampleSlidesOnly" class="carousel slide post-img"
                                                    data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @foreach (explode('|', $w['foto_wahana']) as $key => $image)
                                                            <div
                                                                class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                                <img src="{{ asset('images/' . $image) }}"
                                                                    class="d-block w-100">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <h4>{{ $w->nama_wahana }}</h4>
                                                <p>{!! $w->deskripsi_wahana !!}</p>

                                                <h4>HTM</h4>
                                                @if ($w->htm_wahana == 0)
                                                    <p>Gratis</p>
                                                @else
                                                    <p>Rp {!! $w->htm_wahana !!}</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="hover_Text d-flex align-items-end justify-content-between">
                                            <div class="row">
                                                <div class="hover_text_iner col-sm-6">
                                                    <a data-toggle="modal" data-target="#myEdit{{ $w['id'] }}"
                                                        data-id="{{ $w['id'] }}"><i class="fas fa-edit"></i></a>
                                                </div>
                                                <div class="hover_text_iner col-sm-6">
                                                    <a href="{{ url('/admin-destinasi/hapus-wahana', $w['id']) }}"><i
                                                            class="fas fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- TAMBAH --}}
                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog" style="max-width: 1000px">
                                <div class="modal-content">
                                    <!-- Header Modal -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Wahana</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Body Modal -->
                                    <div class="modal-body">
                                        <form action="{{ url('/admin-destinasi/tambah-wahana') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name" class="col-form-label">Nama</label>
                                                <div>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Masukkan Nama">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="harga" class="col-form-label">Harga</label>
                                                <div>
                                                    <input type="number" class="form-control" name="harga"
                                                        placeholder="Gratis isi 0(nol)">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="fotoWahana" class="col-form-label">Foto</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            id="fotoWahana" name="foto_wahana[]" multiple>
                                                        <label class="custom-file-label" for="fotoWahana">Choose
                                                            file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="deskripsi" class="col-form-label">Deskripsi</label>
                                                <div>
                                                    <textarea class="form-control" name="deskripsi_wahana" id="deskripsi" rows="3"
                                                        placeholder="Masukkan Deskripsi"></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- EDIT --}}
                        @foreach ($wahana as $wah)
                            <div class="modal fade" id="myEdit{{ $wah['id'] }}" tabindex="-1" role="dialog"
                                aria-labelledby="myEditLabel{{ $wah['id'] }}" aria-hidden="true">
                                <div class="modal-dialog" style="max-width: 1000px">
                                    <div class="modal-content">
                                        <!-- Header Modal -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Wahana</h4>
                                            <button type="button" class="close"
                                                data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Body Modal -->
                                        <div class="modal-body">
                                            <form action="{{ url('/admin-destinasi/edit-wahana', $wah['id']) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="name" class="col-form-label">Nama</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="nama_wahana"
                                                            placeholder="Masukkan Nama Wahana"
                                                            value="{{ $wah['nama_wahana'] }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="fotoWahana" class="col-form-label">Foto</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="fotoWahana" name="foto_wahana[]" multiple>
                                                            <label class="custom-file-label" for="fotoWahana">Choose
                                                                multiple file</label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="htm_wahana" class="col-form-label">HTM</label>
                                                    <div>
                                                        <input type="number" class="form-control" name="htm_wahana"
                                                            placeholder="Harga Tiket"
                                                            value="{{ $wah['htm_wahana'] }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="deskripsi" class="col-form-label">Deskripsi</label>
                                                    <div>
                                                        <textarea class="form-control" name="deskripsi_wahana" id="deskripsiEdit{{ $wah['id'] }}" rows="3"
                                                            placeholder="Masukkan Deskripsi">{{ $wah['deskripsi_wahana'] }}</textarea>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <div class="d-flex justify-content-center">
                {{ $wahana->links() }}
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ url('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ url('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ url('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ url('AdminLTE/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ url('AdminLTE/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ url('AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ url('AdminLTE/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ url('AdminLTE/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ url('AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ url('AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ url('AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ url('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('AdminLTE/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('AdminLTE/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ url('AdminLTE/dist/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function() {
            CKEDITOR.replace('deskripsi')
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        })
        $(function() {
            @foreach ($wahana as $wah)
                CKEDITOR.replace('deskripsiEdit' + {{ $wah['id'] }})
                //bootstrap WYSIHTML5 - text editor
            @endforeach
            $('.textarea').wysihtml5()
        })
    </script>
</body>

</html>
