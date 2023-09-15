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
        Schema::create('autoridades_acessos', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('orgao_id')->nullable()->constrained('orgaos')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('autoridade_id')->nullable()->constrained('autoridades')->onUpdate('cascade')->onDelete('set null');
            $table->dateTime('data_hora_entrada', $precision = 0);
            $table->dateTime('data_hora_saida', $precision = 0)->nullable();

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
        Schema::dropIfExists('autoridades_acessos');
    }
};
