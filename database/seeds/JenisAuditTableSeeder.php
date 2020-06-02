<?php

use Illuminate\Database\Seeder;
use App\Model\JenisAudit;

class JenisAuditTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisAudit::create([
            'jenis_audit' => 'WIP',
            'keterangan' => 'audit WIP'
        ]);
        JenisAudit::create([
            'jenis_audit' => 'PTW',
            'keterangan' => 'audit PTW'
        ]);
    }
}
