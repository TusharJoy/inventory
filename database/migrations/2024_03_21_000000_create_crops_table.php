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
        Schema::create('crops', function (Blueprint $table) {
            $table->id('crop_id');
            $table->foreignId('batch_id')->constrained('batches', 'batch_id')->onDelete('cascade');
            $table->string('crop_name');
            $table->string('crop_type');
            $table->string('crop_variety');
            $table->string('growing_season');
            $table->date('planting_date');
            $table->date('expected_harvest_date');
            $table->date('actual_harvest_date')->nullable();
            $table->decimal('yield_amount', 10, 2)->nullable();
            $table->string('yield_unit')->nullable();
            $table->enum('crop_status', ['planted', 'growing', 'ready_for_harvest', 'harvested', 'failed'])->default('planted');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crops');
    }
}; 