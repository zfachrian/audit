<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori_soal';

    protected $fillable = [
        'jenis_id', 'kategori_soal', 'total_diperiksa', 'total_tdksesuai', 'presentase', 'keterangan'
    ];

}
