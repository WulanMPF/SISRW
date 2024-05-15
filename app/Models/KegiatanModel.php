<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanModel extends Model
{
    use HasFactory;

    protected $table = 'kegiatan'; // Nama tabel di database
    protected $primaryKey = 'kegiatan_id'; // Nama primary key

    protected $fillable = [
        'warga_id',
        'nama_kegiatan',
        'deskripsi',
        'tanggal',
    ];

    // Relasi ke tabel Warga
    public function warga()
    {
        return $this->belongsTo(WargaModel::class, 'warga_id', 'warga_id');
    }
}
