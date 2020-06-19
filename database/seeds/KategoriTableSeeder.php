<?php

use App\Model\Kategori;
use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::create([
            'jenis_id' => '1',
            'kategori_soal' => 'Kebersihan Tempat Kerja'
        ]);
        Kategori::create([
            'jenis_id' => '1',
            'kategori_soal' => 'Alat Pelindung Diri'
        ]);
    }
}
