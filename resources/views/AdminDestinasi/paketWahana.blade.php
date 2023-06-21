<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paket {{ Auth::user()->name }}</title>

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
                            <a href="{{ url('admin-destinasi/wahana') }}" class="nav-link">
                                <i class="nav-icon fas fa-map-marker"></i>
                                <p>
                                    Wahana
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin-destinasi/paket-wahana') }}" class="nav-link bg-primary">
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
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <a data-toggle="modal" data-target="#myModal" class="btn btn-primary">Tambah Paket</a>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <section id="blog" class="blog">
                        <div class="container" data-aos="fade-up">
                            <div class="wahanaDestinasi align-items-center">
                                <div class="row">
                                    @foreach ($paket as $pak)
                                        <div class="col-sm-6">
                                            <div class="detailPaketDesti">
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <h2>{{ $pak['nama_paket'] }}</h2>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <a href="#"><button>Edit</button></a>
                                                    </div>
                                                </div>
                                                <div class="deskripsiPaketDesti">
                                                    <h3>{{ $pak['destinasi'] }}
                                                        ({{ str_replace('|', ' + ', $pak['wahana']) }})
                                                    </h3>
                                                    <p style="text-decoration: line-through white;">
                                                        Rp{{ $pak['harga_normal'] }}
                                                    </p>
                                                    <p style="font-size: 25px;">Rp{{ $pak['harga_paket'] }}</p>
                                                    <span>Limited</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- End detail paket destinasi -->
                                </div>
                            </div>
                        </div>
                    </section>

                    {{-- TAMBAH --}}
                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog" style="max-width: 1000px">
                            <div class="modal-content">
                                <!-- Header Modal -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Paket</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Body Modal -->
                                <div class="modal-body">
                                    <form action="{{ url('/admin-destinasi/tambah-paket') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama_paket" class="col-form-label">Nama *</label>
                                            <div>
                                                <input type="text" class="form-control" name="nama_paket"
                                                    placeholder="Masukkan Nama">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="destinasi" class="col-form-label">Destinasi</label>
                                            <div>
                                                <input type="text" class="form-control" name="destinasi"
                                                    placeholder="Masukkan Nama"
                                                    value="{{ $destinasi['nama_destinasi'] }}" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Wahana *</label>
                                            @foreach ($wahana as $wah)
                                                <div>
                                                    <input type="checkbox" id="checkbox{{ $wah['id'] }}"
                                                        name="checkbox[]" value="{{ $wah['nama_wahana'] }}"
                                                        data-price="{{ $wah['htm_wahana'] }}">
                                                    {{ $wah['nama_wahana'] }}
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_paket" class="col-form-label">Harga (sudah termasuk
                                                tiket masuk) *</label>
                                            <div>
                                                <input type="number" class="form-control" name="harga_paket"
                                                    id="harga_paket" placeholder="Gratis isi 0(nol)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_normal" class="col-form-label">Harga Normal</label>
                                            <div>
                                                <input type="number" class="form-control" name="harga_normal"
                                                    id="total-price" placeholder="0" readonly>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
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

    <script>
        // Mengambil elemen checkbox
        var checkboxes = document.querySelectorAll('input[name="checkbox[]"]');
        var ticketPrice = <?php echo $destinasi['htm_destinasi']; ?>; // Harga tiket masuk (ganti dengan harga yang sesuai)

        // Menambahkan event listener pada setiap checkbox
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                calculateTotalPrice();
            });
        });

        // Fungsi untuk menghitung total harga dan menampilkan hasilnya
        function calculateTotalPrice() {
            var totalPrice = 0;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    var price = parseFloat(checkbox.getAttribute('data-price'));
                    totalPrice += price;
                }
            });

            // Menambahkan harga tiket masuk ke total harga
            totalPrice += ticketPrice;

            // Menampilkan total harga
            document.getElementById('total-price').value = totalPrice;

            // Mendapatkan elemen input dengan ID 'harga_paket'
            var numberInput = document.getElementById('harga_paket');

            // Mengatur atribut max pada elemen input dengan nilai totalPrice
            numberInput.setAttribute('max', totalPrice);

            // Mencetak nilai atribut max pada konsol
            console.log(numberInput.getAttribute('max'));
        }
    </script>
</body>

</html>
