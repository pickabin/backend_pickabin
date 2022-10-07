<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function koorUmum()
    {
        return $this->hasOne(KoorUmum::class);
    }

    public function koorGedung()
    {
        return $this->hasOne(KoorGedung::class);
    }

    public function petugas()
    {
        return $this->hasOne(Petugas::class);
    }

    public function jadwal()
    {
        return $this->hasOne(Jadwal::class);
    }

    public function aspirasi()
    {
        return $this->hasOne(Aspirasi::class);
    }
}
