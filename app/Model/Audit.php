<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audit';

    protected $fillable = [
        'diaudit', 'lingkup_audit', 'jenis_usaha', 'tujuan', 'auditor', 'jadwal', 'jenis_id', 'manajer', 'supervisor'
    ];


}

