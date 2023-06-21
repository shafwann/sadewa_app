<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Destinasi;
use Illuminate\Support\Str;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Kategori;
use App\Models\Paket;
use App\Models\ProfilDesa;
use App\Models\ProfilKabupaten;
use App\Models\Role;
use App\Models\Tiket;
use App\Models\Village;
use App\Models\Wahana;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class Admin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function superadmin()
    {
        $user = User::latest()->where('role_id', '5')->get();
        $user = count($user);

        $role_id = ['2', '3', '4'];
        $admin = User::latest()->whereIn('role_id', $role_id)->get();
        $admin = count($admin);

        $kabupaten = ProfilKabupaten::latest()->get();
        $kabupaten = count($kabupaten);

        $desa = ProfilDesa::latest()->get();
        $desa = count($desa);

        $destinasi = Destinasi::latest()->get();
        $destinasi = count($destinasi);

        $banner = Banner::first()->gambar;
        $banner = explode("|", $banner);

        $tiket = Tiket::where('konfirmasi', '1')->paginate(5);
        $listDestinasi = Destinasi::all();
        $paket = Paket::all();

        $tiketCount = count(Tiket::where('konfirmasi', '1')->get());

        return view('superadmin.dashboard2', ['user' => $user, 'admin' => $admin, 'desa' => $desa, 'destinasi' => $destinasi, 'banner' => $banner, 'tiket' => $tiket, 'listDestinasi' => $listDestinasi, 'paket' => $paket, 'tiketCount' => $tiketCount, 'kabupaten' => $kabupaten]);
    }

    public function gantiBanner(Request $request)
    {
        $files = [];
        if ($request->hasfile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('/images'), $name);
                $files[] = $name;
            }

            Banner::where('id', 1)->update([
                'gambar' => implode("|", $files),
            ]);

            return redirect('/superadmin');
        } else {
            $imagePost = "Banner1.png|Banner2.png|Banner3.png";

            Banner::where('id', 1)->update([
                'gambar' => $imagePost,
            ]);

            return redirect('/superadmin');
        }
    }

    public function admin()
    {
        $client = new Client();

        $role_id = ['2', '3', '4'];
        $data = User::latest()->whereIn('role_id', $role_id)->paginate(5);

        $role = Role::whereIn('id', [2, 3, 4])->latest()->get();

        $province = Province::all();

        return view('superadmin.admin2', ['admin' => $data, 'role' => $role, 'province' => $province]);
    }

    public function kategori()
    {
        $kategori = Kategori::latest()->paginate(7);

        return view('superadmin.kategori2', ['kategori' => $kategori]);
    }

    public function tambahKategori(Request $request)
    {
        $this->validate($request, [
            'nama_kategori' => 'required',
        ]);

        if ($request->icon == null) {
            Kategori::create([
                'nama_kategori' => $request->nama_kategori,
                'icon' => 'fa-tree',
            ]);
        } else {
            Kategori::create([
                'nama_kategori' => $request->nama_kategori,
                'icon' => $request->icon,
            ]);
        }

        return redirect('/superadmin/kategori');
    }

    public function editKategori(Request $request, $id)
    {
        Kategori::where('id', $id)->update([
            'nama_kategori' => $request->nama_kategori,
            'icon' => $request->icon,
        ]);

        return redirect('/superadmin/kategori');
    }

    public function prosesHapusKategori($id)
    {
        Kategori::where('id', $id)->delete();

        return redirect('/superadmin/kategori');
    }

    public function getRegency(Request $request)
    {
        $province_id = $request->province_id;

        $regencies = Regency::where('province_id', $province_id)->get();

        $option = "<option>Pilih Kabupaten/Kota</option>";
        foreach ($regencies as $kabupaten) {
            $option .= "<option value='$kabupaten->id'>$kabupaten->name</option>";
        }
        echo $option;
    }

    public function getDistrict(Request $request)
    {
        $districts = District::where('regency_id', $request->regency_id)->get();

        $option = "<option>Pilih Kecamatan</option>";
        foreach ($districts as $kecamatan) {
            $option .=  "<option value='$kecamatan->id'>$kecamatan->name</option>";
        }
        echo $option;
    }

    public function getVillage(Request $request)
    {
        $villages = Village::where('district_id', $request->district_id)->get();

        $option = "<option>Pilih Desa/Kelurahan</option>";
        foreach ($villages as $desa) {
            $option .=  "<option value='$desa->id'>$desa->name</option>";
        }
        echo $option;
    }

    public function prosesTambahAdmin(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            // English uppercase characters (A – Z)
            // English lowercase characters (a – z)
            // Base 10 digits (0 – 9)
            // Non-alphanumeric (For example: !, $, #, or %)
            'phone' => 'required|numeric|digits_between:10,13',
            'role_id' => 'required',
        ]);

        if ($request->role_id == '2') {
            $add = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'province_id' => $request->province_id,
                'regency_id' => $request->regency_id,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'role_id' => $request->role_id,
                'edit_admin_desa' => '1',
                'approve_wisata' => '1',
                'tambah_edit_admin_destinasi' => '0',
                'mengajukan_destinasi' => '0',
                'konfirmasi_tiket' => '0',
            ]);
            $profilKabupaten = ProfilKabupaten::where('regency_id', $add->regency_id)->first();
            if ($profilKabupaten->exists()) {
                $profilKabupaten->update([
                    'admin_id' => $profilKabupaten->admin_id . '|' . $add->id,
                ]);
            } else {
                ProfilKabupaten::create([
                    'admin_id' => $add->id,
                    'nama_kabupaten' => $request->name,
                    'province_id' => $request->province_id,
                    'regency_id' => $request->regency_id,
                    'foto_kabupaten' => 'kabupaten_default.jpg',
                ]);
            }
        } elseif ($request->role_id == '3') {
            $add = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'province_id' => $request->province_id,
                'regency_id' => $request->regency_id,
                'district_id' => $request->district_id,
                'village_id' => $request->village_id,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'role_id' => $request->role_id,
                'edit_admin_desa' => '0',
                'approve_wisata' => '1',
                'tambah_edit_admin_destinasi' => '1',
                'mengajukan_destinasi' => '1',
                'konfirmasi_tiket' => '0',
            ]);
            $profilDesa = ProfilDesa::where('village_id', $add->village_id)->first();
            if ($profilDesa->exists()) {
                $profilDesa->update([
                    'admin_id' => $profilDesa->admin_id . '|' . $add->id,
                ]);
            } else {
                ProfilDesa::create([
                    'admin_id' => $add->id,
                    'nama_desa' => $request->name,
                    'province_id' => $request->province_id,
                    'regency_id' => $request->regency_id,
                    'district_id' => $request->district_id,
                    'village_id' => $request->village_id,
                    'foto_kabupaten' => 'kabupaten_default.jpg',
                ]);
            }
        } else {
            $add = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'province_id' => $request->province_id,
                'regency_id' => $request->regency_id,
                'district_id' => $request->district_id,
                'village_id' => $request->village_id,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'role_id' => $request->role_id,
                'edit_admin_desa' => '0',
                'approve_wisata' => '0',
                'tambah_edit_admin_destinasi' => '0',
                'mengajukan_destinasi' => '0',
                'konfirmasi_tiket' => '1',
            ]);
        }

        return redirect('/superadmin/daftar-admin');
    }

    public function hapusAdmin($id)
    {
        $user = User::where('id', $id)->first();
        if ($user->role_id == '2') {
            ProfilKabupaten::where('admin_id', $id)->delete();
        } elseif ($user->role_id == '3') {
            ProfilDesa::where('admin_id', $id)->delete();
        } else {
            'Gagal';
        }

        User::where('id', $id)->delete();

        return redirect('/superadmin/daftar-admin');
    }

    public function nonaktifEditAdminDesa($id)
    {
        User::where('id', $id)->update([
            'edit_admin_desa' => '0',
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function aktifEditAdminDesa($id)
    {
        User::where('id', $id)->update([
            'edit_admin_desa' => '1',
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function nonaktifApproveWisata($id)
    {
        User::where('id', $id)->update([
            'approve_wisata' => '0',
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function aktifApproveWisata($id)
    {
        User::where('id', $id)->update([
            'approve_wisata' => '1',
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function nonaktifTambahEditAdminDestinasi($id)
    {
        User::where('id', $id)->update([
            'tambah_edit_admin_destinasi' => '0',
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function aktifTambahEditAdminDestinasi($id)
    {
        User::where('id', $id)->update([
            'tambah_edit_admin_destinasi' => '1',
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function nonaktifMengajukanDestinasi($id)
    {
        User::where('id', $id)->update([
            'mengajukan_destinasi' => '0',
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function aktifMengajukanDestinasi($id)
    {
        User::where('id', $id)->update([
            'mengajukan_destinasi' => '1',
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function nonaktifKonfirmasiTiket($id)
    {
        User::where('id', $id)->update([
            'konfirmasi_tiket' => '0',
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    public function aktifKonfirmasiTiket($id)
    {
        User::where('id', $id)->update([
            'konfirmasi_tiket' => '1',
        ]);

        return redirect('/superadmin/daftar-admin');
    }

    // ADMIN KABUPATEN
    public function adminKabupaten()
    {
        $id_user = Auth::user()->id;
        $id_provinsi = Auth::user()->province_id;
        $id_kabupaten = Auth::user()->regency_id;

        $profil = ProfilKabupaten::where('admin_id', 'like', '%' . Auth::user()->id . '%')->first();

        $idKabupaten = Auth::user()->regency_id;
        $tiket = Tiket::whereIn('destinasi_id', function ($query) use ($idKabupaten) {
            $query->select('id')->from('destinasi')->where('regency_id', $idKabupaten)->where('konfirmasi', '1');
        })->orWhereIn('paket_id', function ($query) use ($idKabupaten) {
            $query->select('id')->from('paket')->whereIn('village_id', function ($subquery) use ($idKabupaten) {
                $subquery->select('village_id')->from('profil_desa')->where('regency_id', $idKabupaten)->where('konfirmasi', '1');
            });
        })->paginate(7);

        $destinasi = Destinasi::where('regency_id', $id_kabupaten)->get();
        $jumlahDestinasi = count($destinasi);

        $desa = ProfilDesa::where('regency_id', $id_kabupaten)->get();
        $jumlahDesa = count($desa);

        $desa = User::whereIn('role_id', [3, 4])->where('regency_id', $id_kabupaten)->get();
        $jumlahAdmin = count($desa);

        $jumlahTiket = Tiket::whereIn('destinasi_id', function ($query) use ($idKabupaten) {
            $query->select('id')->from('destinasi')->where('regency_id', $idKabupaten)->where('konfirmasi', '1');
        })->orWhereIn('paket_id', function ($query) use ($idKabupaten) {
            $query->select('id')->from('paket')->whereIn('village_id', function ($subquery) use ($idKabupaten) {
                $subquery->select('village_id')->from('profil_desa')->where('regency_id', $idKabupaten)->where('konfirmasi', '1');
            });
        })->count();
        // dd($jumlahTiket);

        $provinsi = Province::where('id', $id_provinsi)->first();

        return view('adminkabupaten.dashboard2', ['profil' => $profil, 'tiket' => $tiket, 'jumlahDestinasi' => $jumlahDestinasi, 'jumlahDesa' => $jumlahDesa, 'jumlahAdmin' => $jumlahAdmin, 'provinsi' => $provinsi, 'jumlahTiket' => $jumlahTiket]);
    }

    public function editProfilAdminKabupaten(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kabupaten' => 'required',
            'foto_kabupaten' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $client = new Client();

        if ($request->hasfile('foto_kabupaten')) {
            $file = $request->file('foto_kabupaten');
            $name = $file->getClientOriginalName();
            $file->move(public_path('/images'), $name);

            ProfilKabupaten::where('admin_id', $id)->update([
                'nama_kabupaten' => $request->nama_kabupaten,
                'foto_kabupaten' => $name,
            ]);

            return redirect('/admin-kabupaten');
        } else {
            $imagePost = "kabupaten_default.jpg";

            ProfilKabupaten::where('admin_id', $id)->update([
                'nama_kabupaten' => $request->nama_kabupaten,
                'foto_kabupaten' => $imagePost,
            ]);

            return redirect('/admin-kabupaten');
        }
    }

    public function daftarAdminKabupaten()
    {
        $id = Auth::user()->regency_id;
        $role_id = ['3', '4'];
        $admin = User::latest()->where('role_id', $role_id)->where('regency_id', $id)->paginate(10);

        return view('adminkabupaten.daftarAdmin2', ['admin' => $admin]);
    }

    public function tambahAdminDesa(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            // English uppercase characters (A – Z)
            // English lowercase characters (a – z)
            // Base 10 digits (0 – 9)
            // Non-alphanumeric (For example: !, $, #, or %)
            'phone' => 'required|numeric|digits_between:10,13',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => 3,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'province_id' => Auth::user()->province_id,
            'regency_id' => Auth::user()->regency_id,
            'district_id' => $request->district_id,
            'village_id' => $request->village_id,
            'edit_admin_desa' => '0',
            'approve_wisata' => '0',
            'tambah_edit_admin_destinasi' => '1',
            'mengajukan_destinasi' => '1',
            'konfirmasi_tiket' => '0',
        ]);

        return redirect('/admin-kabupaten/daftar-admin');
    }

    public function kabNonaktifTambahEditAdminDestinasi($id)
    {
        User::where('id', $id)->update([
            'tambah_edit_admin_destinasi' => '0',
        ]);

        return redirect('/admin-kabupaten/daftar-admin');
    }

    public function kabAktifTambahEditAdminDestinasi($id)
    {
        User::where('id', $id)->update([
            'tambah_edit_admin_destinasi' => '1',
        ]);

        return redirect('/admin-kabupaten/daftar-admin');
    }

    public function kabNonaktifMengajukanDestinasi($id)
    {
        User::where('id', $id)->update([
            'mengajukan_destinasi' => '0',
        ]);

        return redirect('/admin-kabupaten/daftar-admin');
    }

    public function kabAktifMengajukanDestinasi($id)
    {
        User::where('id', $id)->update([
            'mengajukan_destinasi' => '1',
        ]);

        return redirect('/admin-kabupaten/daftar-admin');
    }

    public function kabHapusAdminDesa($id)
    {
        $user = User::where('regency_id', Auth::user()->regency_id);
        if ($user) {
            User::where('id', $id)->delete();
            return redirect('/admin-kabupaten/daftar-admin');
        } else {
            return redirect('/admin-kabupaten/daftar-admin');
        }
    }

    public function destinasiAdminKabupaten()
    {
        $destinasi = Destinasi::latest()->where('regency_id', Auth::user()->regency_id)->paginate(10);

        $kategori = Kategori::latest()->get();

        $kecamatan = District::all();

        return view('adminkabupaten.destinasi2', ['destinasi' => $destinasi, 'kategori' => $kategori, 'kecamatan' => $kecamatan]);
    }

    public function approveDestinasiAdminKabupaten($id)
    {
        $client = new Client();
        $response = $client->request('GET', 'http://localhost/wisata/public/api/approve-destinasi/' . $id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body, true);

        return redirect('/admin-kabupaten/destinasi');
    }

    public function rejectDestinasiAdminKabupaten($id)
    {
        $client = new Client();
        $response = $client->request('GET', 'http://localhost/wisata/public/api/reject-destinasi/' . $id);
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $data = json_decode($body, true);

        return redirect('/admin-kabupaten/destinasi');
    }

    public function hapusDestinasiAdminKabupaten($id)
    {
        $destinasi = Destinasi::where('regency_id', Auth::user()->regency_id);
        if ($destinasi) {
            Destinasi::where('id', $id)->delete();
            return redirect('/admin-kabupaten/destinasi');
        } else {
            return redirect('/admin-kabupaten/destinasi');
        }
    }

    // ADMIN DESA
    public function adminDesa()
    {
        $destinasi = Destinasi::where('village_id', Auth::user()->village_id)->get();
        $jumlahDestinasi = count($destinasi);

        $admin = User::where('village_id', Auth::user()->village_id)->where('role_id', 4)->get();
        $jumlahAdmin = count($admin);

        $jumlahTiket = Tiket::whereIn('destinasi_id', function ($query) {
            $query->select('id')->from('destinasi')->where('village_id', Auth::user()->village_id)->where('konfirmasi', '1');
        })->orWhereIn('paket_id', function ($query) {
            $query->select('id')->from('paket')->where('village_id', Auth::user()->village_id)->where('konfirmasi', '1');
        })->count();

        $paket = Paket::where('village_id', Auth::user()->village_id)->get();
        $jumlahPaket = count($paket);

        $profil = ProfilDesa::where('admin_id', 'like', '%' . Auth::user()->id . '%')->first();

        $foto = $profil->foto_desa;
        $foto = explode("|", $foto);

        $user = User::where('id', Auth::user()->id)->first();

        $idDesa = Auth::user()->village_id;
        $tiket = Tiket::whereIn('destinasi_id', function ($query) use ($idDesa) {
            $query->select('id')->from('destinasi')->where('village_id', $idDesa)->where('konfirmasi', '1');
        })->orWhereIn('paket_id', function ($query) use ($idDesa) {
            $query->select('id')->from('paket')->where('village_id', $idDesa)->where('konfirmasi', '1');
        })->latest()->paginate(5);

        return view('admindesa.dashboard2', ['tiket' => $tiket, 'jumlahDestinasi' => $jumlahDestinasi, 'jumlahAdmin' => $jumlahAdmin, 'jumlahTiket' => $jumlahTiket, 'jumlahPaket' => $jumlahPaket, 'profil' => $profil, 'user' => $user, 'foto' => $foto]);
    }

    public function editProfilAdminDesa(Request $request, $id)
    {
        $this->validate($request, [
            'email' => 'required',
            'phone' => 'required',
            'alamat_desa' => 'required',
            'deskripsi_desa' => 'required',
        ]);

        User::where('id', $id)->update([
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        ProfilDesa::where('admin_id', $id)->update([
            'alamat_desa' => $request->alamat_desa,
            'deskripsi_desa' => $request->deskripsi_desa,
        ]);

        return redirect('/admin-desa');
    }

    public function daftarAdminDestinasi()
    {
        $user = User::latest()->where('role_id', 4)->paginate(7);

        $destinasi = Destinasi::latest()->get();

        return view('admindesa.daftarAdmin2', ['user' => $user, 'destinasi' => $destinasi]);
    }

    public function tambahAdminDestinasi(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            // English uppercase characters (A – Z)
            // English lowercase characters (a – z)
            // Base 10 digits (0 – 9)
            // Non-alphanumeric (For example: !, $, #, or %)
            'phone' => 'required|numeric|digits_between:10,13',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'province_id' => Auth::user()->province_id,
            'regency_id' => Auth::user()->regency_id,
            'district_id' => Auth::user()->district_id,
            'village_id' => Auth::user()->village_id,
            'destinasi_id' => $request->destinasi_id,
            'phone' => $request->phone,
            'role_id' => '4',
            'edit_admin_desa' => '0',
            'approve_wisata' => '0',
            'tambah_edit_admin_destinasi' => '0',
            'mengajukan_destinasi' => '0',
            'konfirmasi_tiket' => '1',
        ]);

        return redirect('/admin-desa/daftar-admin');
    }

    public function hapusAdminDestinasi($id)
    {
        User::where('id', $id)->delete();
        return redirect('/admin-desa/daftar-admin');
    }

    public function desNonaktifKonfirmasiTiket($id)
    {
        User::where('id', $id)->update([
            'konfirmasi_tiket' => '0',
        ]);

        return redirect('/admin-desa/daftar-admin');
    }

    public function desAktifKonfirmasiTiket($id)
    {
        User::where('id', $id)->update([
            'konfirmasi_tiket' => '1',
        ]);

        return redirect('/admin-desa/daftar-admin');
    }

    public function destinasiAdminDesa()
    {
        $destinasi = Destinasi::latest()->where('village_id', Auth::user()->village_id)->paginate(7);

        $kategori = Kategori::latest()->get();

        return view('admindesa.destinasi2', ['destinasi' => $destinasi, 'kategori' => $kategori]);
    }

    public function desTambahDestinasi(Request $request)
    {
        $files = [];
        if ($request->hasfile('foto_destinasi')) {
            foreach ($request->file('foto_destinasi') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('/images'), $name);
                $files[] = $name;
            }

            Destinasi::create([
                'nama_destinasi' => $request->nama_destinasi,
                'kategori_id' => $request->kategori_id,
                'alamat_destinasi' => $request->alamat_destinasi,
                'deskripsi_destinasi' => $request->deskripsi_destinasi,
                'maps_destinasi' => $request->maps_destinasi,
                'htm_destinasi' => $request->htm_destinasi,
                'foto_destinasi' => implode("|", $files),
                'province_id' => Auth::user()->province_id,
                'regency_id' => Auth::user()->regency_id,
                'district_id' => Auth::user()->district_id,
                'village_id' => Auth::user()->village_id,
                'approve' => '0',
            ]);

            return redirect('/admin-desa/destinasi');
        } else {
            $imagePost = "default_kabupaten.jpg";

            Destinasi::create([
                'nama_destinasi' => $request->nama_destinasi,
                'kategori_id' => $request->kategori_id,
                'alamat_destinasi' => $request->alamat_destinasi,
                'deskripsi_destinasi' => $request->deskripsi_destinasi,
                'maps_destinasi' => $request->maps_destinasi,
                'htm_destinasi' => $request->htm_destinasi,
                'foto_destinasi' => $imagePost,
                'province_id' => Auth::user()->province_id,
                'regency_id' => Auth::user()->regency_id,
                'district_id' => Auth::user()->district_id,
                'village_id' => Auth::user()->village_id,
                'approve' => '0',
            ]);

            return redirect('/admin-desa/destinasi');
        }
    }

    public function desEditDestinasi(Request $request, $id)
    {
        $this->validate($request, [
            'nama_destinasi' => 'required',
            'kategori_id' => 'required',
            'alamat_destinasi' => 'required',
            'deskripsi_destinasi' => 'required',
            'maps_destinasi' => 'required',
            'htm_destinasi' => 'required',
        ]);

        $files = [];
        if ($request->hasfile('foto_destinasi')) {
            foreach ($request->file('foto_destinasi') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('/images'), $name);
                $files[] = $name;
            }

            Destinasi::where('id', $id)->update([
                'nama_destinasi' => $request->nama_destinasi,
                'kategori_id' => $request->kategori_id,
                'alamat_destinasi' => $request->alamat_destinasi,
                'deskripsi_destinasi' => $request->deskripsi_destinasi,
                'maps_destinasi' => $request->maps_destinasi,
                'htm_destinasi' => $request->htm_destinasi,
                'foto_destinasi' => implode("|", $files),
            ]);

            return redirect('/admin-desa/destinasi');
        } else {
            Destinasi::where('id', $id)->update([
                'nama_destinasi' => $request->nama_destinasi,
                'kategori_id' => $request->kategori_id,
                'alamat_destinasi' => $request->alamat_destinasi,
                'deskripsi_destinasi' => $request->deskripsi_destinasi,
                'maps_destinasi' => $request->maps_destinasi,
                'htm_destinasi' => $request->htm_destinasi,
            ]);

            return redirect('/admin-desa/destinasi');
        }
    }

    public function desHapusDestinasi($id)
    {
        Destinasi::where('id', $id)->delete();
        return redirect('/admin-desa/destinasi');
    }

    public function desPaketDestinasi()
    {
        $paket = Paket::latest()->where('village_id', Auth::user()->village_id)->where('jenis', 'Destinasi')->paginate(6);

        $destinasi = Destinasi::where('village_id', Auth::user()->village_id)->get();

        return view('admindesa.paketDestinasi2', ['paket' => $paket, 'destinasi' => $destinasi]);
    }

    public function desTambahPaket(Request $request)
    {
        // dd($request->all());

        // Mendapatkan nilai checkbox yang dipilih
        $checkboxValues = $request->input('checkbox', []);

        // Menggabungkan nilai-nilai checkbox menjadi satu string
        $combinedValue = implode('|', $checkboxValues);

        Paket::create([
            'nama_paket' => $request->nama_paket,
            'harga_paket' => $request->harga_paket,
            'harga_normal' => $request->harga_normal,
            'jenis' => 'Destinasi',
            'village_id' => Auth::user()->village_id,
            'destinasi_id' => null,
            'destinasi' => $combinedValue,
            'wahana' => null,
        ]);

        return redirect('/admin-desa/paket-destinasi');
    }

    public function desHapusPaket($id)
    {
        $id_paket = Paket::where('id', $id)->first();
        if (Auth::user()->village_id == $id_paket->village_id) {
            Paket::where('id', $id)->delete();
            return redirect('/admin-desa/paket-destinasi');
        } else {
            return redirect('/admin-desa/paket-destinasi');
        }
    }

    // Admin Destinasi
    public function adminDestinasi()
    {
        $jumlahUser = User::where('role_id', '5')->count();
        $jumlahTiket = Tiket::where('destinasi_id', Auth::user()->destinasi_id)->orWhereIn('paket_id', function ($query) {
            $query->select('id')->from('paket')->where('destinasi_id', Auth::user()->destinasi_id)->where('konfirmasi', '1');
        })->count();
        $jumlahWahana = Wahana::where('destinasi_id', Auth::user()->destinasi_id)->count();
        $jumlahPaket = Paket::where('destinasi_id', Auth::user()->destinasi_id)->count();

        $profil = Destinasi::where('id', Auth::user()->destinasi_id)->first();

        $foto = $profil->foto_destinasi;
        $foto = explode("|", $foto);

        $kategori = Kategori::latest()->get();

        return view('admindestinasi.dashboard2', ['profil' => $profil, 'foto' => $foto, 'kategori' => $kategori, 'jumlahUser' => $jumlahUser, 'jumlahTiket' => $jumlahTiket, 'jumlahWahana' => $jumlahWahana, 'jumlahPaket' => $jumlahPaket]);
    }

    public function editProfilAdminDestinasi(Request $request, $id)
    {
        $this->validate($request, [
            'nama_destinasi' => 'required',
            'kategori_id' => 'required',
            'alamat_destinasi' => 'required',
            'deskripsi_destinasi' => 'required',
            'htm_destinasi' => 'required',
        ]);

        $files = [];
        if ($request->hasfile('foto_destinasi')) {
            foreach ($request->file('foto_destinasi') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('/images'), $name);
                $files[] = $name;
            }

            Destinasi::where('id', $id)->update([
                'nama_destinasi' => $request->nama_destinasi,
                'kategori_id' => $request->kategori_id,
                'alamat_destinasi' => $request->alamat_destinasi,
                'deskripsi_destinasi' => $request->deskripsi_destinasi,
                'htm_destinasi' => $request->htm_destinasi,
                'foto_destinasi' => implode("|", $files),
            ]);

            return redirect('/admin-destinasi');
        } else {
            Destinasi::where('id', $id)->update([
                'nama_destinasi' => $request->nama_destinasi,
                'kategori_id' => $request->kategori_id,
                'alamat_destinasi' => $request->alamat_destinasi,
                'deskripsi_destinasi' => $request->deskripsi_destinasi,
                'htm_destinasi' => $request->htm_destinasi,
            ]);

            return redirect('/admin-destinasi');
        }
    }

    public function konfirmasiTiket()
    {
        $tiket = Tiket::where('destinasi_id', Auth::user()->destinasi_id)->where('konfirmasi', '1')->orWhereIn('paket_id', function ($query) {
            $query->select('id')->from('paket')->where('destinasi_id', Auth::user()->destinasi_id)->where('konfirmasi', '1');
        })->latest()->paginate(7);

        $destinasi = Destinasi::where('id', Auth::user()->destinasi_id)->first();

        return view('admindestinasi.konfirmasiTiket2', ['tiket' => $tiket, 'destinasi' => $destinasi]);
    }

    public function konfirmasiTiketId($id)
    {
        Tiket::where('id', $id)->update([
            'konfirmasi' => '1'
        ]);

        return redirect('/admin-destinasi/konfirmasi-tiket');
    }

    public function wahana()
    {
        $wahana = Wahana::latest()->where('destinasi_id', Auth::user()->destinasi_id)->paginate(6);

        return view('admindestinasi.wahana2', ['wahana' => $wahana]);
    }

    public function tambahWahana(Request $request)
    {
        $this->validate($request, [
            'nama_wahana' => 'required',
            'htm_wahana' => 'required',
            'deskripsi_wahana' => 'required',
        ]);

        $files = [];
        if ($request->hasfile('foto_wahana')) {
            foreach ($request->file('foto_wahana') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('/images'), $name);
                $files[] = $name;
            }

            Wahana::create([
                'nama_wahana' => $request->name,
                'foto_wahana' => implode("|", $files),
                'htm_wahana' => $request->harga,
                'deskripsi_wahana' => $request->deskripsi_wahana,
                'destinasi_id' => Auth::user()->destinasi_id,
            ]);

            return redirect('/admin-destinasi/wahana');
        } else {
            $imagePost = "ktp.png";

            Wahana::create([
                'nama_wahana' => $request->name,
                'foto_wahana' => $imagePost,
                'htm_wahana' => $request->harga,
                'deskripsi_wahana' => $request->deskripsi_wahana,
                'destinasi_id' => Auth::user()->destinasi_id,
            ]);

            return redirect('/admin-destinasi/wahana');
        }
    }

    public function editWahana(Request $request, $id)
    {
        $this->validate($request, [
            'nama_wahana' => 'required',
            'htm_wahana' => 'required',
            'deskripsi_wahana' => 'required',
        ]);

        $files = [];
        if ($request->hasfile('foto_wahana')) {
            foreach ($request->file('foto_wahana') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('/images'), $name);
                $files[] = $name;
            }

            Wahana::where('id', $id)->update([
                'nama_wahana' => $request->nama_wahana,
                'foto_wahana' => implode("|", $files),
                'htm_wahana' => $request->htm_wahana,
                'deskripsi_wahana' => $request->deskripsi_wahana,
            ]);

            return redirect('/admin-destinasi/wahana');
        } else {
            Wahana::where('id', $id)->update([
                'nama_wahana' => $request->nama_wahana,
                'htm_wahana' => $request->htm_wahana,
                'deskripsi_wahana' => $request->deskripsi_wahana,
            ]);

            return redirect('/admin-destinasi/wahana');
        }
    }

    public function hapusWahana($id)
    {
        if (Wahana::where('destinasi_id', Auth::user()->destinasi_id)) {
            Wahana::where('id', $id)->delete();

            return redirect('/admin-destinasi/wahana');
        } else {
            return redirect('/admin-destinasi/wahana');
        }
    }

    public function paketWahana()
    {
        $paket = Paket::latest()->where('destinasi_id', Auth::user()->destinasi_id)->paginate(6);

        $wahana = Wahana::where('destinasi_id', Auth::user()->destinasi_id)->get();
        $destinasi = Destinasi::where('id', Auth::user()->destinasi_id)->first();

        return view('admindestinasi.paketWahana2', ['paket' => $paket, 'wahana' => $wahana, 'destinasi' => $destinasi]);
    }

    public function destTambahPaket(Request $request)
    {
        // Mendapatkan nilai checkbox yang dipilih
        $checkboxValues = $request->input('checkbox', []);

        // Menggabungkan nilai-nilai checkbox menjadi satu string
        $combinedValue = implode('|', $checkboxValues);

        Paket::create([
            'nama_paket' => $request->nama_paket,
            'harga_paket' => $request->harga_paket,
            'harga_normal' => $request->harga_normal,
            'jenis' => 'Wahana',
            'village_id' => Auth::user()->village_id,
            'destinasi_id' => Auth::user()->destinasi_id,
            'destinasi' => $request->destinasi,
            'wahana' => $combinedValue,
        ]);

        return redirect('/admin-destinasi/paket-wahana');
    }

    public function destHapusPaket($id)
    {
        $id_paket = Paket::where('id', $id)->first();
        if (Auth::user()->village_id == $id_paket->village_id) {
            Paket::where('id', $id)->delete();
            return redirect('/admin-destinasi/paket-wahana');
        } else {
            return redirect('/admin-destinasi/paket-wahana');
        }
    }
}
