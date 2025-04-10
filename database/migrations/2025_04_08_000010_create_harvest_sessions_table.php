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
        Schema::create('harvest_sessions', function (Blueprint $table) {
            $table->id('harvest_id');
            $table->integer('day');
            $table->string('month');
            $table->year('year');
            $table->decimal('total_harvest_quantity', 10, 2);
            $table->foreignId('farmer_id')->constrained('farmers', 'farmer_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('harvest_sessions');
    }
};
