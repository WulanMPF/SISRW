<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSuratModel extends Model
{
    use HasFactory;
    protected $table = 'arsip_surat';
    protected $primaryKey = 'arsip_surat_id';
    protected $fillable = ['nama_surat', 'jenis_surat'];
}
