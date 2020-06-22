<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SoalNilai extends Model
{
    protected $table = 'soal_nilai';

    protected $fillable = [
        'audit_id', 'soal_id', 'diperiksa', 'tdksesuai', 'presentase', 'keterangan'
    ];
}
