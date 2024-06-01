<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeIuranModel extends Model
{
    use HasFactory;
    protected $table = 'periode_iuran';
    protected $primaryKey = 'periode_id';
    public function iuran()
    {
        return $this->hasMany(IuranModel::class, 'periode_id', 'periode_id');
    }
}
