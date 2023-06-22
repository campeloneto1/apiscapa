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
             $table->boolean('chaves')->nullable();    
            $table->boolean('chaves_cad')->nullable();    
            $table->boolean('chaves_edt')->nullable();    
            $table->boolean('chaves_del')->nullable();  
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
