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
                        <a href="{{ url('superadmin') }}">
                            <span class="brand-text">Sadewa</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a class="nav-link" href="{{ url('superadmin') }}"><i class="fas fa-fire"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li class="active">
                            <a class="nav-link" href="{{ url('superadmin/daftar-admin') }}"><i class="fas fa-user"></i>
                                <span>Daftar Admin</span></a>
                        </li>
                        <li>
                            <a href="{{ url('superadmin/kategori') }}" class="nav-link"><i class="fas fa-bolt"></i>
                                <span>Kategori</span></a>
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
                                        <a class="btn btn-primary" id="modal-superadmin-admin">Tambah Admin</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table table-responsive">
                                        <table class="table-sm table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Admin</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Nomor Telepon</th>
                                                    <th scope="col">Tambah Admin Desa</th>
                                                    <th scope="col">Approve Destinasi</th>
                                                    <th scope="col">Tambah Admin Destinasi</th>
                                                    <th scope="col">Mengajukan Destinasi</th>
                                                    <th scope="col">Konfirmasi Tiket</th>
                                                    <th scope="col">Tools</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($admin as $item)
                                                    @foreach ($role as $item2)
                                                        @if ($item['role_id'] == $item2['id'])
                                                            <tr>
                                                                <td>{{ $item['name'] }}</td>
                                                                <td>{{ $item2['nama_role'] }}</td>
                                                                <td>{{ $item['email'] }}</td>
                                                                <td>{{ $item['phone'] }}</td>
                                                                @if ($item['edit_admin_desa'] == '1')
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/nonaktifkan-edit-admin-desa/' . $item['id']) }}"
                                                                            class="btn btn-icon btn-success">
                                                                            <i class="fas fa-check"></i>
                                                                        </a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/aktifkan-edit-admin-desa/' . $item['id']) }}"
                                                                            class="btn btn-icon btn-warning">
                                                                            <i class="fas fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                                @if ($item['approve_wisata'] == '1')
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/nonaktifkan-approve-wisata/' . $item['id']) }}"
                                                                            class="btn btn-icon btn-success">
                                                                            <i class="fas fa-check"></i>
                                                                        </a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/aktifkan-approve-wisata/' . $item['id']) }}"
                                                                            class="btn btn-icon btn-warning">
                                                                            <i class="fas fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                                @if ($item['tambah_edit_admin_destinasi'] == '1')
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/nonaktifkan-tambah-edit-admin-destinasi/' . $item['id']) }}"
                                                                            class="btn btn-icon btn-success">
                                                                            <i class="fas fa-check"></i>
                                                                        </a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/aktifkan-tambah-edit-admin-destinasi/' . $item['id']) }}"
                                                                            class="btn btn-icon btn-warning">
                                                                            <i class="fas fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                                @if ($item['mengajukan_destinasi'] == '1')
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/nonaktifkan-mengajukan-destinasi/' . $item['id']) }}"
                                                                            class="btn btn-icon btn-success">
                                                                            <i class="fas fa-check"></i>
                                                                        </a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/aktifkan-mengajukan-destinasi/' . $item['id']) }}"
                                                                            class="btn btn-icon btn-warning">
                                                                            <i class="fas fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                                @if ($item['konfirmasi_tiket'] == '1')
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/nonaktifkan-konfirmasi-tiket/' . $item['id']) }}"
                                                                            class="btn btn-icon btn-success">
                                                                            <i class="fas fa-check"></i>
                                                                        </a>
                                                                    </td>
                                                                @else
                                                                    <td>
                                                                        <a href="{{ url('superadmin/daftar-admin/aktifkan-konfirmasi-tiket/' . $item['id']) }}"
                                                                            class="btn btn-icon btn-warning">
                                                                            <i class="fas fa-times"></i>
                                                                        </a>
                                                                    </td>
                                                                @endif
                                                                <td>
                                                                    <a class="btn btn-danger btn-action"
                                                                        href="{{ url('superadmin/daftar-admin/hapus/' . $item['id']) }}">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    {{ $admin->links() }}
                                </div>
                            </div>
                        </div>

                        {{-- TAMBAH ADMIN --}}
                        <div id="modal-tambah-admin">
                            <form action="{{ url('/superadmin/daftar-admin/proses-tambah') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <div>
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Masukkan Nama">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="role_id">Role</label>
                                    <div>
                                        <select class="form-control" name="role_id" id="role_id">
                                            <option value="">Pilih Role</option>
                                            <option value="2">Admin Kabupaten</option>
                                            <option value="3">Admin Desa</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- OPSI ADMIN KABUPATEN --}}
                                <div data-parent="2" style="display: none;">
                                    <div class="form-group">
                                        <label for="province">Provinsi</label>
                                        <div>
                                            <select class="form-control" name="province_id" id="province-2">
                                                <option value="">Pilih Provinsi</option>
                                                @foreach ($province as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="regency">Kabupaten</label>
                                        <div>
                                            <select class="form-control" name="regency_id" id="regency-2">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- OPSI ADMIN DESA --}}
                                <div data-parent="3" style="display: none;">
                                    <div class="form-group">
                                        <label for="province">Provinsi</label>
                                        <div>
                                            <select class="form-control" name="province_id" id="province-3">
                                                <option value="">Pilih Provinsi</option>
                                                @foreach ($province as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="regency">Kabupaten</label>
                                        <div>
                                            <select class="form-control" name="regency_id" id="regency-3">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="district">Kecamatan</label>
                                        <div>
                                            <select class="form-control" name="district_id" id="district-3">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="village">Desa</label>
                                        <div>
                                            <select class="form-control" name="village_id" id="village-3">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- OPSI ADMIN WISATA --}}
                                <div data-parent="4" style="display: none;">
                                    <div class="form-group">
                                        <label for="province">Provinsi</label>
                                        <div>
                                            <select class="form-control" name="province_id" id="province-4">
                                                <option value="">Pilih Provinsi</option>
                                                @foreach ($province as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="regency">Kabupaten</label>
                                        <div>
                                            <select class="form-control" name="regency_id" id="regency-4">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="district">Kecamatan</label>
                                        <div>
                                            <select class="form-control" name="district_id" id="district-4">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="village">Desa</label>
                                        <div>
                                            <select class="form-control" name="village_id" id="village-4">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="example@mail.com">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Masukkan Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Nomor Handphone</label>
                                    <div>
                                        <input type="text" class="form-control" name="phone"
                                            placeholder="Nomor Handphone">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Tambah</button>
                            </form>
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

    {{-- AJAX DROPDOWN --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(function() {
            $("select").on("change", function() {
                if ($(this).val() === "") {
                    $("[data-parent]").hide();
                } else {
                    var selected = $(this).val();

                    //show input
                    var selectedparent = $("div[data-parent='" + selected + "']");
                    selectedparent.show().siblings("[data-parent]").hide();

                    //remove disabled to every input in selectedparent
                    selectedparent.find("select").removeAttr("disabled");
                    //disabled input other input that not in selectedparent
                    selectedparent.siblings("[data-parent]").find("select").attr("disabled", "disabled");

                    //Ajax
                    $('#province-' + selected).on('change', function() {
                        var province_id = $('#province-' + selected).val();
                        $.ajax({
                            type: "POST",
                            url: "{{ route('getRegency') }}",
                            data: {
                                province_id: province_id
                            },
                            success: function(msg) {
                                $('#regency-' + selected).html(msg);
                                $('#district-' + selected).html('');
                                $('#village-' + selected).html('');
                            },
                            error: function(data) {
                                console.log('error', data)
                            },
                        })
                    })
                    $('#regency-' + selected).on('change', function() {
                        var regency_id = $('#regency-' + selected).val();

                        $.ajax({
                            type: "POST",
                            url: "{{ route('getDistrict') }}",
                            data: {
                                regency_id: regency_id
                            },
                            success: function(msg) {
                                $('#district-' + selected).html(msg);
                                $('#village-' + selected).html('');
                            },
                            error: function(data) {
                                console.log('error', data)
                            },
                        })
                    })
                    $('#district-' + selected).on('change', function() {
                        var district_id = $('#district-' + selected).val();

                        $.ajax({
                            type: "POST",
                            url: "{{ route('getVillage') }}",
                            data: {
                                district_id: district_id
                            },
                            success: function(msg) {
                                $('#village-' + selected).html(msg);
                            },
                            error: function(data) {
                                console.log('error', data)
                            },
                        })
                    })
                }
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
</body>

</html>
