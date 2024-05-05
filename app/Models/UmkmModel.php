<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UmkmModel extends Model
{
    use HasFactory;
    protected $table = 'umkm';
    protected $primaryKey = 'umkm_id';
    protected $fillable = ['warga_id', 'nama_usaha', 'alamat_usaha', 'jenis_usaha', 'status_usaha', 'deskripsi', 'lampiran'];

    public function warga(): HasMany
    {
        return $this->hasMany(WargaModel::class, 'warga_id', 'warga_id');
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($lampiran) => url('/storage/posts/' . $lampiran),
        );
    }
}
