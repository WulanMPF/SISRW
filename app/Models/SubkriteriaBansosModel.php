<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubkriteriaBansosModel extends Model
{
    use HasFactory;

    protected $table = 'subkriteria_bansos'; //mendefinisikan nama tabel yg digunakan oleh model
    protected $primaryKey = 'subkriteria_id'; //mendefinisikan primary key dr tabel yg digunakan

    // Definisikan atribut yang dapat diisi
    protected $fillable = [
        'subkriteria_id',
        'kriteria_id',
        'sub_kriteria',
        'keterangan',
        'bobot',
    ];

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(KriteriaBansosModel::class, 'kriteria_id', 'kriteria_id');
    }
}
