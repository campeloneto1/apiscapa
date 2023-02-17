<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $init = [
            0 => [ 'nome' => 'Acre', 'uf' => 'AC', 'pais_id' => 1 ],
            1 => [ 'nome' => 'Alagoas', 'uf' => 'AL', 'pais_id' => 1 ],
            2 => [ 'nome' => 'Amapá', 'uf' => 'AP', 'pais_id' => 1 ],
            3 => [ 'nome' => 'Amazonas', 'uf' => 'AM', 'pais_id' => 1 ],
            4 => [ 'nome' => 'Bahia', 'uf' => 'BA', 'pais_id' => 1 ],
            5 => [ 'nome' => 'Ceará', 'uf' => 'CE', 'pais_id' => 1 ],
            6 => [ 'nome' => 'Distrito Federal', 'uf' => 'DF', 'pais_id' => 1 ],
            7 => [ 'nome' => 'Espírito Santo', 'uf' => 'ES', 'pais_id' => 1 ],
            8 => [ 'nome' => 'Goiás', 'uf' => 'GO', 'pais_id' => 1 ],
            9 => [ 'nome' => 'Maranhão', 'uf' => 'MA', 'pais_id' => 1 ],
            10 => [ 'nome' => 'Mato Grosso', 'uf' => 'MT', 'pais_id' => 1 ],
            11 => [ 'nome' => 'Mato Grosso do Sul', 'uf' => 'MS', 'pais_id' => 1 ],
            12 => [ 'nome' => 'Minas Gerais', 'uf' => 'MG', 'pais_id' => 1 ],
            13 => [ 'nome' => 'Pará', 'uf' => 'PA', 'pais_id' => 1 ],
            14 => [ 'nome' => 'Paraíba', 'uf' => 'PB', 'pais_id' => 1 ],
            15 => [ 'nome' => 'Paraná', 'uf' => 'PR', 'pais_id' => 1 ],
            16 => [ 'nome' => 'Pernambuco', 'uf' => 'PE', 'pais_id' => 1 ],
            17 => [ 'nome' => 'Piauí', 'uf' => 'PI', 'pais_id' => 1 ],
            18 => [ 'nome' => 'Rio de Janeiro', 'uf' => 'RJ', 'pais_id' => 1 ],
            19 => [ 'nome' => 'Rio Grande do Norte', 'uf' => 'RN', 'pais_id' => 1 ],
            20 => [ 'nome' => 'Rio Grande do Sul', 'uf' => 'RS', 'pais_id' => 1 ],
            21 => [ 'nome' => 'Rondônia', 'uf' => 'RO', 'pais_id' => 1 ],
            22 => [ 'nome' => 'Roraima', 'uf' => 'RR', 'pais_id' => 1 ],
            23 => [ 'nome' => 'Santa Catarina', 'uf' => 'SC', 'pais_id' => 1 ],
            24 => [ 'nome' => 'São Paulo', 'uf' => 'SP', 'pais_id' => 1 ], 
            25 => [ 'nome' => 'Sergipe', 'uf' => 'SE', 'pais_id' => 1 ],          
            26 => [ 'nome' => 'Tocantins', 'uf' => 'TO', 'pais_id' => 1 ], 
        ];
        DB::table('estados')->insert($init);
    }
}
