<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KriteriaBansosModel extends Model
{
    use HasFactory;

    protected $table = 'kriteria_bansos'; //mendefinisikan nama tabel yg digunakan oleh model
    protected $primaryKey = 'kriteria_id'; //mendefinisikan primary key dr tabel yg digunakan

    // Definisikan atribut yang dapat diisi
    protected $fillable = [
        'kriteria_id',
        'nama_kriteria',
        'type',
        'bobot',
    ];

    public function nilai(): HasMany
    {
        return $this->HasMany(NilaiModel::class, 'nilai_id', 'nilai_id');
    }
    public function subkriteria(): HasMany
    {
        return $this->HasMany(NilaiModel::class, 'subkriteria_id', 'subkriteria_id');
    }
}
