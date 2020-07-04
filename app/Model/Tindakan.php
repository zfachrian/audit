<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    protected $table = 'tindakan';

    protected $fillable = [
        'audit_id', 'kategori_id', 'what', 'action', 'who', 'when'
    ];
}
