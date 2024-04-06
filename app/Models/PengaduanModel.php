<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanModel extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $primaryKey = 'pengaduan_id';

    protected $fillable = [
        'nama_pelapor',
        'jenis_pengaduan',
        'tanggal_pengaduan',
        'prioritas',
        'status',
    ];
    
}
