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
            0 => [ 'orgao_id' => 1, 'nome' => 'Bravo 01' ],
            1 => [ 'orgao_id' => 2, 'nome' => 'Recepção' ],           
          
        ];
        DB::table('postos')->insert($init);
    }
}
