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
        Schema::create('markets', function (Blueprint $table) {
            $table->id('market_id');
            $table->string('market_name');
            $table->string('location');
            $table->string('contact_person');
            $table->string('contact_number', 20);
            $table->string('email')->nullable();
            $table->enum('market_status', ['active', 'inactive', 'temporary_closed'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markets');
    }
};
