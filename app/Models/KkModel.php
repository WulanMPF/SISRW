<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KkModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kk';
    protected $primaryKey = 'kk_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['no_kk', 'nama_kepala_keluarga', 'rt_rw', 'alamat'];

    protected $dates = ['deleted_at'];

    public function kk(): BelongsTo
    {
        return $this->belongsTo(KkModel::class, 'kk_id', 'kk_id');
    }
    public function bansos(): HasMany
    {
        return $this->HasMany(PenerimaBansosModel::class, 'kk_id', 'kk_id');
    }

    public function warga(): HasMany
    {
        return $this->HasMany(WargaModel::class, 'kk_id', 'kk_id');
    }
}
