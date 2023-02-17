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
        Schema::create('setores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orgao_id')->nullable()->constrained('orgaos')->onUpdate('cascade')->onDelete('set null');
            $table->string('nome', 100);    
            $table->string('email', 40)->unique()->nullable();
            $table->string('telefone1', 11)->nullable();
            $table->string('telefone2', 12)->nullable();

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
        Schema::dropIfExists('setores');
    }
};
