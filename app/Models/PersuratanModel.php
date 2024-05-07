<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersuratanModel extends Model {
    protected $table = 'documents'; // Specify the table name if it is not the plural form of the model name
    protected $fillable = ['name', 'file_path', 'size'];
}
