<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_validated')->default(false);  // Validação do piloto
            $table->string('license_path');    // Licença de motorista
            $table->boolean('is_administrator')->default(false);  // Administrador
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_validated', 'license_path', 'is_administrator']);
        });
    }
    
};
