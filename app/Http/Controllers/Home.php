<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Destinasi;
use App\Models\Kategori;
use App\Models\Paket;
use App\Models\ProfilDesa;
use App\Models\ProfilKabupaten;
use App\Models\Regency;
use App\Models\Tiket;
use App\Models\User;
use App\Models\Wahana;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Storage;
use Midtrans\Snap;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Home extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::first()->gambar;
        $banner = explode("|", $banner);

        $client = new Client();
        $response = $client->request('GET', 'http://localhost/wisata/public/api/kategori');
        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        $kategori = json_decode($body, true);

        $kategori1 = Kategori::all();

        $destinasi = Destinasi::where('approve', '1')->latest()->paginate(6);
        // $destinasi = Destinasi::latest()->paginate(4);

        $arrayGambar = Destinasi::where('approve', '1')->first()->foto_destinasi;
        // $arrayGambar = explode("|", $destinasiArray);

        $response2 = $client->request('GET', 'http://localhost/wisata/public/api/profil-kabupaten');
        $statusCode2 = $response2->getStatusCode();
        $body2 = $response2->getBody();

        $kabupaten = json_decode($body2, true);

        // $regency = Regency::all();
        $regency = ProfilKabupaten::all();

        $response3 = $client->request('GET', 'http://localhost/wisata/public/api/profil-desa');
        $statusCode3 = $response3->getStatusCode();
        $body3 = $response3->getBody();

        $desa = json_decode($body3, true);

        $profildesa = ProfilDesa::latest()->paginate(4);

        return view('home.index', ['banner' => $banner, 'kategori' => $kategori, 'kategori1' => $kategori1, 'regency' => $regency, 'destinasi' => $destinasi, 'kabupaten' => $kabupaten, 'desa' => $desa, 'arrayGambar' => $arrayGambar, 'profildesa' => $profildesa]);
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

    public function kabupaten()
    {
        $client = new Client();
        $response2 = $client->request('GET', 'http://localhost/wisata/public/api/profil-kabupaten');
        $statusCode2 = $response2->getStatusCode();
        $body2 = $response2->getBody();

        $kabupaten = json_decode($body2, true);

        $response3 = $client->request('GET', 'http://localhost/wisata/public/api/profil-desa');
        $statusCode3 = $response3->getStatusCode();
        $body3 = $response3->getBody();

        $desa = json_decode($body3, true);

        return view('home.kabupaten', ['kabupaten' => $kabupaten, 'desa' => $desa]);
    }

    public function detailKabupaten($id)
    {
        $client = new Client();
        $response2 = $client->request('GET', 'http://localhost/wisata/public/api/profil-kabupaten-spesifik/' . $id);
        $statusCode2 = $response2->getStatusCode();
        $body2 = $response2->getBody();

        $kabupaten = json_decode($body2, true);

        $response3 = $client->request('GET', 'http://localhost/wisata/public/api/profil-desa');
        $statusCode3 = $response3->getStatusCode();
        $body3 = $response3->getBody();

        $desa = json_decode($body3, true);

        return view('home.detailKabupaten', ['kabupaten' => $kabupaten, 'desa' => $desa]);
    }

    public function desa()
    {
        $desa = ProfilDesa::latest()->paginate(9);

        return view('home.desa', ['desa' => $desa]);
    }

    public function detailDesa($id)
    {
        $desa = ProfilDesa::where('id', $id)->first();

        $dataGambar = ProfilDesa::where('id', $id)->first()->foto_desa;
        $arrayGambar = explode("|", $dataGambar);

        $desa_id = ProfilDesa::where('id', $id)->first()->village_id;
        $destinasi = Destinasi::where('village_id', $desa_id)->paginate(6);

        $kategori = Kategori::latest();

        $id_paket_village = ProfilDesa::where('id', $id)->first();

        $paket = Paket::where('jenis', 'Destinasi')->where('village_id', $id_paket_village['village_id'])->get();

        return view('home.detailDesa', ['desa' => $desa, 'arrayGambar' => $arrayGambar, 'destinasi' => $destinasi, 'kategori' => $kategori, 'paket' => $paket]);
    }

    public function destinasi(Request $request)
    {
        $kategori = Kategori::all();
        $destinasi = Destinasi::latest()->paginate(5);

        $idKabupaten = ProfilKabupaten::where('nama_kabupaten', request()->kabupaten)->first()->regency_id;
        $idKategori = Kategori::where('nama_kategori', request()->kategori)->first()->id;

        if (request()->kabupaten) {
            $destinasi = Destinasi::where('regency_id', $idKabupaten)->where('kategori_id', $idKategori)->paginate(5)->withQueryString();
        }

        return view('home.destinasi', ['destinasi' => $destinasi, 'kategori' => $kategori]);
    }

    public function detailDestinasi($id)
    {
        $destinasi = Destinasi::where('id', $id)->first();

        // asumsi data gambar tersimpan di dalam variabel $dataGambar
        $dataGambar = Destinasi::where('id', $id)->first()->foto_destinasi;

        // memecah data gambar menjadi array dengan pemisah "|"
        $arrayGambar = explode("|", $dataGambar);

        $kategori = Kategori::where('id', Destinasi::where('id', $id)->first()->kategori_id)->get();

        $wahana = Wahana::where('destinasi_id', $id)->paginate(4, ['*'], 'wahanaPage');
        // dd($wahana );

        $paket = Paket::where('jenis', 'Wahana')->where('destinasi_id', $id)->paginate(4, ['*'], 'paketPage');

        return view('home.detailDestinasi', ['destinasi' => $destinasi, 'kategori' => $kategori, 'arrayGambar' => $arrayGambar, 'wahana' => $wahana, 'paket' => $paket]);
    }

    public function pesanDestinasi($id)
    {
        $destinasi = Destinasi::where('id', $id)->first();

        return view('home.pesan', ['destinasi' => $destinasi]);
    }

    public function pesanPaket($id)
    {
        $paket = Paket::where('id', $id)->first();

        return view('home.pesan', ['paket' => $paket]);
    }

    public function prosesPesanDestinasi(Request $request, $id_destinasi, $id_user)
    {
        $user = User::where('id', $id_user)->first();
        $tiket = Tiket::create([
            'nama_pemesan' => $user['name'],
            'jumlah_tiket' => $request->jumlah,
            'tanggal_kunjungan' => $request->tanggal,
            'user_id' => $id_user,
            'destinasi_id' => $id_destinasi,
            'konfirmasi' => '0',
        ]);

        $destinasi = Destinasi::where('id', $id_destinasi)->first();
        $total = $request->jumlah * $destinasi['htm_destinasi'];

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $tiket->id,
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => $user['name'],
                'last_name' => '',
                'email' => $user['email'],
                'phone' => $user['phone'],
            ),
        );

        $snapTokenDestinasi = \Midtrans\Snap::getSnapToken($params);

        return view('home.checkout', ['snapTokenDestinasi' => $snapTokenDestinasi, 'tiket' => $tiket, 'destinasi' => $destinasi, 'total' => $total, 'user' => $user]);
    }

    // public function prosesPesanPaket(Request $request, $id_paket, $id_user)
    // {
    //     $client = new \GuzzleHttp\Client();

    //     $user = User::where('id', $id_user)->first();
    //     $tiket = Tiket::create([
    //         'nama_pemesan' => $user['name'],
    //         'jumlah_tiket' => $request->jumlah,
    //         'tanggal_kunjungan' => $request->tanggal,
    //         'user_id' => $id_user,
    //         'paket_id' => $id_paket,
    //         'konfirmasi' => '0',
    //     ]);

    //     $paket = Paket::where('id', $id_paket)->first();
    //     $total = $request->jumlah * $paket['harga_paket'];

    //     // Set your Merchant Server Key
    //     \Midtrans\Config::$serverKey = config('midtrans.server_key');
    //     // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    //     \Midtrans\Config::$isProduction = config('midtrans.is_production');
    //     // Set sanitization on (default)
    //     \Midtrans\Config::$isSanitized = true;
    //     // Set 3DS transaction for credit card to true
    //     \Midtrans\Config::$is3ds = true;

    //     $response = $client->request('POST', 'https://api.sandbox.midtrans.com/v2/charge', [
    //         'body' => '{"payment_type":"qris","transaction_details":{"order_id":$tiket->id,"gross_amount":$total},"qris":{"acquirer":"gopay","customer_details":{"first_name" => $user["name"],
    //     //         "last_name" => "",
    //     //         "email" => $user["email"],
    //     //         "phone" => $user["phone"],}}',
    //         'headers' => [
    //             'accept' => 'application/json',
    //             'authorization' => 'Basic c2hhZndhbjpzaGFmd2FuMjAxNg==',
    //             'content-type' => 'application/json',
    //         ],
    //     ]);

    //     echo $response->getBody();
    // }

    public function prosesPesanPaket(Request $request, $id_paket, $id_user)
    {
        $user = User::where('id', $id_user)->first();
        $tiket = Tiket::create([
            'nama_pemesan' => $user['name'],
            'jumlah_tiket' => $request->jumlah,
            'tanggal_kunjungan' => $request->tanggal,
            'user_id' => $id_user,
            'paket_id' => $id_paket,
            'konfirmasi' => '0',
        ]);

        $paket = Paket::where('id', $id_paket)->first();
        $total = $request->jumlah * $paket['harga_paket'];

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $tiket->id,
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => $user['name'],
                'last_name' => '',
                'email' => $user['email'],
                'phone' => $user['phone'],
            ),
        );

        $snapTokenPaket = \Midtrans\Snap::getSnapToken($params);

        return view('home.checkout', ['snapTokenPaket' => $snapTokenPaket, 'tiket' => $tiket, 'paket' => $paket, 'total' => $total, 'user' => $user]);
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                $tiket = Tiket::find($request->order_id);
                $tiket->update(['konfirmasi' => '1']);
            }
        }
    }

    public function invoiceDestinasi($id)
    {
        $tiket = Tiket::find($id);
        $user = User::where('id', $tiket['user_id'])->first();
        $destinasi = Destinasi::where('id', $tiket['destinasi_id'])->first();
        $total = $tiket['jumlah_tiket'] * $destinasi['htm_destinasi'];

        // Generate QR Code dan simpan sebagai file gambar
        // QrCode::format('png')->generate($tiket['id'], public_path('qrcode.png'));

        // Menghasilkan URL gambar QR Code
        // $imageUrl = QrCode::format('png')->size(200)->generate($tiket['id']);

        // Menampilkan QR Code langsung pada view
        $qrCode = QrCode::format('svg')->size(100)->generate($tiket['id']);

        return view('home.invoice', ['tiket' => $tiket, 'user' => $user, 'destinasi' => $destinasi, 'total' => $total, 'qrCode' => $qrCode]);
    }

    public function invoicePaket($id)
    {
        $tiket = Tiket::find($id);
        $user = User::where('id', $tiket['user_id'])->first();
        $paket = Paket::where('id', $tiket['paket_id'])->first();
        $total = $tiket['jumlah_tiket'] * $paket['harga_paket'];

        // Menampilkan QR Code langsung pada view
        $qrCode = QrCode::format('svg')->size(100)->generate('id_tiket = ' . $tiket['id'] . ', nama = ' . $tiket['nama_pemesan'] . ', user_id = ' . $tiket['user_id'] . ', status = ' . $tiket['konfirmasi']);

        return view('home.invoice', ['tiket' => $tiket, 'user' => $user, 'paket' => $paket, 'total' => $total, 'qrCode' => $qrCode]);
    }

    public function daftarPemesanan()
    {
        $id = Auth::user()->id;
        $tiket = Tiket::where('user_id', $id)->where('konfirmasi', '1')->orderBy('created_at', 'desc')->paginate(10);

        $admin = User::all();
        $destinasi = Destinasi::all();
        $paket = Paket::all();

        return view('home.daftarPemesanan', ['tiket' => $tiket, 'destinasi' => $destinasi, 'paket' => $paket, 'admin' => $admin]);
    }

    public function downloadTiket($id)
    {
        $tiket = Tiket::where('id', $id)->first();

        $user = User::where('id', $tiket->user_id)->first();

        if ($tiket->paket_id === null) {
            $paket = null;
            $destinasi = Destinasi::where('id', $tiket->destinasi_id)->first();
        } else {
            $paket = Paket::where('id', $tiket->paket_id)->first();
            $destinasi = null;
        }

        $qrCodePath = public_path('qrcode/' . $tiket['id'] . '.png');
        $qrCode = QrCode::format('png')->size(200)->generate('id_tiket = ' . $tiket['id'] . ', nama = ' . $tiket['nama_pemesan'] . ', user_id = ' . $tiket['user_id'] . ', status = ' . $tiket['konfirmasi'], $qrCodePath);
        $qrCodeData = base64_encode(file_get_contents($qrCodePath));
        $dataQrCode = [
            'qrCodeData' => $qrCodeData
        ];


        // Simpan QR code ke storage (opsional)
        $qrCodeStoragePath = 'public/qrcode/' . $tiket['id'] . '.png';
        Storage::put($qrCodeStoragePath, file_get_contents($qrCodePath));

        // $qrCode = QrCode::format('png')->generate('Konten QR code di sini');

        // $filePath = public_path('qrcode/file.png');
        // $qrCode->save($filePath);

        // Mengambil path absolut ke gambar
        $imagePath = public_path('assets/img/logotulis.png');

        // Mengubah gambar menjadi base64
        $imageData = base64_encode(file_get_contents($imagePath));

        // Menyiapkan data untuk ditampilkan dalam view PDF
        $data = [
            'imageData' => $imageData
        ];

        $pdf = Pdf::loadView('home.pdf', ['tiket' => $tiket, 'user' => $user, 'destinasi' => $destinasi, 'paket' => $paket, 'data' => $data, 'dataQrCode' => $dataQrCode]);

        return $pdf->download($id . '.pdf');
    }

    public function map()
    {
        return view('home.tutorialMap');
    }
}
