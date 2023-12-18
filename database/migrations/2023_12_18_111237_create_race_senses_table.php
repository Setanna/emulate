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
        Schema::create('race_senses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_id')->constrained('races')->onDelete("cascade");
            $table->foreignId('sense_id')->constrained('senses')->onDelete("cascade");
            $table->unique(['race_id', 'sense_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('race_senses');
    }
};
