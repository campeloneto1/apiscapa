<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $init = [
            0 => [ 'orgao_id' => 1, 'nome' => 'Marketing' ],
            1 => [ 'orgao_id' => 1, 'nome' => 'Informática' ],
            2 => [ 'orgao_id' => 1, 'nome' => 'COAF' ],
            3 => [ 'orgao_id' => 1, 'nome' => 'Patrimônio' ],
          
        ];
        DB::table('setores')->insert($init);
    }
}
