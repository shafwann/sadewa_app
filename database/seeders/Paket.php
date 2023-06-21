<?php

namespace Database\Seeders;

use App\Models\Paket as ModelsPaket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Paket extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = [
            [
                'nama_paket' => 'Paket 1',
                'harga_paket' => 15000,
                'harga_normal' => 20000,
                'jenis' => 'Destinasi',
                'village_id' => '3519060003',
                'destinasi_id' => null,
                'destinasi' => 'Hutan Pinus Nongko Ijo|Air Terjun Selampir|Agro Wisata Perkebunan Kopi Kandangan|Aswin Loka Seweru',
                'wahana' => null,
            ],
            [
                'nama_paket' => 'Paket 2',
                'harga_paket' => 13000,
                'harga_normal' => 15000,
                'jenis' => 'Destinasi',
                'village_id' => '3519060003',
                'destinasi_id' => null,
                'destinasi' => 'Air Terjun Selampir|Agro Wisata Perkebunan Kopi Kandangan|Aswin Loka Seweru',
                'wahana' => null,
            ],
            [
                'nama_paket' => 'Paket 3',
                'harga_paket' => 8000,
                'harga_normal' => 10000,
                'jenis' => 'Destinasi',
                'village_id' => '3519060003',
                'destinasi_id' => null,
                'destinasi' => 'Agro Wisata Perkebunan Kopi Kandangan|Aswin Loka Seweru',
                'wahana' => null,
            ],
            [
                'nama_paket' => 'Paket 1',
                'harga_paket' => 50000,
                'harga_normal' => 55000,
                'jenis' => 'Wahana',
                'village_id' => '3519060003',
                'destinasi_id' => '1',
                'destinasi' => 'Hutan Pinus Nongko Ijo',
                'wahana' => 'Wahana 1|Wahana 2|Wahana 3|Wahana 4|Wahana 5',
            ],
            [
                'nama_paket' => 'Paket 2',
                'harga_paket' => 45000,
                'harga_normal' => 50000,
                'jenis' => 'Wahana',
                'village_id' => '3519060003',
                'destinasi_id' => '1',
                'destinasi' => 'Hutan Pinus Nongko Ijo',
                'wahana' => 'Wahana 1|Wahana 2|Wahana 3|Wahana 4',
            ],
            [
                'nama_paket' => 'Paket 3',
                'harga_paket' => 40000,
                'harga_normal' => 45000,
                'jenis' => 'Wahana',
                'village_id' => '3519060003',
                'destinasi_id' => '1',
                'destinasi' => 'Hutan Pinus Nongko Ijo',
                'wahana' => 'Wahana 1|Wahana 2|Wahana 3',
            ],
        ];

        foreach ($kategori as $key => $value) {
            ModelsPaket::create($value);
        }
    }
}
