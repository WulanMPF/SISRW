<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WargaModel extends Model
{
    use HasFactory;

    protected $table = 'warga';
    protected $primaryKey = 'warga_id';
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'kk_id', 'nik', 'nama_warga', 'tempat_tgl_lahir', 
        'jenis_kelamin', 'rt_rw', 'kel_desa', 'kecamatan', 
        'agama', 'status_perkawinan', 'pekerjaan', 'hubungan_keluarga'
    ];

    public function kk(): BelongsTo
    {
        return $this->belongsTo(KkModel::class, 'kk_id', 'kk_id');
    }
}
