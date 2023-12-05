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
        Schema::create('required_talent', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_id')->constrained('talent')->onDelete("cascade");
            $table->foreignId('required_talent_id')->constrained('talent')->onDelete("cascade");
            $table->unique(['talent_id', 'required_talent_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('required_talent');
    }
};
