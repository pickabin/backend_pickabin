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
        return $this->belongsTo(AktivitasKoor::class);
    }

    public function aktivitas_petugas()
    {
        return $this->belongsTo(AktivitasPetugas::class);
    }
}
