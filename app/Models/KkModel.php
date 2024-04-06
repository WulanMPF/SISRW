<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KkModel extends Model
{
    use HasFactory;

    protected $table = 'kk';
    protected $primaryKey = 'kk_id';
    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = ['no_kk', 'nama_kepala_keluarga', 'rt_rw', 'alamat'];

    public function kk(): BelongsTo
    {
        return $this->belongsTo(KkModel::class, 'kk_id', 'kk_id');
    }
}
