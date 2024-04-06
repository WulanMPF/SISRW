<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BansosModel extends Model
{
    use HasFactory;
    protected $table = 'penerima_bansos'; //mendefinisikan nama tabel yg digunakan oleh model
    protected $primaryKey = 'bansos_id'; //mendefinisikan primary key dr tabel yg digunakan

    // Definisikan atribut yang dapat diisi
    protected $fillable = [
        'bansos_id',
        'kk_id',
        'jenis_bansos'
    ];
    public function kk(): BelongsTo
    {
        return $this->belongsTo(KkModel::class, 'kk_id', 'kk_id');
    }
}
