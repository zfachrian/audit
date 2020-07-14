<?php
/**
 * Created by.
 * User: zfachrian (https://www.linkedin.com/in/zfachrian/)
 * Date: 20-Jul-20
 * Time: 11:24 PM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori_soal';

    protected $fillable = [
        'jenis_id', 'kategoriSoal', 'total_diperiksa', 'total_tdksesuai', 'presentase', 'keterangan'
    ];

}
