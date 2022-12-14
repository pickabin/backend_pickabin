<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasPetugas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jadwal()
    {
        return $this->belongsTo(jadwal::class);
    }  
    
    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    } 
}
