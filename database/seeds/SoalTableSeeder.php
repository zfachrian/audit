<?php

use App\Model\Soal;
use Illuminate\Database\Seeder;

class SoalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Soal::create([
            'kategori_id' => '1',
            'topik' => 'Lokasi kerja nampak rapih/ workplace is tidy and clean'
        ]);
        Soal::create([
            'kategori_id' => '1',
            'topik' => 'Bahan/ peralatan tersimpan dengan baik/materials/equiment are well stored'
        ]);
    }
}
