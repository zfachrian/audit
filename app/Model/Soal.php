<?php
/**
 * Created by.
 * User: zfachrian (https://www.linkedin.com/in/zfachrian/)
 * Date: 20-Jul-20
 * Time: 11:24 PM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';

    protected $fillable = [
        'kategori_id', 'topik', 'total_diperiksa', 'total_tdksesuai', 'presentase', 'keterangan'
    ];
}
