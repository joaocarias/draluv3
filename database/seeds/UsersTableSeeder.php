<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => '102.030.405-06',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'tipo_usuario_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
