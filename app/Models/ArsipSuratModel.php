<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArsipSuratModel extends Model
{
    use HasFactory;
    protected $table = 'arsip_surat';
    protected $primaryKey = 'arsip_surat_id';
    protected $fillable = ['nomor_surat', 'tanggal_surat', 'pengirim', 'penerima', 'perihal', 'lampiran', 'keterangan'];

    /*public function undangan(): BelongsTo
    {
        return $this->belongsTo(SuratUndanganModel::class, 'undangan_id', 'undangan_id');
    }
    public function pengantar(): BelongsTo
    {
        return $this->belongsTo(SuratPengantarModel::class, 'pengantar_id', 'pengantar_id');
    }*/
}
