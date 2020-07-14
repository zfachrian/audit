<?php
/**
 * Created by.
 * User: zfachrian (https://www.linkedin.com/in/zfachrian/)
 * Date: 20-Jul-20
 * Time: 11:24 PM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audit';

    protected $fillable = [
        'diaudit', 'no_permit', 'lingkup_audit', 'jenis_usaha', 'tujuan', 'auditor', 'jadwal', 'jenis_id', 'manajer', 'supervisor'
    ];


}

