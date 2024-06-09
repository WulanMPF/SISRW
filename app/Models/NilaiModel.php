<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NilaiModel extends Model
{
    use HasFactory;

    protected $table = 'nilai'; //mendefinisikan nama tabel yg digunakan oleh model
    protected $primaryKey = 'nilai_id'; //mendefinisikan primary key dr tabel yg digunakan

    // Definisikan atribut yang dapat diisi
    protected $fillable = [
        'nilai_id',
        'kriteria_id',
        'bansos_id',
        'nilai',
    ];

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(KriteriaBansosModel::class, 'kriteria_id', 'kriteria_id');
    }

    public function bansos(): BelongsTo
    {
        return $this->belongsTo(PenerimaBansosModel::class, 'bansos_id', 'bansos_id');
    }
}
