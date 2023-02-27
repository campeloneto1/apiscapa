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
            $table->boolean('administrador')->nullable();    
            $table->boolean('gestor')->nullable();    

            $table->boolean('acessos')->nullable();    
            $table->boolean('acessos_cad')->nullable();    
            $table->boolean('acessos_edt')->nullable();    
            $table->boolean('acessos_del')->nullable();  

             $table->boolean('eventos')->nullable();    
            $table->boolean('eventos_cad')->nullable();    
            $table->boolean('eventos_edt')->nullable();    
            $table->boolean('eventos_del')->nullable();    

            $table->boolean('orgaos')->nullable();    
            $table->boolean('orgaos_cad')->nullable();    
            $table->boolean('orgaos_edt')->nullable();    
            $table->boolean('orgaos_del')->nullable();    

            $table->boolean('setores')->nullable();    
            $table->boolean('setores_cad')->nullable();    
            $table->boolean('setores_edt')->nullable();    
            $table->boolean('setores_del')->nullable();    

            $table->boolean('postos')->nullable();    
            $table->boolean('postos_cad')->nullable();    
            $table->boolean('postos_edt')->nullable();    
            $table->boolean('postos_del')->nullable();    

            $table->boolean('pessoas')->nullable();    
            $table->boolean('pessoas_cad')->nullable();    
            $table->boolean('pessoas_edt')->nullable();    
            $table->boolean('pessoas_del')->nullable();   

            $table->boolean('niveis')->nullable();    
            $table->boolean('niveis_cad')->nullable();    
            $table->boolean('niveis_edt')->nullable();    
            $table->boolean('niveis_del')->nullable();               

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
