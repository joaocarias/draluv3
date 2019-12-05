<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{    
    public function run()
    {
        $this->call(TipoUsuariosTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FuncaosTableSeeder::class);
    }
}
