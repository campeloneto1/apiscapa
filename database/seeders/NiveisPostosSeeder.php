<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NiveisPostosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $init = [
            0 => [ 'nivel_id' => 1, 'posto_id' => 1],
            1 => [ 'nivel_id' => 1, 'posto_id' => 2],
        ];
        DB::table('niveis_postos')->insert($init);
    }
}
