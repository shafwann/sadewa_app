<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Authenticate;
use App\Http\Controllers\Home;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// User
Route::get('/', [Home::class, 'index']);
Route::get('/kabupaten', [Home::class, 'kabupaten']);
Route::get('/kabupaten/{id}', [Home::class, 'detailKabupaten']);
Route::get('/desa', [Home::class, 'desa']);
Route::get('/desa/{id}', [Home::class, 'detailDesa']);
Route::get('/destinasi', [Home::class, 'destinasi']);
Route::get('/destinasi/{id}', [Home::class, 'detailDestinasi']);
Route::middleware(['auth'])->group(
    function () {
        Route::get('/pesan/destinasi/{id}', [Home::class, 'pesanDestinasi']);
        Route::get('/pesan/paket/{id}', [Home::class, 'pesanPaket']);
        Route::post('/proses-pesan/destinasi/{id_destinasi}/{id_user}', [Home::class, 'prosesPesanDestinasi']);
        Route::post('/proses-pesan/paket/{id_paket}/{id_user}', [Home::class, 'prosesPesanPaket']);
        Route::get('invoice/destinasi/{id}', [Home::class, 'invoiceDestinasi']);
        Route::get('invoice/paket/{id}', [Home::class, 'invoicePaket']);
        Route::get('/daftar-pemesanan', [Home::class, 'daftarPemesanan'])->name('daftar-pemesanan');
        // Route::middleware(['download-tiket'])->group(
        //     function () {
        //         Route::get('/pdf/{id}', [Home::class, 'downloadTiket']);
        //     }
        // );
        Route::get('/pdf/{id}', [Home::class, 'downloadTiket']);
    }
);
Route::get('/maps', [Home::class, 'map']);


// Authenticate User
Route::get('/login', [Authenticate::class, 'login'])->name('login');
Route::post('/proses-login', [Authenticate::class, 'prosesLogin']);
Route::get('/register', [Authenticate::class, 'register']);
Route::post('/proses-register', [Authenticate::class, 'prosesRegister']);
Route::get('/forgot-password', [Authenticate::class, 'forgotPassword']);
Route::post('/check-email', [Authenticate::class, 'checkEmail']);
Route::get('/reset-password/{id}', [Authenticate::class, 'resetPassword']);
Route::put('/proses-reset-password/{id}', [Authenticate::class, 'prosesResetPassword']);
Route::get('/logout', [Authenticate::class, 'logout']);

// IndoRegion
Route::post('/getRegency', [Admin::class, 'getRegency'])->name('getRegency');
Route::post('/getDistrict', [Admin::class, 'getDistrict'])->name('getDistrict');
Route::post('/getVillage', [Admin::class, 'getVillage'])->name('getVillage');


// SuperAdmin
Route::middleware(['auth', 'superadmin'])->group(
    function () {
        Route::get('/superadmin', [Admin::class, 'superadmin']);
        Route::put('/superadmin/ganti-banner', [Admin::class, 'gantiBanner']);
        // Admin
        Route::get('/superadmin/daftar-admin', [Admin::class, 'admin']);
        Route::get('/superadmin/daftar-admin/tambah', [Admin::class, 'tambahAdmin']);
        Route::post('/superadmin/daftar-admin/proses-tambah', [Admin::class, 'prosesTambahAdmin'])->name('prosesTambahAdmin');
        Route::get('/superadmin/daftar-admin/hapus/{id}', [Admin::class, 'hapusAdmin']);
        // aktif nonaktif
        Route::get('/superadmin/daftar-admin/nonaktifkan-edit-admin-desa/{id}', [Admin::class, 'nonaktifEditAdminDesa']);
        Route::get('/superadmin/daftar-admin/aktifkan-edit-admin-desa/{id}', [Admin::class, 'aktifEditAdminDesa']);
        Route::get('/superadmin/daftar-admin/nonaktifkan-approve-wisata/{id}', [Admin::class, 'nonaktifApproveWisata']);
        Route::get('/superadmin/daftar-admin/aktifkan-approve-wisata/{id}', [Admin::class, 'aktifApproveWisata']);
        Route::get('/superadmin/daftar-admin/nonaktifkan-tambah-edit-admin-destinasi/{id}', [Admin::class, 'nonaktifTambahEditAdminDestinasi']);
        Route::get('/superadmin/daftar-admin/aktifkan-tambah-edit-admin-destinasi/{id}', [Admin::class, 'aktifTambahEditAdminDestinasi']);
        Route::get('/superadmin/daftar-admin/nonaktifkan-mengajukan-destinasi/{id}', [Admin::class, 'nonaktifMengajukanDestinasi']);
        Route::get('/superadmin/daftar-admin/aktifkan-mengajukan-destinasi/{id}', [Admin::class, 'aktifMengajukanDestinasi']);
        Route::get('/superadmin/daftar-admin/nonaktifkan-konfirmasi-tiket/{id}', [Admin::class, 'nonaktifKonfirmasiTiket']);
        Route::get('/superadmin/daftar-admin/aktifkan-konfirmasi-tiket/{id}', [Admin::class, 'aktifKonfirmasiTiket']);

        // Kategori
        Route::get('/superadmin/kategori', [Admin::class, 'kategori']);
        Route::post('/superadmin/tambah-kategori', [Admin::class, 'tambahKategori']);
        Route::put('/superadmin/edit-kategori/{id}', [Admin::class, 'editKategori']);
        Route::get('/superadmin/kategori/proses-hapus/{id}', [Admin::class, 'prosesHapusKategori']);
    }
);

// Admin Kabupaten
Route::middleware(['auth', 'admin-kabupaten'])->group(
    function () {
        Route::get('/admin-kabupaten', [Admin::class, 'adminKabupaten']);
        Route::put('/admin-kabupaten/edit-profil/{id}', [Admin::class, 'editProfilAdminKabupaten']);
        Route::get('/admin-kabupaten/daftar-admin', [Admin::class, 'daftarAdminKabupaten']);
        Route::post('/admin-kabupaten/tambah-admin-desa', [Admin::class, 'tambahAdminDesa'])->middleware('kab-tambah-admin-desa'); // middleware
        Route::get('/admin-kabupaten/nonaktifkan-tambah-edit-admin-destinasi/{id}', [Admin::class, 'kabNonaktifTambahEditAdminDestinasi'])->middleware('kab-tambah-admin-desa');
        Route::get('/admin-kabupaten/aktifkan-tambah-edit-admin-destinasi/{id}', [Admin::class, 'kabAktifTambahEditAdminDestinasi'])->middleware('kab-tambah-admin-desa');
        Route::get('/admin-kabupaten/nonaktifkan-mengajukan-destinasi/{id}', [Admin::class, 'kabNonaktifMengajukanDestinasi'])->middleware('kab-tambah-admin-desa');
        Route::get('/admin-kabupaten/aktifkan-mengajukan-destinasi/{id}', [Admin::class, 'kabAktifMengajukanDestinasi'])->middleware('kab-tambah-admin-desa');
        Route::get('/admin-kabupaten/hapus-admin-desa/{id}', [Admin::class, 'kabHapusAdminDesa'])->middleware('kab-tambah-admin-desa');
        Route::get('/admin-kabupaten/destinasi', [Admin::class, 'destinasiAdminKabupaten']);
        Route::get('/admin-kabupaten/destinasi/approve/{id}', [Admin::class, 'approveDestinasiAdminKabupaten'])->middleware('kab-approve-destinasi'); // middleware
        Route::get('/admin-kabupaten/destinasi/reject/{id}', [Admin::class, 'rejectDestinasiAdminKabupaten'])->middleware('kab-approve-destinasi'); // middleware
        Route::get('/admin-kabupaten/destinasi/hapus/{id}', [Admin::class, 'hapusDestinasiAdminKabupaten'])->middleware('kab-approve-destinasi'); // middleware
    }
);

// Admin Desa
Route::middleware(['auth', 'admin-desa'])->group(
    function () {
        Route::get('/admin-desa', [Admin::class, 'adminDesa']);
        Route::put('/admin-desa/edit-profil/{id}', [Admin::class, 'editProfilAdminDesa']);
        Route::get('/admin-desa/daftar-admin', [Admin::class, 'daftarAdminDestinasi']);
        Route::post('/admin-desa/tambah-admin-destinasi', [Admin::class, 'tambahAdminDestinasi'])->middleware('des-tambah-admin-destinasi'); // middleware
        Route::get('/admin-desa/daftar-admin/hapus/{id}', [Admin::class, 'hapusAdminDestinasi'])->middleware('des-tambah-admin-destinasi'); // middleware
        Route::get('/admin-desa/nonaktifkan-konfirmasi-tiket/{id}', [Admin::class, 'desNonaktifKonfirmasiTiket'])->middleware('des-tambah-admin-destinasi');
        Route::get('/admin-desa/aktifkan-konfirmasi-tiket/{id}', [Admin::class, 'desAktifKonfirmasiTiket'])->middleware('des-tambah-admin-destinasi');
        Route::get('/admin-desa/destinasi', [Admin::class, 'destinasiAdminDesa']);
        Route::post('/admin-desa/tambah-destinasi', [Admin::class, 'desTambahDestinasi'])->middleware('des-mengajukan-destinasi'); // middleware
        Route::put('/admin-desa/edit-destinasi/{id}', [Admin::class, 'desEditDestinasi'])->middleware('des-mengajukan-destinasi');
        Route::get('/admin-desa/hapus-destinasi/{id}', [Admin::class, 'desHapusDestinasi'])->middleware('des-mengajukan-destinasi');
        Route::get('/admin-desa/paket-destinasi', [Admin::class, 'desPaketDestinasi']);
        Route::post('/admin-desa/tambah-paket', [Admin::class, 'desTambahPaket']);
        Route::get('/admin-desa/hapus-paket/{id}', [Admin::class, 'desHapusPaket']);
    }
);

// Admin Destinasi
Route::middleware(['auth', 'admin-destinasi'])->group(
    function () {
        Route::get('/admin-destinasi', [Admin::class, 'adminDestinasi']);
        Route::put('/admin-destinasi/edit-profil/{id}', [Admin::class, 'editProfilAdminDestinasi']);
        Route::get('/admin-destinasi/konfirmasi-tiket', [Admin::class, 'konfirmasiTiket']);
        Route::get('/admin-destinasi/konfirmasi-tiket/{id}', [Admin::class, 'konfirmasiTiketId'])->middleware('dest-konfirmasi-tiket'); // middleware
        Route::get('admin-destinasi/wahana', [Admin::class, 'wahana']);
        Route::post('/admin-destinasi/tambah-wahana', [Admin::class, 'tambahWahana']);
        Route::put('/admin-destinasi/edit-wahana/{id}', [Admin::class, 'editWahana']);
        Route::get('/admin-destinasi/hapus-wahana/{id}', [Admin::class, 'hapusWahana']);
        Route::get('/admin-destinasi/paket-wahana', [Admin::class, 'paketWahana']);
        Route::post('/admin-destinasi/tambah-paket', [Admin::class, 'destTambahPaket']);
        Route::get('/admin-destinasi/hapus-paket/{id}', [Admin::class, 'destHapusPaket']);
    }
);
// wahana


// Authenticate Admin
Route::get('/login-admin', [Authenticate::class, 'loginAdmin']);
Route::post('/proses-login-admin', [Authenticate::class, 'prosesLoginAdmin']);


// Socialite Auth
Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProvideCallback']);
