<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $table = 'tiket';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_pemesan', 'jumlah_tiket', 'tanggal_kunjungan', 'user_id', 'destinasi_id', 'paket_id', 'konfirmasi'
    ];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }

    public function wahana()
    {
        return $this->belongsTo(Wahana::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
