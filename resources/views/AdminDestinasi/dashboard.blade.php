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
                            <a href="{{ url('admin-destinasi') }}" class="nav-link bg-primary">
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
                            <a href="{{ url('admin-destinasi/wahana') }}" class="nav-link">
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
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <h3 class="profile-username text-center"><b>Destinasi {{ $profil['nama_destinasi'] }}</b>
                            </h3>
                            <div class="d-flex justify-content-center">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"
                                    style="height: 350px; width: 656.25px; position: relative; overflow: hidden; background-repeat: no-repeat; background-size: cover; background-position: center; z-index: 1;">
                                    <ol class="carousel-indicators">
                                        @foreach ($foto as $key => $image)
                                            <li data-target="#carouselExampleIndicators"
                                                data-slide-to="{{ $key }}"
                                                @if ($key == 0) class="active" @endif></li>
                                        @endforeach
                                    </ol>
                                    <div class="carousel-inner">
                                        @foreach ($foto as $key => $image)
                                            <div class="carousel-item @if ($key == 0) active @endif">
                                                <img src="{{ asset('images/' . $image) }}" class="d-block w-100"
                                                    alt="Image {{ $key }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>

                            @foreach ($kategori as $key => $kate)
                                @if ($profil['kategori_id'] == $kate['id'])
                                    <h4 class="profile-username text-center">Kategori {{ $kate['nama_kategori'] }}
                                    </h4>
                                @endif
                            @endforeach

                            <h4 class="profile-username">Deskripsi</h4>
                            <p class="text-muted">{!! $profil['deskripsi_destinasi'] !!}</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="profile-username">Alamat</h4>
                                    <p class="text-muted">{{ $profil['alamat_destinasi'] }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="profile-username">HTM</h4>
                                    <p class="text-muted">Rp.{{ $profil['htm_destinasi'] }}</p>
                                </div>
                            </div>
                            <a class="btn btn-primary" data-toggle="modal"
                                data-target="#myEdit{{ Auth::user()->id }}"><b>Edit</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    {{-- EDIT --}}
                    <div class="modal fade" id="myEdit{{ Auth::user()->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="myEditLabel{{ Auth::user()->id }}" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 1000px">
                            <div class="modal-content">
                                <!-- Header Modal -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Profil Destinasi</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Body Modal -->
                                <div class="modal-body">
                                    <form action="{{ url('/admin-destinasi/edit-profil', $profil['id']) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="nama_destinasi"
                                                class="col-sm-2 col-form-label">Destinasi</label>
                                            <input type="text" class="form-control" name="nama_destinasi"
                                                id="nama_destinasi" placeholder="Nama Admin"
                                                value="{{ $profil['nama_destinasi'] }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori_id" class="col-form-label">Kategori</label>
                                            <div>
                                                <select class="form-control" name="kategori_id" id="kategori_id">
                                                    @foreach ($kategori as $item)
                                                        @if ($item['id'] == $profil['kategori_id'])
                                                            <option value="{{ $item['id'] }}" selected>
                                                                {{ $item['nama_kategori'] }}</option>
                                                        @else
                                                            <option value="{{ $item['id'] }}">
                                                                {{ $item['nama_kategori'] }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="fotoDestinasi" class="col-form-label">Foto</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input"
                                                        id="fotoDestinasi" name="foto_destinasi[]" multiple>
                                                    <label class="custom-file-label" for="fotoDestinasi">Choose
                                                        multiple file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                            <input type="text" class="form-control" name="alamat_destinasi"
                                                id="alamat" placeholder="Nama Admin"
                                                value="{{ $profil['alamat_destinasi'] }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi_destinasi" id="deskripsi" rows="10"
                                                placeholder="Masukkan Deskripsi">{{ $profil['deskripsi_destinasi'] }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="htm_destinasi" class="col-form-label">HTM</label>
                                            <div>
                                                <input type="number" class="form-control" name="htm_destinasi"
                                                    placeholder="Harga Tiket" value="{{ $profil['htm_destinasi'] }}">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </section>
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
    </script>
</body>

</html>
