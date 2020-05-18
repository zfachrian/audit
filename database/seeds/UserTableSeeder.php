<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(User::class, 6)->create();

        User::create([
            'name' => 'admin',
            'phone' => '081236475859',
            'state' => 'probolinggo',
            'email' => 'admin@gmail.com',
            'company_name' => 'PJB',
            'role' => '1',
            'password' => Hash::make('admin'),
            'remember_token' => Hash::make('admin')
        ]);
        User::create([
            'name' => 'auditor',
            'phone' => '081236475859',
            'state' => 'probolinggo',
            'email' => 'auditor@gmail.com',
            'company_name' => 'POMI',
            'role' => '2',
            'password' => Hash::make('auditor'),
            'remember_token' => Hash::make('auditor')
        ]);
        User::create([
            'name' => 'kontraktor',
            'phone' => '081236475859',
            'state' => 'probolinggo',
            'email' => 'kontraktor@gmail.com',
            'company_name' => 'WIKA Gedung',
            'role' => '3',
            'password' => Hash::make('kontraktor'),
            'remember_token' => Hash::make('kontraktor')
        ]);
        User::create([
            'name' => 'manajer',
            'phone' => '081236475859',
            'state' => 'probolinggo',
            'email' => 'manajer@gmail.com',
            'company_name' => 'POMI',
            'role' => '4',
            'password' => Hash::make('manajer'),
            'remember_token' => Hash::make('manajer')
        ]);
        User::create([
            'name' => 'supervisor',
            'phone' => '081236475859',
            'state' => 'probolinggo',
            'email' => 'supervisor@gmail.com',
            'company_name' => 'POMI',
            'role' => '5',
            'password' => Hash::make('supervisor'),
            'remember_token' => Hash::make('supervisor')
        ]);

    }
}
