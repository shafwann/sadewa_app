<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Daftar Admin</title>
    <link href="{{ url('assets/img/Logo.png') }}" rel="icon" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('stisla/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('style')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->
</head>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Header -->
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a class="nav-link nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('stisla/img/avatar/avatar-1.png') }}"
                                class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::getUser()->name }}</div>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar -->
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ url('admin-kabupaten') }}">
                            <span class="brand-text">Sadewa</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a class="nav-link" href="{{ url('admin-kabupaten') }}"><i class="fas fa-fire"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li class="active">
                            <a class="nav-link" href="{{ url('admin-kabupaten/daftar-admin') }}"><i
                                    class="fas fa-user"></i>
                                <span>Daftar Admin</span></a>
                        </li>
                        <li>
                            <a href="{{ url('admin-kabupaten/destinasi') }}" class="nav-link"><i
                                    class="fas fa-map-marker-alt"></i>
                                <span>Destinasi</span></a>
                        </li>
                        <div class="dropdown-divider"></div>
                        <li>
                            <a href="{{ url('logout') }}" class="nav-link has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>

                    <div class="hide-sidebar-mini mt-4 mb-4 p-3">
                        <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                            <i class="fas fa-rocket"></i> Documentation
                        </a>
                    </div>
                </aside>
            </div>

            <!-- Content -->
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>List Admin</h4>
                                    <div class="card-header-action">
                                        <a class="btn btn-primary" id="modal-admin-kabupaten-tambah">Tambah Admin</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table table-responsive">
                                        <table class="table-sm table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Admin</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Nomor Telepon</th>
                                                    <th scope="col">Tambah Edit Admin Destinasi</th>
                                                    <th scope="col">Mengajukan Destinasi</th>
                                                    <th scope="col">Tools</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($admin as $data)
                                                    <tr>
                                                        <td>{{ $data['name'] }}</td>
                                                        <td>{{ $data['email'] }}</td>
                                                        <td>{{ $data['phone'] }}</td>
                                                        <td>
                                                            @if ($data['tambah_edit_admin_destinasi'] == 1)
                                                                <a href="{{ url('admin-kabupaten/nonaktifkan-tambah-edit-admin-destinasi/' . $data['id']) }}"
                                                                    class="btn btn-icon btn-success">
                                                                    <i class="fas fa-check"></i>
                                                                </a>
                                                            @else
                                                                <a href="{{ url('admin-kabupaten/aktifkan-tambah-edit-admin-destinasi/' . $data['id']) }}"
                                                                    class="btn btn-icon btn-warning">
                                                                    <i class="fas fa-times"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($data['mengajukan_destinasi'] == 1)
                                                                <a href="{{ url('admin-kabupaten/nonaktifkan-mengajukan-destinasi/' . $data['id']) }}"
                                                                    class="btn btn-icon btn-success">
                                                                    <i class="fas fa-check"></i>
                                                                </a>
                                                            @else
                                                                <a href="{{ url('admin-kabupaten/aktifkan-mengajukan-destinasi/' . $data['id']) }}"
                                                                    class="btn btn-icon btn-warning">
                                                                    <i class="fas fa-times"></i>
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-danger btn-action"
                                                                href="{{ url('admin-kabupaten/hapus-admin-desa/' . $data['id']) }}">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- TAMBAH --}}
                                    <div id="modal-admin-kabupaten-tambah-admin">
                                        <form action="{{ url('/admin-kabupaten/tambah-admin-desa') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="Masukkan Nama Admin">
                                            </div>
                                            <select class="form-control" name="regency_id" id="regency" hidden>
                                                <option value="{{ Auth::user()->regency_id }}" selected>
                                                </option>
                                            </select>
                                            <div class="form-group">
                                                <label for="district">Kecamatan</label>
                                                <select class="form-control" name="district_id" id="district">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="village">Desa</label>
                                                <select class="form-control" name="village_id" id="village">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="example@mail.com">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    placeholder="Masukkan Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Nomor
                                                    Handphone</label>
                                                <input type="text" class="form-control" name="phone"
                                                    placeholder="Nomor Handphone">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{ $admin->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Footer -->
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                        Nauval Azhar</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>

        </div>
    </div>

    {{-- AJAX DROPDOWN --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(function() {
            $('#regency').ready(function() {
                // var regency_id = $('#regency').val();
                var regency_id = document.getElementById("regency").value;
                $.ajax({
                    type: "POST",
                    url: "{{ route('getDistrict') }}",
                    data: {
                        regency_id: regency_id
                    },
                    success: function(msg) {
                        $('#district').html(msg);
                        $('#village').html('');
                    },
                    error: function(data) {
                        console.log('error', data)
                    },
                })
            })
            $('#district').on('change', function() {
                var district_id = $('#district').val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('getVillage') }}",
                    data: {
                        district_id: district_id
                    },
                    success: function(msg) {
                        $('#village').html(msg);
                    },
                    error: function(data) {
                        console.log('error', data)
                    },
                })
            })
        });

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    <!-- General JS Scripts -->
    <script src="{{ asset('stisla/library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('stisla/library/popper.js/dist/umd/popper.js') }}"></script>
    <script src="{{ asset('stisla/library/tooltip.js/dist/umd/tooltip.js') }}"></script>
    <script src="{{ asset('stisla/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('stisla/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('stisla/library/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('stisla/js/stisla.js') }}"></script>

    @stack('scripts')

    <!-- Template JS File -->
    <script src="{{ asset('stisla/js/scripts.js') }}"></script>
    <script src="{{ asset('stisla/js/custom.js') }}"></script>

    <script src="{{ asset('stisla/js/page/bootstrap-modal.js') }}"></script>


</body>

</html>
