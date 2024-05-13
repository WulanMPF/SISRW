<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SyaratBansosModel extends Model
{
    use HasFactory;
    protected $table = 'syarat_bansos';
    protected $primaryKey = 'syarat_bansos_id';
    protected $fillable = ['syarat_bansos_id', 'tgl_syarat_ketentuan', 'jenis_bansos', 'deskripsi', 'gambar'];
    protected function image(): Attribute
    {
        return Attribute::make(
            // get: fn ($gambar) => url('/storage/syarat_bansos/' . $gambar), //pakai storage
            get: fn ($gambar) => url('syarat_bansos/' . $gambar),
        );
    }
}
