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
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('orgao_id')->nullable()->constrained('orgaos')->onUpdate('cascade')->onDelete('set null');
            //$table->foreignId('nivel_id')->nullable()->constrained('niveis')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('sexo_id')->nullable()->constrained('sexos')->onUpdate('cascade')->onDelete('set null');
            $table->string('nome', 100);   
            $table->string('cpf', 11)->unique();
            $table->string('rg', 20)->unique()->nullable();
            $table->foreignId('uf_rg_id')->nullable()->constrained('estados')->onUpdate('cascade')->onDelete('set null');
            $table->date('data_nascimento')->nullable();       
            $table->string('telefone1', 11)->nullable();
            $table->string('telefone2', 11)->nullable();
            $table->string('email', 40)->nullable();
            $table->string('mae', 100)->nullable();  
            $table->string('pai', 100)->nullable();   
            $table->string('obs', 250)->nullable();
            $table->string('foto', 100)->nullable();
            $table->string('digital', 100)->nullable();
            
            $table->string('rua', 100)->nullable();
            $table->string('numero', 15)->nullable();
            $table->string('bairro', 40)->nullable();
            $table->string('complemento', 150)->nullable();
            $table->foreignId('cidade_id')->nullable()->constrained('cidades')->onUpdate('cascade')->onDelete('set null');
            $table->string('cep', 10)->nullable();
            
            $table->string('key', 100);
           

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
        Schema::dropIfExists('pessoas');
    }
};
