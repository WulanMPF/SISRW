<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IuranModel extends Model
{
    use HasFactory;
    protected $table = 'iuran';
    protected $primaryKey = 'iuran_id';
    protected $fillable = [
        'periode_id',
        'kk_id',
        'laporan_id',
        'tgl_pembayaran',
        'status_pembayaran',
    ];

    public function kk()
    {
        return $this->belongsTo(KkModel::class, 'kk_id', 'kk_id');
    }

    // public function laporanKeuangan()
    // {
    //     return $this->belongsTo(LaporanKeuangan::class, 'laporan_id');
    // }

    public function periode()
    {
        return $this->belongsTo(PeriodeIuranModel::class, 'periode_id', 'periode_id');
    }
}
