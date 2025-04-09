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
        Schema::create('nutritional_analyses', function (Blueprint $table) {
            $table->id('analysis_id');
            $table->string('crop_name');
            $table->decimal('calories', 8, 2);
            $table->decimal('vitamins', 8, 2);
            $table->decimal('protein', 8, 2);
            $table->decimal('minerals', 8, 2);
            $table->integer('day');
            $table->string('month');
            $table->year('year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutritional_analyses');
    }
};
