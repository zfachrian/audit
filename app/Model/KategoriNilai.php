<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KategoriNilai extends Model
{
    protected $table = 'kategori_nilai';

    protected $fillable = [
        'audit_id', 'kategori_id', 'total_diperiksa', 'total_tdksesuai', 'presentase', 'keterangan'
    ];
}
