<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaBansos extends Model
{
    use HasFactory;

    // Definisikan atribut yang dapat diisi
    protected $fillable = [
        'kk_id',
        'jenis_bansos',
        'created_at',
        'updated_at',
    ];
}
