<?php

use Illuminate\Database\Seeder;

class TipoUsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_usuarios')->insert([
            'nome' => 'Básico',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
