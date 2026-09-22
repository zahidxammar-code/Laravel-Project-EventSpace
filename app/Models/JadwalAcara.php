<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalAcara extends Model
{
    protected $fillable = ['acara_id', 'tanggal', 'waktu_mulai', 'waktu_selesai'];

    public function acara()
    {
        return $this->belongsTo(Acara::class);
    }
}