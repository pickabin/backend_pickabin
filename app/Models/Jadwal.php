<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aktivitas_koor()
    {
        return $this->hasMany(AktivitasKoor::class);
    }

    public function aktivitas_petugas()
    {
        return $this->hasMany(AktivitasPetugas::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }
}
