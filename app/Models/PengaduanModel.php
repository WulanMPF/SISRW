<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengaduanModel extends Model
{
    use HasFactory;

    protected $table = 'pengaduan_warga';
    protected $primaryKey = 'pengaduan_id';

    protected $fillable = [
        'warga_id',
        //'nama_pelapor',
        'jenis_pengaduan', // Include 'jenis_pengaduan' in fillable attributes
        'tgl_pengaduan',
        'prioritas',
        'status_pengaduan',
        'deskripsi',
        'lampiran',
        'tindakan_diambil',
    ];

    public function warga(): BelongsTo
    {
        return $this->belongsTo(WargaModel::class, 'warga_id', 'warga_id');
    }
}
