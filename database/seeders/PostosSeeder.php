<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $init = [
            0 => [ 'orgao_id' => 1, 'nome' => 'Posto 01' ],
            1 => [ 'orgao_id' => 1, 'nome' => 'Posto 02' ],
            2 => [ 'orgao_id' => 1, 'nome' => 'Bravo 01' ],
            3 => [ 'orgao_id' => 1, 'nome' => 'Bravo 02' ],
            4 => [ 'orgao_id' => 1, 'nome' => 'Bravo 03' ],
            5 => [ 'orgao_id' => 1, 'nome' => 'Bravo 04' ],
          
        ];
        DB::table('postos')->insert($init);
    }
}
