<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceVehicleTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('race_vehicle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->integer('position')->nullable();  // Posição de chegada
            $table->time('time')->nullable();         // Tempo total da corrida
            $table->timestamps();
            $table->float('fuel_consumption')->nullable();  // Consumo de combustível
            $table->float('average_speed')->nullable();     // Velocidade média
            $table->enum('car_condition', ['excellent', 'good', 'fair', 'poor'])->nullable();  // Estado do carro
            $table->integer('points')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('race_vehicle');
    }
}
