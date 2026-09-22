<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id', 'dibuat_oleh', 'nama', 'deskripsi',
        'tanggal', 'waktu_mulai', 'waktu_selesai',
        'lokasi', 'kapasitas', 'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalAcara::class);
    }
}