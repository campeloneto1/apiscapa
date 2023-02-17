<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     php artisan migrate:fresh --seed
     * php artisan passport:install
     * php artisan key:generate
     * Seed the application's database.

     UPDATE `perfis` SET `administrador`= 1,`gestor`= 1,`orgaos`= 1,`orgaos_cad`= 1,`orgaos_edt`= 1,`orgaos_del`= 1,`setores`= 1,`setores_cad`= 1,`setores_edt`= 1,`setores_del`= 1,`postos`= 1,`postos_cad`= 1,`postos_edt`= 1,`postos_del`= 1,`pessoas`= 1,`pessoas_cad`= 1,`pessoas_edt`= 1,`pessoas_del`= 1,`niveis`= 1,`niveis_cad`= 1,`niveis_edt`= 1,`niveis_del`= 1,`acessos`= 1,`acessos_cad`= 1,`acessos_edt`= 1,`acessos_del`= 1 WHERE `id` = 1
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call([            
            SexosSeeder::class,
            PaisesSeeder::class,
            EstadosSeeder::class,
            OrgaosSeeder::class, 
            SetoresSeeder::class, 
            PostosSeeder::class, 
            PerfisSeeder::class, 
            NiveisSeeder::class, 
            NiveisPostosSeeder::class, 
            UsersSeeder::class,            
        ]);
        Schema::enableForeignKeyConstraints();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
