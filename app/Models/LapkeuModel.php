<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LapkeuModel extends Model
{
    use HasFactory;
    protected $table = 'laporan_keuangan';
    protected $primaryKey = 'laporan_id';
    protected $fillable = ['nominal', 'keterangan', 'jenis_laporan', 'periode', 'tahun', 'tgl_laporan'];
}
