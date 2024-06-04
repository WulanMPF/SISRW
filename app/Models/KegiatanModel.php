<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class KegiatanModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kegiatan'; // Nama tabel di database
    protected $primaryKey = 'kegiatan_id'; // Nama primary key

    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'tanggal',
        'gambar',
    ];

    protected $dates = ['deleted_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}
