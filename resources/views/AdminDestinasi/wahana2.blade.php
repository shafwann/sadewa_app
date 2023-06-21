<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Daftar Wahana</title>
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
                        <a href="{{ url('admin-destinasi') }}">
                            <span class="brand-text">Sadewa</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li>
                            <a class="nav-link" href="{{ url('admin-destinasi') }}"><i class="fas fa-fire"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ url('admin-destinasi/konfirmasi-tiket') }}"><i
                                    class="fas fa-ticket"></i>
                                <span>Konfirmasi Tiket</span></a>
                        </li>
                        <li class="active">
                            <a href="{{ url('admin-destinasi/wahana') }}" class="nav-link"><i
                                    class="fas fa-map-marker"></i>
                                <span>Wahana</span></a>
                        </li>
                        <li>
                            <a href="{{ url('admin-destinasi/paket-wahana') }}" class="nav-link"><i
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
                                                <input type="file" class="custom-file-input" id="fotoWahana"
                                                    name="foto_wahana[]" multiple>
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
                {{-- END TAMBAH --}}

                {{-- EDIT --}}
                @foreach ($wahana as $wah)
                    <div class="modal fade" id="myEdit{{ $wah['id'] }}" tabindex="-1" role="dialog"
                        aria-labelledby="myEditLabel{{ $wah['id'] }}" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 1000px">
                            <div class="modal-content">
                                <!-- Header Modal -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Wahana</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                                    <input type="file" class="custom-file-input" id="fotoWahana"
                                                        name="foto_wahana[]" multiple>
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
                                                    placeholder="Harga Tiket" value="{{ $wah['htm_wahana'] }}">
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
                {{-- END EDIT --}}
                <section class="section">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>List Wahana</h4>
                                    <div class="card-header-action">
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah
                                            Wahana</a>
                                    </div>
                                </div>
                                <section id="blog" class="blog">
                                    <div class="container" data-aos="fade-up">
                                        <div class="wahanaDestinasi align-items-center">
                                            <div class="row">
                                                @foreach ($wahana as $w)
                                                    <div class="col-sm-6">
                                                        <div class="detailWahana">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div id="carouselExampleSlidesOnly"
                                                                        class="carousel slide post-img"
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

                                                            <div
                                                                class="hover_Text d-flex align-items-end justify-content-between">
                                                                <div class="row">
                                                                    <div class="hover_text_iner col-sm-6">
                                                                        <a data-toggle="modal"
                                                                            data-target="#myEdit{{ $w['id'] }}"
                                                                            data-id="{{ $w['id'] }}"><i
                                                                                class="fas fa-edit"></i></a>
                                                                    </div>
                                                                    <div class="hover_text_iner col-sm-6">
                                                                        <a
                                                                            href="{{ url('/admin-destinasi/hapus-wahana', $w['id']) }}"><i
                                                                                class="fas fa-trash"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="d-flex justify-content-center">
                                    {{ $wahana->links() }}
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

</body>

</html>
