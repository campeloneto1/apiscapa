<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::disableForeignKeyConstraints();
        Schema::create('perfis', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100); 
            $table->boolean('administrador');    
            $table->boolean('gestor');    

            $table->boolean('acessos')->default(0);    
            $table->boolean('acessos_cad')->default(0);    
            $table->boolean('acessos_edt')->default(0);    
            $table->boolean('acessos_del')->default(0);    

            $table->boolean('orgaos')->default(0);    
            $table->boolean('orgaos_cad')->default(0);    
            $table->boolean('orgaos_edt')->default(0);    
            $table->boolean('orgaos_del')->default(0);    

            $table->boolean('setores')->default(0);    
            $table->boolean('setores_cad')->default(0);    
            $table->boolean('setores_edt')->default(0);    
            $table->boolean('setores_del')->default(0);    

            $table->boolean('postos')->default(0);    
            $table->boolean('postos_cad')->default(0);    
            $table->boolean('postos_edt')->default(0);    
            $table->boolean('postos_del')->default(0);    

            $table->boolean('pessoas')->default(0);    
            $table->boolean('pessoas_cad')->default(0);    
            $table->boolean('pessoas_edt')->default(0);    
            $table->boolean('pessoas_del')->default(0);   

            $table->boolean('niveis')->default(0);    
            $table->boolean('niveis_cad')->default(0);    
            $table->boolean('niveis_edt')->default(0);    
            $table->boolean('niveis_del')->default(0);               

            $table->foreignId('created_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfis');
    }
};
