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
        Schema::create('favorites_weather', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->foreignUuid('user_id')->references('id')->on('users');          
            $table->foreignUuid('histories_weather_id')->references('id')->on('histories_weather');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites_weather');
    }
};
