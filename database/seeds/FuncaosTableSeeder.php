<?php

use Illuminate\Database\Seeder;

class FuncaosTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('funcaos')->insert([
            'nome' => 'Dentista',
            'usuario_cadastro' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
