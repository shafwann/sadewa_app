<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'paket';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_paket', 'harga_paket', 'harga_normal', 'jenis', 'village_id', 'destinasi_id', 'destinasi', 'wahana'
    ];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function wahana()
    {
        return $this->belongsTo(Wahana::class);
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class, 'paket_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
