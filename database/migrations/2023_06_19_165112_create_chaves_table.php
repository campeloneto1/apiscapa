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
        Schema::create('chaves', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('setor_id')->nullable()->constrained('setores')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('funcionario_entrega_id')->nullable()->constrained('funcionarios')->onUpdate('cascade')->onDelete('set null');
            $table->dateTime('data_hora_entrega', $precision = 0);
            $table->foreignId('funcionario_devolucao_id')->nullable()->constrained('funcionarios')->onUpdate('cascade')->onDelete('set null');
            $table->dateTime('data_hora_devolucao', $precision = 0)->nullable();
            $table->string('obs', 150)->nullable();

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
        Schema::dropIfExists('chaves');
    }
};
