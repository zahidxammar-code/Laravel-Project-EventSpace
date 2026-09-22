<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = ['acara_id', 'user_id', 'nama', 'no_hp', 'status', 'terdaftar_pada'];

    public function acara()
    {
        return $this->belongsTo(Acara::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
