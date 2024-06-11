<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'level';
    protected $primaryKey = 'level_id';
    protected $fillable = ['nama_level'];

    public function user(): HasMany
    {
        return $this->HasMany(User::class, 'user_id', 'user_id');
    }
}
