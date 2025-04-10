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
        Schema::create('warehouse_climate_logs', function (Blueprint $table) {
            $table->id('climate_log_id');
            $table->timestamp('recorded_at');
            $table->decimal('temperature', 5, 2);
            $table->decimal('humidity', 5, 2);
            $table->foreignId('warehouse_id')->constrained('warehouses', 'warehouse_id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_climate_logs');
    }
};
