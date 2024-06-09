<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class PenerimaBansosModel extends Model
{
    use HasFactory;
    protected $table = 'penerima_bansos'; //mendefinisikan nama tabel yg digunakan oleh model
    protected $primaryKey = 'bansos_id'; //mendefinisikan primary key dr tabel yg digunakan

    // Definisikan atribut yang dapat diisi
    protected $fillable = [
        'bansos_id',
        'kk_id',
        'jenis_bansos',
        'penghasilan',
        'jumlah_tanggungan',
        'dinding_rumah',
        'atap_rumah',
        'lantai_rumah'
    ];
    public function kk(): BelongsTo
    {
        return $this->belongsTo(KkModel::class, 'kk_id', 'kk_id');
    }

    public function nilai(): HasMany
    {
        return $this->HasMany(NilaiModel::class, 'nilai_id', 'nilai_id');
    }
}
