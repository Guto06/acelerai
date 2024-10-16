<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('model',30);
            $table->string('brand',30);
            $table->string('category',1);
            $table->integer('year');
            $table->integer('power');
            $table->foreignId('user_id')->constrained();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('vehicles');
        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });

    }
};
