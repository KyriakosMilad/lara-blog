<?php

use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Tenant::create([
            "domain" => "one.localhost",
            "db_name" => "one",
            "db_host" => "127.0.0.1",
            "db_port" => "3306",
            "db_user" => "root",
            "db_pass" => ""
        ]);

        \App\Tenant::create([
            "domain" => "two.localhost",
            "db_name" => "two",
            "db_host" => "127.0.0.1",
            "db_port" => "3306",
            "db_user" => "root",
            "db_pass" => ""
        ]);
    }
}
