<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';

    protected $fillable = [
        'kategori_id', 'topik', 'total_diperiksa', 'total_tdksesuai', 'presentase', 'keterangan'
    ];
}
