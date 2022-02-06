<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Kyri',
            'email' => 'contact@kyri.me',
            'password' => \Illuminate\Support\Facades\Hash::make('secretsecret'),
        ]);

        \App\User::create([
            'name' => 'Kyri 2',
            'email' => 'contact2@kyri.me',
            'password' => \Illuminate\Support\Facades\Hash::make('secretsecret'),
        ]);
    }
}
