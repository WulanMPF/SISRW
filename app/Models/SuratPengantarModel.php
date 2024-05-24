<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratPengantarModel extends Model
{
    use HasFactory;
    protected $table = 'surat_pengantar';
    protected $primaryKey = 'pengantar_id';
    protected $fillable = [
        'user_id', 'pengantar_nama', 'pengantar_no_surat', 'pengantar_isi_nik', 
        'pengantar_isi_nama', 'pengantar_isi_ttl', 'pengantar_isi_jk', 
        'pengantar_isi_agama', 'pengantar_isi_pekerjaan', 'pengantar_isi_alamat', 
        'pengantar_isi_keperluan', 'jenis_surat'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}
