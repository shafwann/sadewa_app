<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Daftar Destinasi</title>
    <link href="{{ url('assets/img/Logo.png') }}" rel="icon" />

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
                        <a href="{{ url('admin-desa') }}">
                            <span class="brand-text">Sadewa</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a class="nav-link" href="{{ url('admin-desa') }}"><i class="fas fa-fire"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ url('admin-desa/daftar-admin') }}"><i class="fas fa-user"></i>
                                <span>Daftar Admin</span></a>
                        </li>
                        <li class="active">
                            <a href="{{ url('admin-desa/destinasi') }}" class="nav-link"><i
                                    class="fas fa-map-marker-alt"></i>
                                <span>Destinasi</span></a>
                        </li>
                        <li>
                            <a href="{{ url('admin-desa/paket-destinasi') }}" class="nav-link"><i
                                    class="fas fa-box"></i>
                                <span>Paket</span></a>
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
                {{-- TAMBAH --}}
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog" style="max-width: 1000px">
                        <div class="modal-content">
                            <!-- Header Modal -->
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Destinasi</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Body Modal -->
                            <div class="modal-body">
                                <form action="{{ url('/admin-desa/tambah-destinasi') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="col-form-label">Nama</label>
                                        <div>
                                            <input type="text" class="form-control" name="nama_destinasi"
                                                placeholder="Masukkan Nama Destinasi">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="kategori_id" class="col-form-label">Kategori</label>
                                        <div>
                                            <select class="form-control" name="kategori_id" id="kategori_id">
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item['id'] }}">
                                                        {{ $item['nama_kategori'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="fotoDestinasi" class="col-form-label">Foto (gunakan
                                            Ctrl)</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="fotoDestinasi"
                                                    name="foto_destinasi[]" multiple>
                                                <label class="custom-file-label" for="fotoDestinasi">Choose
                                                    multiple file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi" class="col-form-label">Deskripsi</label>
                                        <div>
                                            <textarea class="form-control" name="deskripsi_destinasi" id="deskripsi" rows="3"
                                                placeholder="Masukkan Deskripsi"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="maps_destinasi" class="col-form-label">Lokasi (<a
                                                href="{{ url('maps') }}" target="_blank">tutorial</a>)</label>
                                        <div>
                                            <input type="text" class="form-control" name="maps_destinasi"
                                                placeholder="Lokasi Maps">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat" class="col-form-label">Alamat</label>
                                        <div>
                                            <input type="text" class="form-control" name="alamat_destinasi"
                                                placeholder="Masukkan Alamat Lengkap">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="htm_destinasi" class="col-form-label">HTM</label>
                                        <div>
                                            <input type="number" class="form-control" name="htm_destinasi"
                                                placeholder="Harga Tiket">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END TAMBAH --}}

                {{-- EDIT --}}
                @foreach ($destinasi as $dest)
                    <div class="modal fade" id="myEdit{{ $dest['id'] }}" tabindex="-1" role="dialog"
                        aria-labelledby="myEditLabel{{ $dest['id'] }}" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 1000px">
                            <div class="modal-content">
                                <!-- Header Modal -->
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Destinasi</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Body Modal -->
                                <div class="modal-body">
                                    <form action="{{ url('/admin-desa/edit-destinasi', $dest['id']) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="name" class="col-form-label">Nama</label>
                                            <div>
                                                <input type="text" class="form-control" name="nama_destinasi"
                                                    placeholder="Masukkan Nama Destinasi"
                                                    value="{{ $dest['nama_destinasi'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori_id" class="col-form-label">Kategori</label>
                                            <div>
                                                <select class="form-control" name="kategori_id" id="kategori_id">
                                                    @foreach ($kategori as $item)
                                                        @if ($item['id'] == $dest['kategori_id'])
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
                                            <label for="deskripsi" class="col-form-label">Deskripsi</label>
                                            <div>
                                                <textarea class="form-control" name="deskripsi_destinasi" id="deskripsiEdit{{ $dest['id'] }}" rows="3"
                                                    placeholder="Masukkan Deskripsi">{{ $dest['deskripsi_destinasi'] }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class="col-form-label">Alamat</label>
                                            <div>
                                                <input type="text" class="form-control" name="alamat_destinasi"
                                                    placeholder="Masukkan Alamat Lengkap"
                                                    value="{{ $dest['alamat_destinasi'] }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="htm_destinasi" class="col-form-label">HTM</label>
                                            <div>
                                                <input type="number" class="form-control" name="htm_destinasi"
                                                    placeholder="Harga Tiket" value="{{ $dest['htm_destinasi'] }}">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- END EDIT --}}

                <section class="section">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>List Destinasi</h4>
                                    <div class="card-header-action">
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah
                                            Destinasi</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table table-responsive">
                                        <table class="table-sm table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Destinasi</th>
                                                    <th scope="col">Kategori</th>
                                                    <th scope="col">HTM</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tools</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($destinasi as $d)
                                                    @foreach ($kategori as $k)
                                                        @if ($d['kategori_id'] == $k['id'])
                                                            <tr>
                                                                <td>{{ $d['nama_destinasi'] }}
                                                                </td>
                                                                <td>{{ $k['nama_kategori'] }}
                                                                </td>
                                                                <td>{{ $d['htm_destinasi'] }}
                                                                </td>
                                                                <td>
                                                                    @if ($d['approve'] == '1')
                                                                        <div class="badge badge-success">Approved</div>
                                                                    @else
                                                                        <div class="badge badge-warning">Waiting</div>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a class="edit-kategori btn btn-primary btn-action mr-1"
                                                                        title="Edit" data-toggle="modal"
                                                                        data-target="#myEdit{{ $d['id'] }}"
                                                                        data-id="{{ $d['id'] }}">
                                                                        <i class="fas fa-pencil-alt"></i></a>
                                                                    <a class="btn btn-danger btn-action"
                                                                        href="{{ url('admin-desa/hapus-destinasi/' . $d['id']) }}">
                                                                        <i class="fas fa-trash"></i></a>
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
                                    {{ $destinasi->links() }}
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

    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function() {
            CKEDITOR.replace('deskripsi')
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        })
        $(function() {
            @foreach ($destinasi as $dest)
                CKEDITOR.replace('deskripsiEdit' + {{ $dest['id'] }})
                //bootstrap WYSIHTML5 - text editor
            @endforeach
            $('.textarea').wysihtml5()
        })
    </script>
</body>

</html>
