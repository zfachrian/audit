<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(JenisAuditTableSeeder::class);
        $this->call(KategoriTableSeeder::class);
        $this->call(SoalTableSeeder::class);
    }
}
