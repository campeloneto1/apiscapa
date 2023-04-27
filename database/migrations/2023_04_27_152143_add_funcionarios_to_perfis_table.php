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
        Schema::table('perfis', function (Blueprint $table) {
            $table->boolean('funcionarios')->nullable();    
            $table->boolean('funcionarios_cad')->nullable();    
            $table->boolean('funcionarios_edt')->nullable();    
            $table->boolean('funcionarios_del')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perfis', function (Blueprint $table) {
            //
        });
    }
};
