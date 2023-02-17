<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrgaosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $init = [
            0 => [ 'nome' => 'Palácio da Abolição' ],
            1 => [ 'nome' => 'Vice-Governadoria' ],
            2 => [ 'nome' => 'Residência Oficial' ],
          
        ];
        DB::table('orgaos')->insert($init);
    }
}
