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
        Schema::create('shipment_transports', function (Blueprint $table) {
            $table->id('shipment_transport_id');
            $table->decimal('weight', 10, 2);
            $table->foreignId('shipment_id')->constrained('shipments', 'shipment_id')->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained('transport_vehicles', 'id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipment_transports');
    }
};
