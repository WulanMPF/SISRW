<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersuratanModel extends Model {
    protected $table = 'documents'; 
    protected $fillable = ['name', 'file_path', 'size'];
}
