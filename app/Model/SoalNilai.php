<?php
/**
 * Created by.
 * User: zfachrian (https://www.linkedin.com/in/zfachrian/)
 * Date: 20-Jul-20
 * Time: 11:24 PM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SoalNilai extends Model
{
    protected $table = 'soal_nilai';

    protected $fillable = [
        'audit_id', 'soal_id', 'diperiksa', 'tdksesuai', 'presentase', 'keterangan'
    ];
}
