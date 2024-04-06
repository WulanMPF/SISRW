<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelapor',
        'jenis_pengaduan',
        'tanggal_pengaduan',
        'prioritas',
        'status',
    ];
    
}
