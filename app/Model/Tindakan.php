<?php
/**
 * Created by.
 * User: zfachrian (https://www.linkedin.com/in/zfachrian/)
 * Date: 20-Jul-20
 * Time: 11:24 PM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    protected $table = 'tindakan';

    protected $fillable = [
        'audit_id', 'kategori_id', 'what', 'action', 'who', 'when'
    ];
}
