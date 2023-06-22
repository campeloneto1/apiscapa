<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $init = [
            0 => [ 'nome' => 'Administrador', 'administrador' => 1, 'gestor' => 1 ],
            1 => [ 'nome' => 'Gestor', 'administrador' => 0, 'gestor' => 0 ],          
        ];
        DB::table('perfis')->insert($init);
    }
}
