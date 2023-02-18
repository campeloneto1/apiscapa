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
            0 => [ 'orgao_id' => 1, 'nome' => 'Secretário De Estado Chefe Da Casa Civil' ],
            1 => [ 'orgao_id' => 1, 'nome' => 'Secretaria Executiva De Comunicação, Publicidade E Eventos' ],
            2 => [ 'orgao_id' => 1, 'nome' => 'Secretaria Executiva De Regionalização E Modernização' ],
            3 => [ 'orgao_id' => 1, 'nome' => 'Secretaria Executiva De Acompanhamento De Projetos Especiais' ],
            4 => [ 'orgao_id' => 1, 'nome' => 'Secretaria Executiva De Planejamento E Gestão Interna' ],
            5 => [ 'orgao_id' => 1, 'nome' => 'Assessoria Especial De Relações Institucionais' ],
            6 => [ 'orgao_id' => 1, 'nome' => 'Assessoria Especial Do Governador' ],
            7 => [ 'orgao_id' => 1, 'nome' => 'Assessoria Especial De Acolhimento Aos Movimentos Sociais' ],
            8 => [ 'orgao_id' => 1, 'nome' => 'Assessoria Especial Para Assuntos Internacionais' ],
            9 => [ 'orgao_id' => 1, 'nome' => 'Assessoria Especial Para Assuntos Federativos' ],
            10 => [ 'orgao_id' => 1, 'nome' => 'Assessoria Especial De Comunicação Do Governo' ],
            11 => [ 'orgao_id' => 1, 'nome' => 'Casa Militar' ],
            12 => [ 'orgao_id' => 1, 'nome' => 'Assessoria Jurídica' ],
            13 => [ 'orgao_id' => 1, 'nome' => 'Assessoria De Controle Interno E Ouvidoria' ],    
            14 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria Especial De Cerimonial' ],
            15 => [ 'orgao_id' => 1, 'nome' => 'Célula De Apoio Ao Cerimonial' ],
            16 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria De Comunicação' ],
            17 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria De Publicidade' ],
            18 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria De Eventos' ],
            19 => [ 'orgao_id' => 1, 'nome' => 'Célula De Eventos Especiais E Da Região Metropolitana De Fortaleza' ],
            20 => [ 'orgao_id' => 1, 'nome' => 'Célula De Eventos Do Interior' ],
            21 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria De Operações De Logística E Telefonia Móvel' ],
            22 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria De Atos E Publicações Oficiais' ],
            23 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria De Projetos Especiais' ],
            24 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria De Apoio Às Políticas Públicas' ],
            25 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria Especial Da Região Norte' ],
            26 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria Especial Da Região Do Cariri' ],        
            27 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria De Desenvolvimento Institucional E Planejamento' ],
            28 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria De Gestão Do Escritório Em Brasília' ],
            29 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria Da Administração Palaciana' ],
            30 => [ 'orgao_id' => 1, 'nome' => 'Célula De Serviços Gerais' ],
            31 => [ 'orgao_id' => 1, 'nome' => 'Célula De Manutenção Predial' ],
            32 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria De Material E Patrimônio' ],
            33 => [ 'orgao_id' => 1, 'nome' => 'Célula De Material' ],
            34 => [ 'orgao_id' => 1, 'nome' => 'Célula De Patrimônio' ],
            35 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria De Logística De Transporte' ],
            36 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria Administrativo-Financeira' ],
            37 => [ 'orgao_id' => 1, 'nome' => 'Célula Financeira' ],
            38 => [ 'orgao_id' => 1, 'nome' => 'Célula De Aquisições E Gestão De Contratos' ],
            39 => [ 'orgao_id' => 1, 'nome' => 'Célula De Gestão Documental' ],
            40 => [ 'orgao_id' => 1, 'nome' => 'Célula De Gestão De Pessoas' ],
            41 => [ 'orgao_id' => 1, 'nome' => 'Coordenadoria De Tecnologia Da Informação E Comunicação' ],
            42 => [ 'orgao_id' => 1, 'nome' => 'Célula De Análise De Sistemas' ],
            43 => [ 'orgao_id' => 1, 'nome' => 'Célula De Suporte De Tecnologia Da Informação' ],
            44 => [ 'orgao_id' => 1, 'nome' => 'Conselho Estadual De Segurança Pública E Defesa Social' ],

            45 => [ 'orgao_id' => 2, 'nome' => 'Assessor Especial do Vice-Governador' ],
            46 => [ 'orgao_id' => 2, 'nome' => 'Assessoria Jurídica' ],
            47 => [ 'orgao_id' => 2, 'nome' => 'Assessoria de Desenvolvimento Institucional' ],
            48 => [ 'orgao_id' => 2, 'nome' => 'Assessoria do Vice-Governador' ],
            49 => [ 'orgao_id' => 2, 'nome' => 'Coordenadoria Especial de Programas e Projetos' ],
            50 => [ 'orgao_id' => 2, 'nome' => 'Coordenadoria Administrativo-Financeira' ],
            51 => [ 'orgao_id' => 2, 'nome' => 'Célula Administrativa e de Gestão de Pessoal' ],
            52 => [ 'orgao_id' => 2, 'nome' => 'Célula Financeira' ],
            53 => [ 'orgao_id' => 2, 'nome' => 'Célula de Transporte' ],
            54 => [ 'orgao_id' => 2, 'nome' => 'Coordenadoria de Tecnologia da Informação, Governança e Inovação' ],

          
        ];
        DB::table('setores')->insert($init);
    }
}
