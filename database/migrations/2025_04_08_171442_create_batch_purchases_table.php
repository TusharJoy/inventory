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
        Schema::create('batch_purchases', function (Blueprint $table) {
            $table->foreignId('batch_id')->constrained('batches', 'batch_id')->onDelete('cascade');
            $table->foreignId('purchase_id')->constrained('purchases', 'purchase_id')->onDelete('cascade');
            $table->primary(['batch_id', 'purchase_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_purchases');
    }
};
