<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SADEWA</title>
    <link href="{{ url('assets/img/Logo.png') }}" rel="icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}" />

    <!-- animate CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/animate.css') }}" />

    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/owl.carousel.min.css') }}" />

    <!-- themify CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/themify-icons.css') }}" />

    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/flaticon.css') }}" />

    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{ url('assets/fontawesome/css/all.min.css') }}" />

    <!-- magnific CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/gijgo.min.css') }}" />

    <!-- nice select CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/nice-select.css') }}" />

    <!-- slick CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/slick.css') }}" />

    <!-- style CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <header class="main_menu">
        <div class="main_menu_iner">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ url('assets/img/Logo sadewa.png') }}" alt="logo" />
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse main-menu-item justify-content-center"
                                id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('kabupaten') }}">Kabupaten</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link is-active" href="{{ url('desa') }}">Desa Wisata</a>
                                    </li>
                                </ul>
                            </div>
                            <ul class="navbar-nav ms-auto">
                                @guest
                                    <a href="{{ url('login') }}" class="btn_1 d-none d-lg-block">Login</a>
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ url('daftar-pemesanan') }}">Pesanan</a>
                                            <a class="dropdown-item" href="{{ url('logout') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ url('logout') }}" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ======= Blog Details Section ======= -->
    <section id="pesanTiket" class="blog pesanTiket">
        <div class="container" data-aos="fade-up">
            <div class="inputTiket" style="width: 1200px">
                <h4>Pesanan Anda</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Destinasi</th>
                            <th>Kunjungan</th>
                            <th>Jumlah Tiket</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            {{-- <th>Hubungi(WhatsApp)</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tiket as $ticket)
                            <tr>
                                @if ($ticket['paket_id'] != null)
                                    @foreach ($paket as $item)
                                        @if ($ticket->paket_id == $item->id)
                                            <td>{{ $item->nama_paket }}</td>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($destinasi as $item)
                                        @if ($ticket->destinasi_id == $item->id)
                                            <td>{{ $item->nama_destinasi }}</td>
                                        @endif
                                    @endforeach
                                @endif
                                <td>{{ $ticket->tanggal_kunjungan }}</td>
                                <td>{{ $ticket->jumlah_tiket }}</td>
                                @if ($ticket['paket_id'] != null)
                                    @foreach ($paket as $item)
                                        @if ($ticket->paket_id == $item->id)
                                            <td>{{ $item->harga_paket * $ticket->jumlah_tiket }}</td>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($destinasi as $item)
                                        @if ($ticket->destinasi_id == $item->id)
                                            <td>{{ $item->htm_destinasi * $ticket->jumlah_tiket }}</td>
                                        @endif
                                    @endforeach
                                @endif
                                @if ($ticket->konfirmasi == 0)
                                    <td>Belum Dibayar</td>
                                @else
                                    <td>Sudah Dibayar</td>
                                @endif
                                {{-- @if ($ticket['paket_id'] != null)
                                    @foreach ($paket as $item)
                                        @foreach ($admin as $adm)
                                            @if ($ticket->paket_id == $item->id)
                                                @if ($item->admin_id == $adm->id)
                                                    <td><a
                                                            href="https://wa.me/{{ $adm->phone }}">{{ $adm->phone }}</a>
                                                    </td>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                @else
                                    @foreach ($destinasi as $item)
                                        @foreach ($admin as $adm)
                                            @if ($ticket->destinasi_id == $item->id)
                                                @if ($item->admin_id == $adm->id)
                                                    <td><a
                                                            href="https://wa.me/{{ $adm->phone }}">{{ $adm->phone }}</a>
                                                    </td>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                @endif --}}
                                <td><a href="{{ url('/pdf', $ticket->id) }}"><i class="fas fa-download"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="margin-top: 25px">
            {{ $tiket->links() }}
        </div>
    </section>

    <footer class="footer-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-md-7">
                    <div class="single-footer-widget">
                        <h4 id="JudulFooter">SADEWA</h4>
                        <p>
                            SADEWA merupakan layanan promosi desa wisata yang akan membantu calon wisatawan untuk
                            memesan dan memperoleh informasi yang dibutuhkan dengan cara cepat dan mudah. <br><br>
                            Cari dan pesan tiket wisatamu sekarang hanya di SADEWA!
                        </p>
                        <img src="{{ url('assets/img/logo/Logo UNS (1).png') }}" alt="UNS">
                        <img src="{{ url('assets/img/logo/LogoTypeSV-01.png') }}" alt="SV">
                        <img src="{{ url('assets/img/logo/LOGO PRODI UNS.png') }}" alt="D3TI">
                        <img src="{{ url('assets/img/logo/OASE Tanpa BG.jpg') }}" alt="OASE">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="single-footer-widget footer_icon">
                        <h4>Contact Us</h4>
                        <p>
                            Kampus Mesen UNS, Jl. Jend. Urip Sumoharjo No.116,
                            Purwodiningratan, Kec. Jebres, Kota Surakarta, Jawa Tengah 57129
                            <br />(0271) 663450
                        </p>
                        <span>kontak@d3ti.vokasi.uns.ac.id</span>
                        <div class="social-icons">
                            <a href="https://web.facebook.com/d3tiuns" target="_blank"><i
                                    class="ti-facebook"></i></a>
                            <a href="https://d3ti.vokasi.uns.ac.id/" target="_blank"><i class="ti-world"></i></a>
                            <a href="https://www.youtube.com/@teknikinformatikauns" target="_blank"><i
                                    class="ti-youtube"></i></a>
                            <a href="https://www.instagram.com/d3tiuns/?igshid=MzRlODBiNWFlZA%3D%3D"
                                target="_blank"><i class="ti-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="copyright_part_text text-center">
                        <p class="footer-text m-0">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            All rights reserved
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer part end-->


    <!-- jquery plugins here-->
    <script src="{{ url('assets/js/jquery-1.12.1.min.js') }}"></script>

    <!-- popper js -->
    <script src="{{ url('assets/js/popper.min.js') }}"></script>

    <!-- bootstrap js -->
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>

    <!-- magnific js -->
    <script src="{{ url('assets/js/jquery.magnific-popup.js') }}"></script>

    <!-- swiper js -->
    <script src="{{ url('assets/js/owl.carousel.min.js') }}"></script>

    <!-- masonry js -->
    <script src="{{ url('assets/js/masonry.pkgd.js') }}"></script>

    <!-- masonry js -->
    <script src="{{ url('assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ url('assets/js/gijgo.min.js') }}"></script>

    <!-- contact js -->
    <script src="{{ url('assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.form.js') }}"></script>
    <script src="{{ url('assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ url('assets/js/mail-script.js') }}"></script>
    <script src="{{ url('assets/js/contact.js') }}"></script>

    <!-- custom js -->
    <script src="{{ url('assets/js/custom.js') }}"></script>
</body>

</html>
