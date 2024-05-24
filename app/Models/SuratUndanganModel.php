<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratUndanganModel extends Model
{
    use HasFactory;
    protected $table = 'surat_undangan';
    protected $primaryKey = 'undangan_id';
    protected $fillable = [
        'user_id', 'undangan_nama', 'undangan_tempat', 'undangan_tanggal', 'undangan_no_surat',
        'undangan_perihal', 'undangan_isi_hari', 'undangan_isi_tgl', 'undangan_isi_waktu', 
        'undangan_isi_tempat', 'undangan_isi_acara', 'jenis_surat'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}
