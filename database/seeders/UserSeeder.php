<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Organizador',
            'username' => 'Acelerai',
            'email' => 'acelerai@rally.com',
            'number' => '12345678910',
            'age' => '1999-01-01',
            'password' => Hash::make('acelerai'),
            'license_path' => 'app/private',
            'is_validated' => true,
            'is_administrator' => true,
        ]);

    }
        /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }

}