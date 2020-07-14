<?php
/**
 * Created by.
 * User: zfachrian (https://www.linkedin.com/in/zfachrian/)
 * Date: 20-Jul-20
 * Time: 11:24 PM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KategoriNilai extends Model
{
    protected $table = 'kategori_nilai';

    protected $fillable = [
        'audit_id', 'kategori_id', 'total_diperiksa', 'total_tdksesuai', 'total_persentase', 'keterangan'
    ];
}
