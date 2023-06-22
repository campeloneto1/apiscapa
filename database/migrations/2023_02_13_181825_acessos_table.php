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
        Schema::create('acessos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posto_id')->nullable()->constrained('postos')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('setor_id')->nullable()->constrained('setores')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('pessoa_id')->nullable()->constrained('pessoas')->onUpdate('cascade')->onDelete('set null');
            $table->dateTime('data_hora', $precision = 0);
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
        Schema::dropIfExists('acessos');
    }
};
