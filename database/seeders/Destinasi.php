<?php

namespace Database\Seeders;

use App\Models\Destinasi as ModelsDestinasi;
use Illuminate\Database\Seeder;

class Destinasi extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destinasi = [
            [
                'nama_destinasi' => 'Hutan Pinus Nongko Ijo',
                'kategori_id' => '1',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060003',
                'deskripsi_destinasi' => 'Pohon Pinus ditanam mulai tahun 1981. Menurut pengelola hutan pinus, sejarah awal mula dinamakan "Nongko Ijo" berawal dari cerita dahulu pada awal ditanam pohon pinus terdapat pohon nongko hijau yang sangat besar yang tumbuh disekitar hutan. Hutan Pinus Nongko Ijo dikenal di masyarakat luas semenjak ada salah satu media masa (surat kabar) yang meliput keberadaan hutan pinus dengan isi berita menyebutkan nama hutan pinus nongko ijo. Hingga sekarang masyarakat mengenal hutan pinus tersebut dengan nama nongko ijo.',
                'maps_destinasi' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15814.087677377449!2d111.6817290105591!3d-7.734329027059213!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79afe6906b5b9b%3A0x596fc20d052be1ff!2sHutan%20Pinus%20NONGKO%20IJO!5e0!3m2!1sid!2sid!4v1687278522262!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'foto_destinasi' => 'pexels1.jpg|pexels3.jpg',
                'alamat_destinasi' => 'Kare, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'htm_destinasi' => 5000,
                'approve' => '1',
            ],
            [
                'nama_destinasi' => 'Air Terjun Selampir',
                'kategori_id' => '1',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060003',
                'deskripsi_destinasi' => 'Air terjun yang terletak di lereng gunung Wilis, tepatnya di Desa Kare. Destinasi ini masih satu wilayah dengan perkebunan kopi Kandangan di wilayah Kabupaten Madiun . Dengan ketinggian 400 m dpl serta luas sekitar 6 Ha, menjadikan tempat ini begitu sejuk dan nyaman untuk dinikmati . Dimanjakan dengan sumber mata air dari bawah gunung dan muncul di atas pepohonan yang rindang.',
                'maps_destinasi' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15813.596358080657!2d111.7033853!3d-7.7474247!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79af166d0a66a7%3A0xa6f11a4a28e6bedb!2sAir%20Terjun%20Selampir%2FKedung%20Malem!5e0!3m2!1sid!2sid!4v1687278582944!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'foto_destinasi' => 'alam.jpg|pexels1.jpg',
                'alamat_destinasi' => '7P33+29J, Branjang, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'htm_destinasi' => 5000,
                'approve' => '1',
            ],
            [
                'nama_destinasi' => 'Agro Wisata Perkebunan Kopi Kandangan',
                'kategori_id' => '1',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060003',
                'deskripsi_destinasi' => 'Bagi pecinta kopi, tempat ini tidak bisa kita abaikan. Robusta Wiis, begitulah para pecinta kopi menyebutnya. Kopi ini di tanam di area perkebunan yang luasnya kurang lebih 2.500 Ha. Destinasi ini memiliki sejarah panjang sejak masa kolonial Belanda. Konon, masa itu kopi Kandangan termasuk jajaran pabrik besar di Asia Tenggara dan pasarnya sampai ke Eropa. KIni, area ini sudah berkembang menjadi destinasi wisata unggulan di Kabupaten Madiun. Kita bisa mengenang masa kejayaan perkebunan kopi Kandangan, sambil menikmati hamparan hijau sejauh mata memandang. Jika kita pagi sekali datang kesini , akan disuguhi kabut tipis putih yang menyelimuti pucuk-pucuk pohon kopi.',
                'maps_destinasi' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15813.163204387962!2d111.7007652!3d-7.7589518!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79afa543fa2563%3A0x8c8e87386961ccdc!2sPT%20Perkebunan%20Kandangan!5e0!3m2!1sid!2sid!4v1687278651523!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'foto_destinasi' => 'pexels2.jpg|pexels3.jpg|pexels1.jpg',
                'alamat_destinasi' => '6PR2+C86, Unnamed Road, Kempo, Kare, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'htm_destinasi' => 5000,
                'approve' => '1',
            ],
            [
                'nama_destinasi' => 'Aswin Loka Seweru',
                'kategori_id' => '1',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060003',
                'deskripsi_destinasi' => 'sarana wisata yang edukatif yang berada di Dusun Seweru Desa Kare Kare.Aswin Loka merupakan wahana belajar secara factual terhadap ekosistem lingkungan hidup yang memberikan warna dan nilai kemanusiaan.',
                'maps_destinasi' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15813.625633746517!2d111.7005572!3d-7.746645!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79afdd0eebcd2b%3A0x2d6e7585df3c0e32!2sAswin%20Loka%20Seweru!5e0!3m2!1sid!2sid!4v1687278713379!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'foto_destinasi' => 'pexels2.jpg|pexels1.jpg|pexels3.jpg',
                'alamat_destinasi' => '7P32+86V, Branjang, Kare, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'htm_destinasi' => 5000,
                'approve' => '1',
            ],
            [
                'nama_destinasi' => 'Air Terjun Coban Kromo',
                'kategori_id' => '1',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060001',
                'deskripsi_destinasi' => 'Air Terjun Coban Kromo mempunyai dua aliran air terjun yang konon ceritanya merupakan dua jenis yang berbeda yakni laki - laki dan perempuan . Sehingga karena mitos tersebut , air terjun yang terletak di desa Bodag itu dinamakan Coban Kromo yang artinya air terjun berjodoh .',
                'maps_destinasi' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15797.656636106636!2d111.8891832!3d-8.160961!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78e1b173a1d575%3A0xb46d147ffde63f01!2sAir%20Terjun%20Coban%20Kromo!5e0!3m2!1sid!2sid!4v1687278735603!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'foto_destinasi' => 'alam.jpg|pexels2.jpg|pexels1.jpg',
                'alamat_destinasi' => 'RVQQ+JM7, Area Sawah, Pelem, Kec. Campurdarat, Kabupaten Tulungagung, Jawa Timur 66272',
                'htm_destinasi' => 5000,
                'approve' => '1',
            ],
            [
                'nama_destinasi' => 'Wana Wisata Selo Gedong',
                'kategori_id' => '1',
                'province_id' => '35',
                'regency_id' => '3519',
                'district_id' => '3519060',
                'village_id' => '3519060001',
                'deskripsi_destinasi' => 'Selo yang berarti Batu, dan Gedong untuk Rumah Besar, itulah kiranya gambaran sekilas dari nama obyek wisata ini. Tatatan batu alam berukuran besar di puncak bukit, dengan panorama pemandangan yang eksotik, adalah daya tarik utama lokasi ini. Tidak hanya menawarkan sebuah pesona panorama alam, terdapat pula kedai-kedai gazebo yang siap mengobatilapar dan dahaga pengunjung. Ditemani rindang pohon pinus dengan kesegaran aromanya yang melapangkan dada, Selo Gedong menjadi tempat yang tidak akan membuat pengunjung jera untuk berkunjung kembali.',
                'maps_destinasi' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15813.608298490384!2d111.6645144!3d-7.7471067!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79a55f0aa49ae5%3A0xfdb644d459a75470!2sSELO%20GEDONG!5e0!3m2!1sid!2sid!4v1687278758456!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'foto_destinasi' => 'pexels3.jpg|pexels1.jpg|pexels2.jpg',
                'alamat_destinasi' => 'Area Kebun/Hutan, Bodag, Kec. Kare, Kabupaten Madiun, Jawa Timur 63182',
                'htm_destinasi' => 5000,
                'approve' => '1',
            ],
        ];

        foreach ($destinasi as $key => $value) {
            ModelsDestinasi::create($value);
        }
    }
}
